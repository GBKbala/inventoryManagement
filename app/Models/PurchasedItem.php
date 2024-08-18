<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\inventoryItem;
use App\Models\Supplier;

class PurchasedItem extends Model
{
    use HasFactory;
    protected $table = 'purchased_items';

    protected $fillable = [
        'item_id',
        'supplier_id',
        'quantity',
        'date'
    ];

    public function InventoryItem(){
        return $this->belongsTo(InventoryItem::class,'item_id','id');
    }

    public function Supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
