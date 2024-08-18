@extends('layout.default')
@section('title') Dashboard @endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
    <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Items</h5>
                    <p class="card-text">{{ $dashboardData['totalItemCount']}}</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Purchase</h5>
                    <p class="card-text">{{ $dashboardData['totalPurchaseCount']}}</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Dispatch</h5>
                    <p class="card-text">{{ $dashboardData['totalDispatchCount']}}</p>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection