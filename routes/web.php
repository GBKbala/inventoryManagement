<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DashboardController;


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

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::get('/itemList',[InventoryItemController::class, 'index'])->name('itemList');
    Route::get('getInventoryItems', [InventoryItemController::class, 'getInventoryItems'])->name('getInventoryItems');
    Route::get('addItem',[InventoryItemController::class,'add'])->name('addItem');
    Route::post('storeItem',[InventoryItemController::class,'store'])->name('storeItem');
    Route::get('/editItem/{id}', [InventoryItemController::class,'edit'])->name('editItem');
    Route::post('/updateItem',[InventoryItemController::class,'update'])->name('updateItem');
    Route::get('/deleteItem/{id}',[InventoryItemController::class,'destroy'])->name('deleteItem');

    Route::post('/importExcelfile', [InventoryItemController::class,'importExcelFile'])->name('importExcelFile');
    Route::get('/export', [InventoryItemController::class,'export'])->name('export');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/getUsers', [UserController::class, 'getUsers'])->name('getUsers');
    Route::post('storeUser', [UserController::class,'storeUser'])->name('storeUser');
    Route::get('/editUser/{id}', [UserController::class,'editUser'])->name('editUser');
    Route::post('/updateUser',[UserController::class,'updateUser'])->name('updateUser');
    Route::get('/deleteUser/{id}', [UserController::class,'destroyUser'])->name('deleteUser');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('getCustomers',[CustomerController::class, 'getCustomers'])->name('getCustomers');
    Route::post('storeCustomer', [CustomerController::class,'store'])->name('storeCustomer');
    Route::get('/editCustomer/{id}', [CustomerController::class,'edit'])->name('editCustomer');
    Route::post('/updateCustomer',[CustomerController::class,'update'])->name('updateCustomer');
    Route::get('/deleteCustomer/{id}', [CustomerController::class,'destroy'])->name('deleteCustomer');

    Route::get('/dispatchedItems', [DispatchController::class, 'index'])->name('dispatchedItems');
    Route::get('/getDispatchedItems', [DispatchController::class,'getDispatchedItems'])->name('getDispatchedItems');
    Route::post('storeDispatchedItem', [DispatchController::class,'store'])->name('storeDispatchedItem');
    Route::get('editDispatchedItem/{id}', [DispatchController::class, 'edit'])->name('editDispatchedItem');
    Route::post('updateDispatchedItem', [DispatchController::class, 'update'])->name('updateDispatchedItem');
    Route::get('deleteDispatchedItem/{id}', [DispatchController::class,'destroy'])->name('deleteDispatchedItem');


    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
    Route::get('getSuppliers',[SupplierController::class, 'getSuppliers'])->name('getSuppliers');
    Route::post('storeSupplier', [SupplierController::class,'store'])->name('storeSupplier');
    Route::get('/editSupplier/{id}', [SupplierController::class,'edit'])->name('editSupplier');
    Route::post('/updateSupplier',[SupplierController::class,'update'])->name('updateSupplier');
    Route::get('/deleteSupplier/{id}', [SupplierController::class,'destroy'])->name('deleteSupplier');


    Route::get('/purchasedItems', [PurchaseController::class, 'index'])->name('purchasedItems');
    Route::get('/getpurchasedItems', [PurchaseController::class,'getpurchasedItems'])->name('getpurchasedItems');
    Route::post('storePurchasedItem', [PurchaseController::class,'store'])->name('storePurchasedItem');
    Route::get('editPurchasedItem/{id}', [PurchaseController::class, 'edit'])->name('editPurchasedItem');
    Route::post('updatePurchasedItem', [PurchaseController::class, 'update'])->name('updatePurchasedItem');
    Route::get('deletePurchasedItem/{id}', [PurchaseController::class,'destroy'])->name('deletePurchasedItem');


});