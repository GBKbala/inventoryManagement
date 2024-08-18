<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(){
        return view('supplier.index');
    }

    public function getSuppliers(){
        $suppliers = Supplier::latest()->get();
        return response()->json($suppliers);
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required'
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'This email is already registered',
            'mobile.required' => 'Mobile is required',
            'address.required' => 'Address is required',
        ]);
        try{

            $supplierCreate = Supplier::create($validated);
            if($supplierCreate){
                $return = [
                    'status' => 'success',
                    'message' => 'Supplier added successfully'
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to add went supplier'
                ];
                return response()->json($return);
            }
        }
        catch(\Exception $e){
            dd($e->getMessage());
            $return = [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
            return response()->json($return);
        }
    }

    public function edit($id){
        $supplierEdit = Supplier::find($id);
        return response()->json($supplierEdit);
    } 

    public function update(Request $request){
        // if (!Gate::allows('update-user')) {
        //     return redirect('dashboard')->with('error','Unauthorized access');
        // }
        $supplierId = $request->input('supplierId');
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:suppliers,email,'.$supplierId,
            'mobile' => 'required',
            'address' => 'required',
        ],
        [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'This email is already registered',
            'mobile.required' => 'Mobile is required',
            'address.required' => 'Address is required',
        ]);
       
        try{
            // dd($validated);
            $supplier = Supplier::find($supplierId);
            $supplierUpdate = $supplier->update($validated);

            if($supplierUpdate){
                $return = [
                    'status' => 'success',
                    'message' => 'Supplier updated successfully!',
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Something wrong!',
                ];
                return response()->json($return);
            }

        }catch(\Exception $e){
            $return = [
                'status' => 'error',
                'message' => 'Something wrong!',
            ];
            return response()->json($return);
        }
    }

    public function destroy(Request $request, $id){
        // if (!Gate::allows('delete-user')) {
        //     return redirect('dashboard')->with('error','Unauthorized access');
        // }
        try{

            $supplier = Supplier::find($id);
            $supplierDelete = $supplier->delete();
            if($supplierDelete){
                $return = [
                    'status' => 'success',
                    'message' => 'Supplier deleted successfully',
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Something wrong!',
                ];
                return response()->json($return);
            }
        }catch(\Exception $e){
            // dd($e->getMessage());
            $return = [
                'status' => 'error',
                'message' => 'Something wrong!',
            ];
            return response()->json($return);
        } 
    }
}
