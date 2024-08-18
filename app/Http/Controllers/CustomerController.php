<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(){
        return view('customer.index');
    }

    public function getCustomers(){
        $customers = Customer::latest()->get();
        return response()->json($customers);
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

            $customerCreate = Customer::create($validated);
            if($customerCreate){
                $return = [
                    'status' => 'success',
                    'message' => 'Customer added successfully'
                ];
                return response()->json($return);
            }else{
                $return = [
                    'status' => 'error',
                    'message' => 'Unable to add went customer'
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
        $customerEdit = Customer::find($id);
        return response()->json($customerEdit);
    } 

    public function update(Request $request){
        // if (!Gate::allows('update-user')) {
        //     return redirect('dashboard')->with('error','Unauthorized access');
        // }
        $customerId = $request->input('customerId');
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email,'.$customerId,
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
            $customer = Customer::find($customerId);
            $customerUpdate = $customer->update($validated);

            if($customerUpdate){
                $return = [
                    'status' => 'success',
                    'message' => 'Customer updated successfully!',
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

            $customer = Customer::find($id);
            $customerDelete = $customer->delete();
            if($customerDelete){
                $return = [
                    'status' => 'success',
                    'message' => 'Customer deleted successfully',
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
