<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchasedItem;
use App\Models\InventoryItem;
use App\Models\DispatchedItem;
use App\Models\Supplier;
use App\Models\Customer;
use DB;

class DashboardController extends Controller
{
    public function index(){

        $totalItemCount = InventoryItem::count();
        $totalPurchaseCount = PurchasedItem::count();
        $totalDispatchCount = DispatchedItem::count();

        $dashboardData = [
            'totalItemCount' =>$totalItemCount,
            'totalPurchaseCount' =>$totalPurchaseCount,
            'totalDispatchCount' =>$totalDispatchCount
        ];

        return view('dashboard',compact('dashboardData'));
    }
}
