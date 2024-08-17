<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use \DateTime;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(){

        if (Gate::allows('view-user')) {
            return view('users.index');
        }
        // abort(403, 'Unauthorized');
       return redirect('dashboard')->with('error','Unauthorized access');
    }

    public function getUsers(){
        $users = User::where('userRole', '!=', 0)->orderBy('id', 'desc')->get();
        return response()->json($users);
    }


    public function storeUser(Request $request){

        if (!Gate::allows('store-user')) {
            return redirect('dashboard')->with('error','Unauthorized access');
        }
    

        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string',
            'password' => 'required|min:6',
            'mobile' => 'required',
            'dob' => 'required',
            'city' => 'required|string',
            'state' => 'required',
            'address' => 'required',
            'pincode' => 'required'
            
        ],
        [
            'firstname.required' => 'Firstname is required',
            'firstname.string' => 'Firstname must be a valid string',
            'email.required' => 'Email is required',
            'email.unique' => 'This email is already registered',
            'username.required' => 'Username is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters long',
            'dob.required' => 'D.O.B is required',
            'mobile.required' => 'Mobile is required',
            'city.required' => 'City is required',
            'state.required' => 'State is required',
            'address.required' => 'Address is required',
            'pincode.required' => 'Pincode is required',
        ]);
       
        try{
            $validated['password'] = Hash::make($validated['password']);
            $validated['userRole'] = 1;

            $date = DateTime::createFromFormat('d-m-Y', $validated['dob']);
            $validated['dob'] = $date->format('Y-m-d');

            // dd($validated);
            $addUser = User::create($validated);
            if($addUser){
                $return = [
                    'status' => 'success',
                    'message' => 'User added successfully!',
                ];
                return response()->json($return);
            }
            if(!$addUser){
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

    public function editUser($id){
        if (!Gate::allows('edit-user')) {
            return redirect('dashboard')->with('error','Unauthorized access');
        }
        $userEdit = User::find($id);
        return response()->json($userEdit);
    }

    public function updateUser(Request $request){
        if (!Gate::allows('update-user')) {
            return redirect('dashboard')->with('error','Unauthorized access');
        }
        $userId = $request->input('userId');
        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'nullable|string',
            'email' => 'required|email|unique:users,email,'.$userId,
            'username' => 'required|string',
            'password' => 'nullable|min:6',
            'mobile' => 'required',
            'dob' => 'required',
            'city' => 'required|string',
            'state' => 'required',
            'address' => 'required',
            'pincode' => 'required'
            
        ],
        [
            'firstname.required' => 'Firstname is required',
            'firstname.string' => 'Firstname must be a valid string',
            'email.required' => 'Email is required',
            'email.unique' => 'This email is already registered',
            'username.required' => 'Username is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters long',
            'dob.required' => 'D.O.B is required',
            'mobile.required' => 'Mobile is required',
            'city.required' => 'City is required',
            'state.required' => 'State is required',
            'address.required' => 'Address is required',
            'pincode.required' => 'Pincode is required',
        ]);
       
        try{
            $validated['password'] = Hash::make($validated['password']);
            $validated['userRole'] = 1;

            $date = DateTime::createFromFormat('d-m-Y', $validated['dob']);
            $validated['dob'] = $date->format('Y-m-d');

            // dd($validated);

            $user = User::find($userId);
            $userUpdate = $user->update($validated);

            if($userUpdate){
                $return = [
                    'status' => 'success',
                    'message' => 'User updated successfully!',
                ];
                return response()->json($return);
            
            }
            if(!$userUpdate){
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

    public function destroyUser(Request $request, $id){
        if (!Gate::allows('delete-user')) {
            return redirect('dashboard')->with('error','Unauthorized access');
        }
        try{

            $user = User::find($id);
            $userDelete = $user->delete();
            if($userDelete){
                $return = [
                    'status' => 'success',
                    'message' => 'User deleted successfully',
                ];
                return response()->json($return);
            }

            if(!$userDelete){
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
}

