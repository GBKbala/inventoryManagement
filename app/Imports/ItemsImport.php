<?php

namespace App\Imports;

use App\Models\InventoryItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsImport implements ToCollection , withHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $item = InventoryItem::where('name' , $row['name'])->first();
            if($item){
                $item->update([
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'quantity' =>  (int) $row['quantity'],
                    'price' =>  (float)$row['price'],
                ]);

            }else{
                InventoryItem::create([
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'quantity' =>  (int) $row['quantity'],
                    'price' =>  (float)$row['price'],
                ]);
            }
            
        }
    }
}
