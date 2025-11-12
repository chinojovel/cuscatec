<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\LocationMovement;
use App\Models\MonthlyProductStock;
use Carbon\Carbon; // Indispensable para manejar fechas

class KardexController extends Controller
{
    /**
     * Muestra el formulario de filtro y los resultados del Kardex.
     */
    public function index(Request $request)
    {
        // 1. Validar los datos de entrada para asegurarnos que son correctos
        $request->validate([
            'product_id' => 'nullable|integer|exists:products,id',
            'month' => 'nullable|integer|between:1,12',
            'year' => 'nullable|integer|min:2000',
        ]);

        // 2. Obtener los parámetros de la URL. Si no existen, usamos valores por defecto (mes y año actual)
        $productId = $request->input('product_id');
        $selectedMonth = $request->input('month', now()->month);
        $selectedYear = $request->input('year', now()->year);

        $product = null;
        $initialStock = 0;
        $kardexData = [];

        // 3. Solo ejecutamos la lógica si se ha seleccionado un producto
        if ($productId) {
            // Buscamos el producto para mostrar su nombre
            $product = Product::withTrashed()->findOrFail($productId);

            // --- CÁLCULO DEL SALDO INICIAL ---
            // Necesitamos el stock consolidado del mes ANTERIOR al solicitado.
            // Creamos una fecha con el primer día del mes solicitado y le restamos un mes.
            $previousMonthDate = Carbon::create($selectedYear, $selectedMonth, 1)->subMonth();
            $previousPeriod = $previousMonthDate->format('Ym'); // Formato 'YYYY-MM' como se guardaría en MonthlyProductStock

            // Buscamos el stock mensual para el producto y el periodo anterior
            $monthlyStock = MonthlyProductStock::where('product_id', $productId)
                ->where('period', $previousPeriod)
                ->first();
            
            // Si encontramos un registro, ese es nuestro saldo inicial. Si no, es 0.
            $initialStock = $monthlyStock ? $monthlyStock->quantity : 0;


            // --- OBTENCIÓN DE MOVIMIENTOS DEL MES ---
            // Buscamos en LocationMovement todos los movimientos para el producto en el mes y año seleccionados.
            $movements = LocationMovement::where('product_id', $productId)
                ->whereYear('operation_date', $selectedYear)
                ->whereMonth('operation_date', $selectedMonth)
                // Hacemos un JOIN con warehouse_movements para obtener la descripción y el operador (1 o -1)
                // Es crucial para saber si es entrada o salida.
                ->join('warehouse_movements', function ($join) {
                    $join->on('location_movements.document_type_code', '=', 'warehouse_movements.document_type_code')
                         ->on('location_movements.warehouse_id', '=', 'warehouse_movements.warehouse_id');
                })
                ->select(
                    'location_movements.*', 
                    'warehouse_movements.description as movement_description', 
                    'warehouse_movements.operator'
                )
                ->orderBy('operation_date', 'asc') // Ordenamos por fecha para que el saldo sea correcto
                ->orderBy('created_at', 'asc') // Un segundo orden por si hay varios movimientos el mismo día
                ->get();

            
            // --- PROCESAMIENTO DE DATOS PARA LA VISTA ---
            // Recorremos los movimientos para calcular el saldo progresivo.
            $currentBalance = $initialStock;
            foreach ($movements as $movement) {
                $entry = 0;
                $exit = 0;

                // Si el operador es 1, es una entrada.
                if ($movement->operator == 1) {
                    $entry = $movement->quantity;
                    $currentBalance += $entry;
                } 
                // Si es -1 (o cualquier otro valor por seguridad), es una salida.
                else {
                    $exit = $movement->quantity;
                    $currentBalance += $exit;
                }

                // Guardamos los datos procesados en un array para la vista.
                $kardexData[] = (object)[
                    'date' => Carbon::parse($movement->operation_date)->format('d/m/Y'),
                    'document_type' => $movement->document_type_code,
                    'description' => $movement->movement_description,
                    'entry' => $entry,
                    'exit' => $exit,
                    'balance' => $currentBalance,
                ];
            }
        }

        // 4. Obtenemos todos los productos para llenar el <select> en el formulario
        $allProducts = Product::orderBy('name')->withTrashed()->get();

        // 5. Devolvemos la vista con todos los datos que necesita
        return view('kardex.index', [
            'allProducts' => $allProducts,
            'selectedProduct' => $product,
            'initialStock' => $initialStock,
            'kardexData' => $kardexData,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
        ]);
    }
}