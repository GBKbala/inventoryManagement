<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\AuditLog;
use App\Imports\ItemsImport;
use App\Exports\ItemsExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Session;

class InventoryItemController extends Controller
{
    public function index(){
        return view('inventoryItems.index');
    }
    
    public function getInventoryItems(Request $request){
        // $inevntoryItems = InventoryItem::latest()->get();

        $searchValue = $request->input('search'); 
        $query = InventoryItem::query();

        if (!empty($searchValue)) {
            $query->where('name', 'LIKE', "%{$searchValue}%")
                  ->orWhere('description', 'LIKE', "%{$searchValue}%")
                  ->orWhere('quantity', 'LIKE', "%{$searchValue}%")
                  ->orWhere('price', 'LIKE', "%{$searchValue}%");
        }

        $inventoryItems = $query->latest()->get();

        return response()->json($inventoryItems);
    }

    public function importExcelFile(Request $request){
        
        $validated = $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv,txt'
        ],[
            'file.required' => 'A file is required to import',
            'file.file' => 'The uploaded file must be a valid file',
            'file.mimes' => 'The file must be of type: xlsx, xls, csv'
        ]);
        try {
            Excel::import(new ItemsImport, $validated['file']);
            return redirect()->route('itemList')->with('success', 'Items imported successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('itemList')->with('error', 'Failed to import items');
        }

    }

    public function export() 
    {
        try{
            $fileName = "Items.xlsx";
            return Excel::download(new ItemsExport,$fileName);
        }catch(\Exception $e){
            return redirect()->route('itemList')->with('error', 'Failed to export items');
        }
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
            'quantity' => 'required',
            'price' => 'required'
        ]);
        // dd($validated);
        try {
            $itemCreate = InventoryItem::create($validated);
            if ($itemCreate) {
                $this->logAction('create', $itemCreate->id, $validated);

                $return = [
                    'status' => 'success',
                    'message' => 'Item added successfully',
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to add item',
                ];
                return response()->json($return);
            }
    
        }catch (\Exception $e) {
            
            $return = [
                'status' => 'error',
                'message' => 'Something went Wrong',
            ];
            return response()->json($return);
        }
    }

    public function edit($id){
        $inevntoryItem = InventoryItem::find($id);
        return response()->json($inevntoryItem);
    }

    public function update(Request $request){
       
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);
        try {
            $itemId = $request->itemId;

            $item = InventoryItem::find($itemId);
            $itemUpdate = $item->update($validated);
            if ($itemUpdate) {
                $this->logAction('update', $itemId, $validated);
                $return = [
                    'status' => 'success',
                    'message' => 'Item updated successfully',
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to add Item',
                ];
                return response()->json($return);
            }
    
        }catch (\Exception $e) {
            $return = [
                'status' => 'error',
                'message' => 'Something went Wrong',
            ];
            return response()->json($return);
        }
    }

    public function destroy(Request $request, $id){
        try {
            $item = InventoryItem::find($id);
            $itemDelete = $item->delete();
            if ($itemDelete) {
                $this->logAction('delete', $id, null);
                $return = [
                    'status' => 'success',
                    'message' => 'Item deleted successfully',
                ];
                return response()->json($return);
            } else {
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to Delete item',
                ];
                return response()->json($return);
            }
        }catch (\Exception $e) {
            dd($e->getMessage());
            $return = [
                'status' => 'error',
                'message' => 'Something wrong!',
            ];
            return response()->json($return);
        }
    }

}
