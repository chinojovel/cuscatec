<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductTemplateExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::select('id', DB::raw("'' as amount"), 'name')->get();
    }

    public function headings(): array
    {
        return ['id', 'amount', 'name'];
    }
}
