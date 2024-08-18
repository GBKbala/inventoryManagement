<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\inventoryItem;
use App\Models\Customer;

class DispatchedItem extends Model
{
    use HasFactory;
    protected $table = 'dispatched_items';

    protected $fillable = [
        'item_id',
        'customer_id',
        'quantity',
        'date'
    ];

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class, 'item_id', 'id');
    }

    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
