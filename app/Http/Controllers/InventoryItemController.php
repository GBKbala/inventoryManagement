<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\AuditLog;
use Auth;
use Session;

class InventoryItemController extends Controller
{
    public function index(){
        return view('inventoryItems.index');
    }
    
    public function getInventoryItems(){
        $inevntoryItems = InventoryItem::latest()->get();
        return response()->json($inevntoryItems);
    }

    public function add (){
        return view('inventoryItems.add');
    }

    protected function logAction($action, $itemId, $details = null)
    {
        AuditLog::create([
            'action' => $action,
            'item_id' => $itemId,
            'user_id' => auth()->user()->id,
            'details' => $details ? json_encode($details) : null,
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity_in_stock' => 'required',
            'price' => 'required'
        ]);
        // dd($validated);
        try {
            $itemCreate = InventoryItem::create($validated);
            if ($itemCreate) {
                $this->logAction('create', $itemCreate->id, $validated);
                return redirect('itemList')->with('success', 'Item added successfully');
            }else{
                return back()->with('error', 'Unable to add item');
            }
    
        }catch (\Exception $e) {
            return back()->with('error', 'An error occurred');
        }
    }

    public function edit($id){
        $inevntoryItem = InventoryItem::find($id);
        return view('inventoryItems.edit', compact('inevntoryItem'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity_in_stock' => 'required',
            'price' => 'required'
        ]);
        try {
            $item = InventoryItem::find($id);
            $itemUpdate = $item->update($validated);
            if ($itemUpdate) {
                $this->logAction('update', $id, $validated);
                return redirect('itemList')->with('success', 'Item updated successfully');
            }else{
                return back()->with('error', 'Unable to update item');
            }
    
        }catch (\Exception $e) {
            return back()->with('error', 'An error occurred');
        }
    }

    public function destroy(Request $request, $id){
        try {
            $item = InventoryItem::findOrFail($id);
            $itemDelete = $item->delete();
            if ($itemDelete) {
                $this->logAction('delete', $id);
                return redirect('itemList')->with('success', 'Item deleted successfully');
            } else {
                return redirect('itemList')->with('error', 'Unable to Delete item');
            }
        }catch (\Exception $e) {
            return redirect('itemList')->with('error', 'An error occurred');
        }
    }

}
