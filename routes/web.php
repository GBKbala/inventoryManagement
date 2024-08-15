<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function(){
    return view('dashboard');
});

Route::get('/productList', function () {
    return view('items.index');
});

Route::get('/',[AuthController::class,'signIn'])->name('signIn');
Route::post('/login', [AuthController:: class, 'login'])->name('login');
Route::get('/signUp', [AuthController::class, 'signUp'])->name('signUp');
Route::post('/register',[AuthController::class,'register'])->name('register');
