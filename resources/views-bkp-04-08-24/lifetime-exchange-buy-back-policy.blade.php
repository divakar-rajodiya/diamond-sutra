@extends('layouts.site')
@section('content')

<main>
    <div class="page-title">
        <div class="container">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
                        <li class="breadcrumb-item"><a href="#">Lifetime Exchange & Buy-Back Policy</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="py-sm-5 py-4 fs-14">
        <div class="container">
            <div class="mb-4">
                <p class="mb-2">We offer Lifetime Exchange & Buy Back on all purchases*. The exchange/buy back value will be calculated as per the current market value on the day the exchange request is raised. ₹ 500 processing charges for shipping and handling, along with any applicable deductions as mentioned below</p>
                <p class="mb-2">For solitaire jewelry, if the solitaire certificate(s) is missing, then a standard deduction of ₹ 3500 will be applicable per certificate. For larger solitaires, the deduction may be higher than ₹ 3500 based on the size.</p>
            </div>
            <div class="mb-4">
                <h6 class="fw-bold border-bottom mb-2 pb-2">Lifetime Exchange</h6>
                <p class="mb-2">If you choose to avail Lifetime Exchange on your purchase, you can chose to select any product of the same or higher amount and we will adjust your purchase amount against the new bill. If the new amount is higher you will be required to settle the remaining balance.</p>
            </div>
            <div class="mb-4">
                <h6 class="fw-bold border-bottom mb-2 pb-2">Lifetime Buy-Back</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><b>CATEGORY</b></th>
                                <th scope="col"><b>EXCHANGE VALUE</b></th>
                                <th scope="col"><b>BUYBACK VALUE</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Diamond & Gemstone jewelry</td>
                                <td>
                                    <p class="m-0">100% of gold value at current market rate</p>
                                    <p class="m-0">100% of diamond/gemstone value at current market rate</p>
                                </td>
                                <td>
                                    <p class="m-0">100% of gold value at current market rate</p>
                                    <p class="m-0">90% of diamond/gemstone value at current market rate</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Plain Gold jewelry</td>
                                <td>
                                    <p class="m-0">100% of gold value at current market rate</p>
                                </td>
                                <td>
                                    <p class="m-0">100% of gold value at current market rate</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Solitaire jewelry</td>
                                <td>
                                    <p class="m-0">100% of gold value at current market rate</p>
                                    <p class="m-0">100% of diamond/gemstone value at current market rate</p>
                                    <p class="m-0">85% of solitaire value at current market rate (Up to INR 4 lakh)</p>
                                </td>
                                <td>
                                    <p class="m-0">100% of gold value at current market rate</p>
                                    <p class="m-0">90% of solitaire value at current market rate (Up to INR 4 lakh)</p>
                                    <p class="m-0">List your solitaire and get current market rate subject to someone purchasing your solitaire (Above INR 4 Lakh)</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@stop
@section('footer')
@stop