<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryItemController;

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



Route::get('/productList', function () {
    return view('items.index');
});

Route::get('/',[AuthController::class,'signIn'])->name('signIn');
Route::post('/login', [AuthController:: class, 'login'])->name('login');
Route::get('/signUp', [AuthController::class, 'signUp'])->name('signUp');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/forgetPassword', [AuthController::class,'forgetPassword'])->name('forgetPassword');
Route::post('/sendRestLink', [AuthController::class,'sendRestLink'])->name('sendRestLink');
Route::get('resetPassword/{token}',[AuthController::class,'resetPassword'])->name('resetPassword');
Route::post('resetNewPassword',[AuthController::class,'resetNewPassword'])->name('resetNewPassword');
Route::get('/changePassword',[AuthController::class,'changePassword'])->name('changePassword');

Route::post('/updatePassword',[AuthController::class,'updatePassword'])->name('updatePassword');


Route::middleware(['auth'])->group( function(){

    Route::get('/dashboard', [AuthController::class,'dashboard'])->name('dashboard');

    Route::get('/itemList',[InventoryItemController::class, 'index'])->name('itemList');
    Route::get('addItem',[InventoryItemController::class,'add'])->name('addItem');
    Route::post('storeItem',[InventoryItemController::class,'store'])->name('storeItem');
    Route::get('/editItem/{id}', [InventoryItemController::class,'edit'])->name('editItem');
    Route::put('/updateItem/{id}',[InventoryItemController::class,'update'])->name('updateItem');
    Route::get('/deleteItem/{id}',[InventoryItemController::class,'destroy'])->name('deleteItem');

});