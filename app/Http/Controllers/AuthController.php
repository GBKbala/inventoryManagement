<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Hash;
use Auth;
use Session;
use \DateTime;
use Mail;
use App\Mail\SendEmail;
use Carbon\Carbon;
use DB;

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
            $validated['userRole'] = 2;

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

    public function forgetPassword(){
        return view('auth.forgetPassword');
    }

    public function resetPassword($token){
        return view('auth.resetPassword', compact('token'));
    }

    public function sendRestLink(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::select('email')->where('email',$validated['email'])->first();
        if($user){

            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                "email" => $validated['email'],
                "token" => $token,
                "created_at" => Carbon::now()
            ]);

            $mailData = [
                'token' => $token
            ];
    
            Mail::to($validated['email'])->send(new SendEmail($mailData));
            return redirect('/')->with('success', 'Check your mail for reset link');
        }else{
            return back()->with('error', 'Email not found');
        }
    }

    public function resetNewPassword(Request $request){
        
        $validated = $request->validate([
            'email' => "required|email",
            "password" => "required|confirmed",
            "password_confirmation" => "required"
        ]);
    
        $passwordResetRequest = DB::table('password_reset_tokens')->where('email', $validated['email'])->where('token', $request->token)->first();

        if(!$passwordResetRequest){
            return back()->with('error', 'Invalid Token');
        }

        User::where('email', $validated['email'])->update(["password" => Hash::make($validated['password'])]);

        DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

        return redirect('/')->with('success','Password Updated');
    }

    public function changePassword (){
        return view('auth.changePassword');
    }

    public function updatePassword(Request $request){
        try{

            $validated = $request->validate([
                'oldPassword' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]);
            $validated['password'] = Hash::make($validated['password']);
  
            if (!Hash::check($validated['oldPassword'], Auth::user()->password)) {
                return redirect()->back()->with('error', 'Old Password didn\'t match');
            }
            $userID = $request->userID;
            $user = User::find($userID);
  
            if($user){
                $updatePassword = $user->update([
                    'password' => $validated['password']
                ]);

                if($updatePassword){
                    return redirect('/dashboard')->with('success', 'Password updated successfully');
                }else {
                    return back()->with('error', 'Failed to update password');
                }
            }else{
                return back()->with('error', 'User not found');
            }
        }catch (\Exception $e){
           return back()->with('error', 'Something went wrong');
        }
    }
}
