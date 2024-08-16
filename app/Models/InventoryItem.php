<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $table = "inventory_items";

    protected $fillable = [
        'name', 
        'description', 
        'quantity_in_stock', 
        'price'
    ];

    public $timestamps = false;

}
