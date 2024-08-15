<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;

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
            'password' => 'required|min:6',
            
        ]);
    }
}
