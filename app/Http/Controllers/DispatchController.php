<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DispatchedItem;
use App\Models\InventoryItem;
use App\Models\Customer;
use \DateTime;
use Illuminate\Support\Facades\Gate;

class DispatchController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::denies('dispatch')) {
                return redirect('dashboard')->with('error', 'Unauthorized access');
            }
            return $next($request);
        });
    }

    public function index(){
        $items = InventoryItem::all();
        $customers = Customer::all();
        return view('dispatch.index', compact('items','customers'));
    }

    public function getDispatchedItems(Request $request){
 
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $fromDateObj = DateTime::createFromFormat('d-m-Y', $fromDate);
        $toDateObj = DateTime::createFromFormat('d-m-Y', $toDate);

        $fromDate = $fromDateObj ? $fromDateObj->format('Y-m-d') : null;
        $toDate = $toDateObj ? $toDateObj->format('Y-m-d') : null;

        // $dispatchedItems = DispatchedItem::with(['inventoryItem','customer'])->orderBy('id', 'desc')->get();

        $query = DispatchedItem::with(['inventoryItem', 'customer']);
        if ($fromDate && $toDate){
            $query->whereBetween('date', [$fromDate, $toDate]);
        } elseif ($fromDate){
            $query->where('date', '>=', $fromDate);
        } elseif ($toDate){
            $query->where('date', '<=', $toDate);
        }
        $dispatchedItems = $query->orderBy('id', 'desc')->get();
        return response()->json($dispatchedItems);
    }

    public function store (Request $request){
        $validated = $request->validate([
            'item_id' => 'required',
            'customer_id' => 'required',
            'quantity' => 'required',
            'date' => 'required'
        ],[
            'item_id.required' => 'Item is required',
            'customer_id.required' => 'Customer is required',
            'quantity.required' => 'Quantity is required',
            'date.required' => 'Date is required',
        ]);
        $validated['item_id'] = (int) $validated['item_id'];
        $validated['customer_id'] = (int) $validated['customer_id'];
        $validated['quantity'] = (int) $validated['quantity'];
        $date = DateTime::createFromFormat('d-m-Y', $validated['date']);
        $validated['date'] = $date->format('Y-m-d');
        
        try{
            // dd($validated);
            $inventoryItem = InventoryItem::select('quantity')->where('id', $validated['item_id'])->first();
            // dd($inventoryItem->quantity);
            // dd($validated['quantity']);
            if($inventoryItem->quantity <= $validated['quantity']){
                $return = [
                    'status' => 'error',
                    'message' => 'Dispatch quantity exceeds available stock'
                ];
                return response()->json($return);
            }
            $dispatchCreate = DispatchedItem::create($validated);
            if($dispatchCreate){
                $this->deductInventoryQuantity($validated['item_id'], $validated['quantity']);
                $return = [
                    'status' => 'success',
                    'message' => 'Dispatch item added successfully'
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to add Dispatch item'
                ];
                return response()->json($return);
            }
        }catch(\Exception $e){
            // dd($e->getMessage());
            $return = [
                'status' => 'error',
                'message' => 'Unable to add Dispatch item'
            ];
            return response()->json($return);
        }
    }

    public function edit($id){
        $dispatchedEdit = DispatchedItem::find($id);
        return response($dispatchedEdit);
    }

    public function update(Request $request){
        $validated = $request->validate([
            'item_id' => 'required',
            'customer_id' => 'required',
            'quantity' => 'required',
            'date' => 'required'
        ],[
            'item_id.required' => 'Item is required',
            'customer_id.required' => 'Customer is required',
            'quantity.required' => 'Quantity is required',
            'date.required' => 'Date is required',
        ]);
        $validated['item_id'] = (int) $validated['item_id'];
        $validated['customer_id'] = (int) $validated['customer_id'];
        $validated['quantity'] = (int) $validated['quantity'];
        $date = DateTime::createFromFormat('d-m-Y', $validated['date']);
        $validated['date'] = $date->format('Y-m-d');
        
        try{
            // dd($validated);
            $dispatchId = $request->dispatchedItemId;
            $inventoryItem = InventoryItem::select('quantity')->where('id', $validated['item_id'])->first();
            // dd($inventoryItem->quantity);
            // dd($validated['quantity']);
            if($inventoryItem->quantity <= $validated['quantity']){
                $return = [
                    'status' => 'error',
                    'message' => 'Dispatch quantity exceeds available stock'
                ];
                return response()->json($return);
            }
            $dispatchItem = DispatchedItem ::find($dispatchId);
            $dispatchUpdate = $dispatchItem->update($validated);
            if($dispatchUpdate){
                $this->deductInventoryQuantity($validated['item_id'], $validated['quantity']);
                $return = [
                    'status' => 'success',
                    'message' => 'Dispatch item updated successfully'
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to update Dispatch item'
                ];
                return response()->json($return);
            }
        }catch(\Exception $e){
            // dd($e->getMessage());
            $return = [
                'status' => 'error',
                'message' => 'Unable to update Dispatch item'
            ];
            return response()->json($return);
        }
    }
    
    public function destroy($id){
        try{

            $dispatchItem = DispatchedItem::find($id);
            $deleteDispatchItem = $dispatchItem->delete();
            if($deleteDispatchItem){
                $return = [
                    'status' => 'success',
                    'message' => 'Dispatch item deleted successfully'
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to delete Dispatch item'
                ];
                return response()->json($return);
            }
        }catch(\Exception $e){
            $return = [
                'status' => 'error',
                'message' => 'Unable to delete Dispatch item'
            ];
            return response()->json($return);
        }

    }
}
