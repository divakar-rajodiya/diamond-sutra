@extends('layouts.site')

@section('header')

<style>
.subtitle {
    font-size: 24px;
    color: #666;
    margin-bottom: 20px;
}

.description {
    font-size: 18px;
    margin-bottom: 20px;
}

.action {
    margin-bottom: 20px;
}

.action p {
    font-weight: bold;
}

.action ul {
    list-style-type: none;
    padding: 0;
}

.apology {
    font-size: 16px;
    color: #888;
}
</style>

@section('content')
<main>
    <div>
        <div class="container-fluid py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xxl-8">
                    <div class="order-failed-wrapper text-center">
                        
                        <h1>Order Failed</h1>
                        <p class="subtitle">Oops! Something Went Wrong</p>
                        <p class="description">We're sorry, but your order couldn't be processed at this time.</p>
                        <div class="mt-4 mb-4">
                            <a href="{{asset('/')}}" class="btn primary-btn large-btn text-uppercase">Back to Home</a>
                        </div>
                        
                        <div class="action">
                            <p>Call to Action:</p>
                            <ul>
                                <li>Please double-check your payment details and try again.</li>
                                <li>Contact customer support for assistance.</li>
                            </ul>
                        </div>
                        <p class="apology">We apologize for any inconvenience.</p>
        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop
@section('footer')

@stop