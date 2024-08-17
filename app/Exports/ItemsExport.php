<?php

namespace App\Exports;

use App\Models\InventoryItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsExport implements FromCollection, WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InventoryItem::select('name', 'description','quantity', 'price')->get();
    }

    public function headings():array{
        return [
            'name',
            'description',
            'quantity',
            'price'
        ];
    }
}
