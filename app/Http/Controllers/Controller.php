<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\InventoryItem;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function addInventoryQuantity($id, $quantity){
        $item = InventoryItem::where('id', $id)->first();
        $itemQuantity = $item->quantity + $quantity;
        $quantityUpdate = $item->update([
            'quantity' =>$itemQuantity
        ]);
    }

    public function deductInventoryQuantity($id, $quantity){
        $item = InventoryItem::where('id', $id)->first();
        $itemQuantity = $item->quantity - $quantity;
        $quantityUpdate = $item->update([
            'quantity' =>$itemQuantity
        ]);
    }
}
