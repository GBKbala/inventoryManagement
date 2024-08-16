<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function index(){
        return view('inventoryItems.index');
    } 

    public function add (){
        return view('inventoryItems.add');
    }
}
