<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Session;
use \DateTime;

class AuthController extends Controller
{
    public function signIn(){
        return view('auth.signIn');
    }

    public function login (Request $request){
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        try{
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->intended('dashboard')->withSuccess('You have Successfully loggedin');
            }
            return redirect("/")->with('error','Invalid credentials');
        }catch(\Exception $e){
            return redirect("/")->with('error','An error occurred. Please try again later');
        }
    }

    public function signUp(){
        return view('auth.signUp');  
    }

    public function register(Request $request){
        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string',
            'password' => 'required|min:6|confirmed',
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
            'password.confirmed' => 'Passwords do not match',
            'dob.required' => 'D.O.B is required',
            'mobile.required' => 'Mobile is required',
            'city.required' => 'City is required',
            'state.required' => 'State is required',
            'address.required' => 'Address is required',
            'pincode.required' => 'Pincode is required',
        ]);
       
        try{
            $validated['password'] = Hash::make($validated['password']);

            $date = DateTime::createFromFormat('d-m-Y', $validated['dob']);
            $validated['dob'] = $date->format('Y-m-d');

            // dd($validated);
            $register = User::create($validated);
                return redirect('/')->with('success','You have registered successfully.Please Login');
            if($register){
                return back()->with('error','Something wrong!');
            }

        }catch(\Exception $e){
            return back()->with('error','Something wrong!');
        }
       
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/')->with('success','You have logged out');
    }
}
