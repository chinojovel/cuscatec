<?php
namespace App\Imports;

use App\Models\DocumentHeader;
use App\Models\DocumentDetail;
use App\Models\LocationMovement;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WarehouseImport implements ToCollection
{
    protected $warehouseId;

    public function __construct($warehouseId)
    {
        $this->warehouseId = $warehouseId;
    }

    public function collection(Collection $rows)
    {
        $userId = Auth::id() ?? 1;

        DB::beginTransaction(); // Iniciar transacción

        try {
            // Obtener el documento de entrada según la bodega
            $document = DB::table('warehouse_movements')
                ->where('warehouse_id', $this->warehouseId)
                ->where('operator', 1) // 1 = Entrada
                ->first();

            if (!$document) {
                throw new \Exception("No se encontró un documento de entrada para la bodega seleccionada.");
            }

            // Crear encabezado del documento
            $id = DB::table('document_headers')->max('id') + 1;
            $documentHeader = DocumentHeader::create([
                'id'                => $id, // Generar ID único
                'document_type_code'=> $document->document_type_code,
                'warehouse_id'      => $this->warehouseId,
                'ban_estado'        => true,
                'user_gra'          => $userId,
                'user_mod'          => $userId,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            $documentId = $id;
            $documentTypeCode = $documentHeader->document_type_code;

            // Omitir la primera fila (encabezados)
            $rows->shift();

            foreach ($rows as $row) {
                // Crear detalle del documento
                DocumentDetail::create([
                    'document_id'        => $documentId,
                    'document_type_code' => $documentTypeCode,
                    'product_id'         => $row[0],
                    'requested_quantity' => $row[1],
                    'dispatched_quantity'=> 0,
                    'ban_estado'         => true,
                    'user_gra'           => $userId,
                    'user_mod'           => $userId,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);

                // Crear movimiento de ubicación
                LocationMovement::create([
                    'document_id'       => $documentId,
                    'document_type_code'=> $documentTypeCode,
                    'product_id'        => $row[0],
                    'warehouse_id'      => $this->warehouseId,
                    'zone_id'           => 1,
                    'shelf'             => 1,
                    'column'            => 1,
                    'level'             => 1,
                    'quantity'          => $row[1],
                    'month_year'        => Carbon::now()->format('Ym'),
                    'operation_date'    => Carbon::now(),
                    'user_gra'          => $userId,
                    'user_mod'          => $userId,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }

            DB::commit(); // Confirmar transacción si todo sale bien
        } catch (\Exception $e) {
            DB::rollBack(); // Revertir cambios si hay error
            throw $e;
        }
    }
}
