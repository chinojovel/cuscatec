<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationMovement;
use App\Models\WarehouseMovement;
use App\Models\Warehouse;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WarehouseImport;
use Illuminate\Support\Facades\DB;

class WarehouseMovementController extends Controller
{
    public function showUploadForm()
    {
        $warehouses = Warehouse::all();
        return view('warehouses.load-products', compact('warehouses'));
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
            'warehouse_id' => 'required|exists:warehouses,id'
        ]);

        try {
            Excel::import(new WarehouseImport($request->warehouse_id), $request->file('file'));
            return back()->with('success', 'Archivo importado correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
    
}
