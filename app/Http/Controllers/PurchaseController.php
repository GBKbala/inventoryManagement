<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchasedItem;
use App\Models\InventoryItem;
use App\Models\Supplier;
use \DateTime;
use Illuminate\Support\Facades\Gate;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::denies('purchase')) {
                return redirect('dashboard')->with('error', 'Unauthorized access');
            }
            return $next($request);
        });
    }

    public function index(){
        $items = InventoryItem::all();
        $suppliers = Supplier::all();
        return view('purchase.index', compact('items','suppliers'));
    }

    public function getpurchasedItems(Request $request){
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $fromDateObj = DateTime::createFromFormat('d-m-Y', $fromDate);
        $toDateObj = DateTime::createFromFormat('d-m-Y', $toDate);

        $fromDate = $fromDateObj ? $fromDateObj->format('Y-m-d') : null;
        $toDate = $toDateObj ? $toDateObj->format('Y-m-d') : null;

        // $dispatchedItems = PurchasedItem::with(['inventoryItem','Supplier'])->whereBetween('date', [$fromDate, $toDate])->orderBy('id', 'desc')->get();

        $query = PurchasedItem::with(['inventoryItem', 'Supplier']);

        if ($fromDate && $toDate){
            $query->whereBetween('date', [$fromDate, $toDate]);
        } elseif ($fromDate){
            $query->where('date', '>=', $fromDate);
        } elseif ($toDate){
            $query->where('date', '<=', $toDate);
        }
        $purchasedItems = $query->orderBy('id', 'desc')->get();
        return response()->json($purchasedItems);
    }

    public function store (Request $request){
        $validated = $request->validate([
            'item_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'date' => 'required'
        ],[
            'item_id.required' => 'Item is required',
            'supplier_id.required' => 'Supplier is required',
            'quantity.required' => 'Quantity is required',
            'date.required' => 'Date is required',
        ]);
        $validated['item_id'] = (int) $validated['item_id'];
        $validated['supplier_id'] = (int) $validated['supplier_id'];
        $validated['quantity'] = (int) $validated['quantity'];
        $date = DateTime::createFromFormat('d-m-Y', $validated['date']);
        $validated['date'] = $date->format('Y-m-d');
        
        try{
            // dd($validated);
            $purchaseCreate = PurchasedItem::create($validated);
            if($purchaseCreate){
                $this->addInventoryQuantity($validated['item_id'], $validated['quantity']);
                $return = [
                    'status' => 'success',
                    'message' => 'Purchase item added successfully'
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to add purchase item'
                ];
                return response()->json($return);
            }
        }catch(\Exception $e){
            // dd($e->getMessage());
            $return = [
                'status' => 'error',
                'message' => 'Unable to add purchase item'
            ];
            return response()->json($return);
        }
    }

    public function edit($id){
        $purchasedEdit = PurchasedItem::find($id);
        return response()->json($purchasedEdit);
    }

    public function update(Request $request){
        $validated = $request->validate([
            'item_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'date' => 'required'
        ],[
            'item_id.required' => 'Item is required',
            'supplier_id.required' => 'Supplier is required',
            'quantity.required' => 'Quantity is required',
            'date.required' => 'Date is required',
        ]);
        $validated['item_id'] = (int) $validated['item_id'];
        $validated['supplier_id'] = (int) $validated['supplier_id'];
        $validated['quantity'] = (int) $validated['quantity'];
        $date = DateTime::createFromFormat('d-m-Y', $validated['date']);
        $validated['date'] = $date->format('Y-m-d');
        
        try{
            // dd($validated);
            $purchaseId = $request->purchasedItemId;
            // $inventoryItem = InventoryItem::select('quantity')->where('id', $validated['item_id'])->first();
            // if($inventoryItem->quantity <= $validated['quantity']){
            //     $return = [
            //         'status' => 'error',
            //         'message' => 'Dispatch quantity exceeds available stock'
            //     ];
            //     return response()->json($return);
            // }
            $purchaseItem = PurchasedItem ::find($purchaseId);
            $purchaseUpdate = $purchaseItem->update($validated);
            if($purchaseUpdate){
                $this->addInventoryQuantity($validated['item_id'], $validated['quantity']);
                $return = [
                    'status' => 'success',
                    'message' => 'Purchase item updated successfully'
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to update purchase item'
                ];
                return response()->json($return);
            }
        }catch(\Exception $e){
            // dd($e->getMessage());
            $return = [
                'status' => 'error',
                'message' => 'Unable to update purchase item'
            ];
            return response()->json($return);
        }
    }
    
    public function destroy($id){
        try{

            $purchaseItem = PurchasedItem::find($id);
            $deletePurchaseItem = $purchaseItem->delete();
            if($deletePurchaseItem){
                $return = [
                    'status' => 'success',
                    'message' => 'Purchase item deleted successfully'
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to delete purchase item'
                ];
                return response()->json($return);
            }
        }catch(\Exception $e){
            $return = [
                'status' => 'error',
                'message' => 'Unable to delete purchase item'
            ];
            return response()->json($return);
        }

    }
}
