<?php

namespace App\Http\Controllers;

use App\Exports\ProductTemplateExport;
use App\Models\Location;
use App\Models\State;
use App\Models\Warehouse;
use App\Models\WarehouseMovement;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::with('state')->paginate(10);
        return view('warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        $states = State::all();
        return view('warehouses.create', compact('states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'state_id' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            // Crear el almacén
            $warehouse = Warehouse::create([
                'name' => $request->name,
                'address' => $request->address,
                'state_id' => 1,
                'ban_estado' => true,
                'user_gra' => Auth::id(), // Ajustar según autenticación
                'user_mod' => Auth::id(), // Ajustar según autenticación
            ]);

            // Crear la zona
            $zone = Zone::create([
                'warehouse_id' => $warehouse->id,
                'name' => 'Storage Zone A',
                'ban_estado' => true,
                'user_gra' => Auth::id(),
                'user_mod' => Auth::id(),
            ]);

            // Crear la ubicación
            Location::create([
                'warehouse_id' => $warehouse->id,
                'zone_id' => $zone->id,
                'shelf' => 1,
                'column' => 1,
                'level' => 1,
                'ban_estado' => true,
                'user_gra' => Auth::id(),
                'user_mod' => Auth::id(),
            ]);

            // Crear los movimientos de entrada y salida
            WarehouseMovement::insert([
                [
                    'warehouse_id' => $warehouse->id,
                    'document_type_code' => 'IN01',
                    'description' => 'Ingreso de productos al almacén',
                    'operator' => 1,
                    'ban_estado' => true,
                    'user_gra' => Auth::id(),
                    'user_mod' => Auth::id(),
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'warehouse_id' => $warehouse->id,
                    'document_type_code' => 'OUT01',
                    'description' => 'Salida de productos por venta en almacén',
                    'operator' => -1,
                    'ban_estado' => true,
                    'user_gra' => Auth::id(),
                    'user_mod' => Auth::id(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);

            DB::commit();
            return redirect()->route('administration.warehouse.index')->with('success', 'Warehouse created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Warehouse: ' . $e->getMessage())->withInput();
        }
    }

    public function export()
    {
        return Excel::download(new ProductTemplateExport, 'plantilla_ingreso_productos.xlsx');
    }
}
