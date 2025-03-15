@extends('layouts.admin')
@section('content')
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">

        <div class="row g-4 ">
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Users</h6>
                        <h2 class="m-0 fw-bold num-counter">{{$body['total_user']}}</h2>
                    </div>
                    <i class="fa-solid fa-users fs-1 text-secondary"></i>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Products</h6>
                        <h2 class="m-0 fw-bold num-counter">{{$body['total_product']}}</h2>
                    </div>
                    <i class="fa-solid fa-users fs-1 text-secondary"></i>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Receive Orders</h6>
                        <h2 class="m-0 fw-bold num-counter">{{$body['receive_order']}}</h2>
                    </div>
                    <i class="fa-solid fa-users fs-1 text-secondary"></i>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Getting Ready Orders</h6>
                        <h2 class="m-0 fw-bold num-counter">{{$body['getting_ready_order']}}</h2>
                    </div>
                    <i class="fa-solid fa-users fs-1 text-secondary"></i>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Shipped Orders</h6>
                        <h2 class="m-0 fw-bold num-counter">{{$body['shipped_order']}}</h2>
                    </div>
                    <i class="fa-solid fa-users fs-1 text-secondary"></i>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Complete Orders</h6>
                        <h2 class="m-0 fw-bold num-counter">{{ $body['Complete_order'] }}</h2>
                    </div>
                    <i class="fa-solid fa-ticket fs-1 text-secondary"></i>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Cancelled Orders</h6>
                        <h2 class="m-0 fw-bold num-counter">{{ $body['Cancelled_order'] }}</h2>
                    </div>
                    <i class="fa-solid fa-ticket fs-1 text-secondary"></i>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Refund Initiated Orders</h6>
                        <h2 class="m-0 fw-bold num-counter">{{ $body['initiated_order'] }}</h2>
                    </div>
                    <i class="fa-solid fa-ticket fs-1 text-secondary"></i>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Refunded Orders</h6>
                        <h2 class="m-0 fw-bold num-counter">{{ $body['Refunded_order'] }}</h2>
                    </div>
                    <i class="fa-solid fa-ticket fs-1 text-secondary"></i>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Ready To Ship Orders</h6>
                        <h2 class="m-0 fw-bold num-counter">{{$body['total_ready_to_ship']}}</h2>
                    </div>
                    <i class="fa-solid fa-users fs-1 text-secondary"></i>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Solitaire Orders</h6>
                        <h2 class="m-0 fw-bold num-counter">{{$body['total_solitaire']}}</h2>
                    </div>
                    <i class="fa-solid fa-users fs-1 text-secondary"></i>
                </div>
            </div> --}}
           
            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-between align-items-center gap-2 bg-light border p-3">
                    <div class="text-dark">
                        <h6 class="text-uppercase fw-light fs-14">Total Earnings Amount</h6>
                        <h2 class="m-0 fw-bold num-counter">{{ \General::currency_format($body['Earnings_order']) }}</h2>
                    </div>
                    <i class="fa-solid fa-arrow-right-arrow-left fs-1 text-secondary"></i>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')
@stop