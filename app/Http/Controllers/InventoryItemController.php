<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItem;
use Session;

class InventoryItemController extends Controller
{
    public function index(){
        $inevntoryItems = InventoryItem::latest()->get();
        return view('inventoryItems.index', compact('inevntoryItems'));
    } 

    public function add (){
        return view('inventoryItems.add');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity_in_stock' => 'required',
            'price' => 'required'
        ]);
        try {
            $itemCreate = InventoryItem::create($validated);
            if ($itemCreate) {
                return redirect('itemList')->with('success', 'Item added successfully');
            }else{
                return back()->with('error', 'Unable to add item');
            }
    
        }catch (\Exception $e) {
            return back()->with('error', 'An error occurred');
        }
    }
}
