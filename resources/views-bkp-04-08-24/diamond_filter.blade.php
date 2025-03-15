@extends('layouts.site')
@section('header')
<style>
    .cut-option input[type="checkbox"] {
        display: none;
    }

    .cut-option.active {
        background-color: black;
        color: #fff;
    }

    .cut-option {
        margin-right: 2px;
        margin-bottom: 2px;
    }
</style>
@stop

@section('content')
@php
$displayFirstStep = 1;
$displaySecondStep = 0;
$displayThirdStep = 0;
$diamondSelected = $body['diamond_selected'];
$productSelected = $body['product_selected'];
$selectedProduct = $body['selected_product'];
$selectedDiamond = $body['selected_diamond'];
if($diamondSelected){
$displayFirstStep = 0;
$displaySecondStep = 1;
if($productSelected){
$displayFirstStep = 0;
$displaySecondStep = 0;
$displayThirdStep = 1;
}
}
@endphp

<main>
    <div class="page-title mb-3">
        <div class="page-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Design your own Solitaire {{$body['step2_title']}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <ul class="nav nav-tabs custom-ring-nav" id="myTab" role="tablist">
            <li class="nav-item">
                <button {{$displayFirstStep==1 ? '' : 'disabled'}} class="nav-link {{$displayFirstStep==1 ? 'active' : ''}}" id="choose-diamond-tab" data-bs-toggle="tab" data-bs-target="#choose-diamond" type="button" role="tab" aria-controls="choose-diamond" aria-selected="{{$displayFirstStep==1 ? 'true' : 'false'}}">
                    <div class="ring-step">
                        <div class="d-flex align-items-center gap-1">
                            <div class="step-number">
                                <span>1</span>
                            </div>
                            <div class="step-title">
                                <span>Choose a</span>
                                <h4>DIAMOND</h4>
                            </div>
                        </div>
                        <div class="step-ring">
                            <span style="font-size: 0px; fill: rgb(198, 200, 206); width: 21px">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.94 12.42">
                                    <path d="M13.46,0h-11L0,3.16l8,9.26,8-9.26L13.46,0ZM8,9.55,2.62,3.38,3.77,1.76h8.4l1.15,1.62Z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </button>
            </li>
            <li class="nav-item">
                <button {{$displaySecondStep==1 ? '' : 'disabled'}} class="nav-link {{$displaySecondStep==1 ? 'active' : ''}}" id="setting-diamond-tab" data-bs-toggle="tab" data-bs-target="#setting-diamond" type="button" role="tab" aria-controls="setting-diamond" aria-selected="{{$displaySecondStep==1 ? 'true' : 'false'}}">
                    <div class="ring-step">
                        <div class="d-flex align-items-center gap-1">
                            <div class="step-number">
                                <span>2</span>
                            </div>
                            <div class="step-title">
                                <span>Choose a</span>
                                <h4>Setting</h4>
                            </div>
                        </div>
                        <div class="step-ring">
                            <span style="fill: rgb(198, 200, 206); width: 21px">
                                @if(isset($_GET['cat']) && $_GET['cat'] == 'pendants')
                                <span class="pendant-icon-svg" style="font-size: 0px; fill: rgb(198, 200, 206); width: 21px">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.23 26.33">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: #c4c6cc;
                                                }
                                            </style>
                                        </defs>
                                        <title>Asset 3</title>
                                        <g id="Layer_2" data-name="Layer 2">
                                            <g id="OBJECTS">
                                                <path class="cls-1" d="M30.15,0a11.34,11.34,0,0,1-.79,5.64A13.52,13.52,0,0,1,26,10.41a15.62,15.62,0,0,1-5,3.08,17.56,17.56,0,0,1-5.83,1,17.37,17.37,0,0,1-5.84-1,15.28,15.28,0,0,1-5-3.08A13.39,13.39,0,0,1,.87,5.64,11.34,11.34,0,0,1,.08,0,13.52,13.52,0,0,0,5.35,9.1a16.12,16.12,0,0,0,9.77,3.25A16,16,0,0,0,24.88,9.1,13.5,13.5,0,0,0,30.15,0Z" />
                                                <path class="cls-1" d="M15.12,14.54,10,17.49v5.89l5.1,2.95,5.09-2.95V17.49Zm2.44,3.79-1.84-1.06v-1l2.69,1.56Zm-2.44,4.24-1.85-1.06V19.37l1.85-1.07L17,19.37v2.14Zm-.61-5.31-1.84,1.07-.85-.49,2.69-1.56Zm-2.44,2.11v2.14l-.85.49V18.88Zm.6,3.18,1.84,1.06v1L11.82,23Zm3.05,1.06,1.84-1.06.85.49L15.72,24.6Zm2.44-2.1V19.37l.85-.49V22Z" />
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                                @else
                                <span class="ring-icon-svg" style="font-size: 0px; fill: rgb(198, 200, 206); width: 21px">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 30">
                                        <g>
                                            <g>
                                                <path fill="#c6c8ce" d="M17.27 19.336c0-4.13-3.286-7.477-7.34-7.477-4.053 0-7.34 3.348-7.34 7.477 0 4.13 3.287 7.477 7.34 7.477 4.054 0 7.34-3.347 7.34-7.477zM12.416 9.204c4.257 1.152 7.4 5.166 7.401 9.946 0 5.68-4.436 10.285-9.909 10.285-5.472 0-9.908-4.605-9.908-10.285 0-4.913 3.32-9.019 7.759-10.038L4.896 5.906l1.28-1.523 3.915 4.079 3.912-4.08 1.359 1.524-2.945 3.298zm-2.326-1.92L4.91 2.25 6.523.53h7.136l1.611 1.718z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                                @endif
                            </span>
                        </div>
                    </div>
                </button>
            </li>
            <li class="nav-item">
                <button {{$displayThirdStep==1 ? '' : 'disabled'}} class="nav-link {{$displayThirdStep==1 ? 'active' : ''}}" id="ring-step-tab" data-bs-toggle="tab" data-bs-target="#ring-step" type="button" role="tab" aria-controls="ring-step" aria-selected="{{$displayThirdStep==1 ? 'true' : 'false'}}">
                    <div class="ring-step">
                        <div class="d-flex align-items-center gap-1">
                            <div class="step-number">
                                <span>3</span>
                            </div>
                            <div class="step-title">
                                <span>Complete</span>
                                @if(isset($_GET['cat']) && $_GET['cat'] == 'pendants')
                                <h4 id="step-3-name">Pendant</h4>
                                @else
                                <h4 id="step-3-name">Ring</h4>
                                @endif
                            </div>
                        </div>
                        <div class="step-ring">
                            @if(isset($_GET['cat']) && $_GET['cat'] == 'pendants')
                            <span class="pendant-icon-svg" style="font-size: 0px; fill: rgb(198, 200, 206); width: 21px">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.23 26.33">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: #c4c6cc;
                                            }
                                        </style>
                                    </defs>
                                    <title>Asset 3</title>
                                    <g id="Layer_2" data-name="Layer 2">
                                        <g id="OBJECTS">
                                            <path class="cls-1" d="M30.15,0a11.34,11.34,0,0,1-.79,5.64A13.52,13.52,0,0,1,26,10.41a15.62,15.62,0,0,1-5,3.08,17.56,17.56,0,0,1-5.83,1,17.37,17.37,0,0,1-5.84-1,15.28,15.28,0,0,1-5-3.08A13.39,13.39,0,0,1,.87,5.64,11.34,11.34,0,0,1,.08,0,13.52,13.52,0,0,0,5.35,9.1a16.12,16.12,0,0,0,9.77,3.25A16,16,0,0,0,24.88,9.1,13.5,13.5,0,0,0,30.15,0Z" />
                                            <path class="cls-1" d="M15.12,14.54,10,17.49v5.89l5.1,2.95,5.09-2.95V17.49Zm2.44,3.79-1.84-1.06v-1l2.69,1.56Zm-2.44,4.24-1.85-1.06V19.37l1.85-1.07L17,19.37v2.14Zm-.61-5.31-1.84,1.07-.85-.49,2.69-1.56Zm-2.44,2.11v2.14l-.85.49V18.88Zm.6,3.18,1.84,1.06v1L11.82,23Zm3.05,1.06,1.84-1.06.85.49L15.72,24.6Zm2.44-2.1V19.37l.85-.49V22Z" />
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            @else
                            <span class="ring-icon-svg" style="font-size: 0px; fill: rgb(198, 200, 206); width: 21px">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 30">
                                    <g>
                                        <g>
                                            <path fill="#c6c8ce" d="M17.27 19.336c0-4.13-3.286-7.477-7.34-7.477-4.053 0-7.34 3.348-7.34 7.477 0 4.13 3.287 7.477 7.34 7.477 4.054 0 7.34-3.347 7.34-7.477zM12.416 9.204c4.257 1.152 7.4 5.166 7.401 9.946 0 5.68-4.436 10.285-9.909 10.285-5.472 0-9.908-4.605-9.908-10.285 0-4.913 3.32-9.019 7.759-10.038L4.896 5.906l1.28-1.523 3.915 4.079 3.912-4.08 1.359 1.524-2.945 3.298zm-2.326-1.92L4.91 2.25 6.523.53h7.136l1.611 1.718z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            @endif
                            </span>
                        </div>
                    </div>
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade {{$displayFirstStep==1 ? 'show active' : ''}} step-2" id="choose-diamond" role="tabpanel" aria-labelledby="choose-diamond-tab">
                <div class="choose-setting-wrapper mx-2">
                    <ul class="nav nav-tabs diamond-created-tab" id="chooseSetting" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="earth-diamond" data-bs-toggle="tab" data-bs-target="#earthDiamond" type="button" role="tab" aria-controls="earthDiamond" aria-selected="true"><i class="fa-solid fa-gem"></i> Earth-Created <span class="d-none d-md-block">Diamonds</span></button>
                        </li>
                        <!-- <li class="nav-item">
                            <button disabled title="Coming soon" class="nav-link" id="lab-diamond" data-bs-toggle="tab" data-bs-target="#labDiamond" type="button" role="tab" aria-controls="labDiamond" aria-selected="false"><i class="fa-solid fa-gem"></i> Lab-Created <span class="d-none d-md-block">Diamonds</span></button>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="chooseSettingContent">
                        <div class="tab-pane fade show active" id="earthDiamond" role="tabpanel" aria-labelledby="earth-diamond">
                            <div class="diamond-option-wrapper">
                                <div class="row gy-4 gy-lg-5">
                                    <div class="col-lg-12">
                                        <div class="diamond-filter-option">
                                            <h2>shape <i class="fa-regular fa-circle-question" data-toggle="tooltip" data-placement="top" title="Popular picks: Round, Cushion, Pear, Princess, Oval."></i></h2>
                                            <div class="cut-filter-options">
                                                <label class="cut-option btn btn-outline-secondary shape-opt active">
                                                    <input type="checkbox" name="shapeOption" value="Round" class="shape-option-input" checked>
                                                    <span><img src="{{url('public/assets/img/shape/round.png')}}"> Round</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Pear" class="shape-option-input">
                                                    <span><img src="{{url('public/assets/img/shape/pear.png')}}">Pear</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Heart" class="shape-option-input">
                                                    <span><img src="{{url('public/assets/img/shape/heart.png')}}">Heart</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Princess" class="shape-option-input">
                                                    <span><img src="{{url('public/assets/img/shape/princess.png')}}">Princess</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Emerald" class="shape-option-input">
                                                    <span><img src="{{url('public/assets/img/shape/emerald.png')}}">Emerald</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Cushion" class="shape-option-input">
                                                    <span><img src="{{url('public/assets/img/shape/cushion.png')}}">Cushion</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Marquise" class="shape-option-input">
                                                    <span><img src="{{url('public/assets/img/shape/marquise.png')}}">Marquise</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Oval" class="shape-option-input">
                                                    <span><img src="{{url('public/assets/img/shape/oval.png')}}">Oval</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Radiant" class="shape-option-input">
                                                    <span><img src="{{url('public/assets/img/shape/radiant.png')}}">Radiant</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Trilliant" class="shape-option-input">
                                                    <span><img src="{{url('public/assets/img/shape/trilliant.png')}}">Trilliant</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="diamond-filter-option">
                                            <h2>Color <i class="fa-regular fa-circle-question" title="Seek brilliance: Opt for near colourless. Best value: G-I colour range."></i></h2>
                                            <div class="cut-filter-options">
                                                <label class="cut-option btn btn-outline-secondary color-opt">
                                                    <input type="checkbox" name="colorOption" value="D" class="color-option-input">
                                                    <span>D</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary color-opt">
                                                    <input type="checkbox" name="colorOption" value="E" class="color-option-input">
                                                    <span>E</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary color-opt">
                                                    <input type="checkbox" name="colorOption" value="F" class="color-option-input">
                                                    <span>F</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary color-opt">
                                                    <input type="checkbox" name="colorOption" value="G" class="color-option-input">
                                                    <span>G</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary color-opt">
                                                    <input type="checkbox" name="colorOption" value="H" class="color-option-input">
                                                    <span>H</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary color-opt">
                                                    <input type="checkbox" name="colorOption" value="I" class="color-option-input">
                                                    <span>I</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary color-opt">
                                                    <input type="checkbox" name="colorOption" value="J" class="color-option-input">
                                                    <span>J</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary color-opt">
                                                    <input type="checkbox" name="colorOption" value="K" class="color-option-input">
                                                    <span>K</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="diamond-filter-option">
                                            <h2>Cut <i class="fa-regular fa-circle-question" title="Sparkle factor: Excellent to Very Good cuts deliver brilliance."></i></h2>
                                            <div class="cut-filter-options">
                                                <label class="cut-option btn btn-outline-secondary cut-opt">
                                                    <input type="checkbox" name="cutOption" value="fair" class="cut-option-input">
                                                    <span>Fair</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary cut-opt">
                                                    <input type="checkbox" name="cutOption" value="G" class="cut-option-input">
                                                    <span>Good</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary cut-opt">
                                                    <input type="checkbox" name="cutOption" value="VG" class="cut-option-input">
                                                    <span>Very Good</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary cut-opt">
                                                    <input type="checkbox" name="cutOption" value="EX" class="cut-option-input">
                                                    <span>Excellent</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary cut-opt">
                                                    <input type="checkbox" name="cutOption" value="ID" class="cut-option-input">
                                                    <span>Ideal</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="diamond-filter-option">
                                            <h2>Clarity<i class="fa-regular fa-circle-question" title="Seek perfection: Choose between SI1-VS1 clarity for best value, considering natural inclusions."></i></h2>
                                            <div class="cut-filter-options">
                                                <label class="cut-option btn btn-outline-secondary clarity-opt">
                                                    <input type="checkbox" name="clarityOption" value="I1" class="clarity-option-input">
                                                    <span>I1</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary clarity-opt">
                                                    <input type="checkbox" name="clarityOption" value="SI2" class="clarity-option-input">
                                                    <span>SI2</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary clarity-opt">
                                                    <input type="checkbox" name="clarityOption" value="SI1" class="clarity-option-input">
                                                    <span>SI1</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary clarity-opt">
                                                    <input type="checkbox" name="clarityOption" value="VS2" class="clarity-option-input">
                                                    <span>VS2</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary clarity-opt">
                                                    <input type="checkbox" name="clarityOption" value="VS1" class="clarity-option-input">
                                                    <span>VS1</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary clarity-opt">
                                                    <input type="checkbox" name="clarityOption" value="VVS2" class="clarity-option-input">
                                                    <span>VVS2</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary clarity-opt">
                                                    <input type="checkbox" name="clarityOption" value="VVS1" class="clarity-option-input">
                                                    <span>VVS1</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary clarity-opt">
                                                    <input type="checkbox" name="clarityOption" value="IF" class="clarity-option-input">
                                                    <span>IF</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary clarity-opt">
                                                    <input type="checkbox" name="clarityOption" value="FL" class="clarity-option-input">
                                                    <span>FL</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="diamond-filter-option">
                                            <h2>Carat<i class="fa-regular fa-circle-question" title="Size matters: Above 0.5 carat shines beautifully."></i></h2>

                                            <!-- <div class="w-100">
                                                <div class="slider">
                                                    <div class="progress" id="carat-progress"></div>
                                                </div>
                                                <div class="range-input" id="carat-range-input">
                                                    <input type="range" class="range-min" id="carat-min-range" min="0" max="10000" value="0" step="0.001">
                                                    <input type="range" class="range-max" id="carat-max-range" min="0" max="10000" value="10000" step="0.001">
                                                </div>
                                                <div class="price-input" id="carat-input">
                                                    <div class="field">
                                                        <input type="number" id="carat-min" class="input-min" value="0">
                                                    </div>
                                                    <div class="field">
                                                        <input type="number" id="carat-max" class="input-max" value="1000">
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div class="w-100">
                                                <div class="slider">
                                                    <div id="carat-slider-range" class="progress"></div>
                                                </div>
                                                <div class="price-input" id="carat-input">
                                                    <div class="field">
                                                        <input type="number" id="carat-min" class="input-min" value="0">
                                                    </div>
                                                    <div class="field">
                                                        <input type="number" id="carat-max" class="input-max" value="1000">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="diamond-filter-option">
                                            <h2>price<i class="fa-regular fa-circle-question" title="Stay within budget: Explore options from affordable to luxurious."></i></h2>
                                            <div class="w-100">
                                                <div class="slider">
                                                    <div id="price-slider-range" class="progress"></div>
                                                </div>
                                                <div class="price-input" id="price-input">
                                                    <div class="field">
                                                        <input type="number" id="price-min" class="input-min" value="0">
                                                    </div>
                                                    <div class="field">
                                                        <input type="number" id="price-max" class="input-max" value="1000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="advance-filter mt-4 mt-md-5">
                                <div class="d-flex justify-content-between">
                                    <div class="advance-filter-in">
                                        <ul class="advance-filter-list d-flex flex-wrap align-items-center gap-2 mb-0 list-unstyled">
                                            <li>
                                                <button class="advance-btn">
                                                    <span>Advanced Options</span>
                                                    <i class="fa-solid fa-circle-plus fa-circle-minus"></i>
                                                </button>
                                            </li>
                                            <ul class="advance-filter-list-in flex-wrap align-items-center gap-2 mb-0 list-unstyled">
                                                <li>
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button" id="polishDropdown" data-bs-toggle="dropdown" aria-expanded="false">Polish</button>
                                                        <ul class="dropdown-menu" aria-labelledby="polishDropdown">
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input polish-opt" type="checkbox" value="EX" id="flexCheckDefault11">
                                                                    <label class="form-check-label" for="flexCheckDefault11">Excellent</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input polish-opt" type="checkbox" value="VG" id="flexCheckDefault21">
                                                                    <label class="form-check-label" for="flexCheckDefault21">Very Good</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input polish-opt" type="checkbox" value="G" id="flexCheckDefault31">
                                                                    <label class="form-check-label" for="flexCheckDefault31">Good</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button" id="symmetryDropdown" data-bs-toggle="dropdown" aria-expanded="false">Symmetrys</button>
                                                        <ul class="dropdown-menu" aria-labelledby="symmetryDropdown">
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input sym-opt" type="checkbox" value="EX" id="flexCheckDefault12">
                                                                    <label class="form-check-label" for="flexCheckDefault12">Excellent</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input sym-opt" type="checkbox" value="VG" id="flexCheckDefault22">
                                                                    <label class="form-check-label" for="flexCheckDefault22">Very Good</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input sym-opt" type="checkbox" value="GD" id="flexCheckDefault32">
                                                                    <label class="form-check-label" for="flexCheckDefault32">Good</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button" id="labDropdown" data-bs-toggle="dropdown" aria-expanded="false">Lab</button>
                                                        <ul class="dropdown-menu" aria-labelledby="labDropdown">
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input lab-opt" type="checkbox" value="GIA" id="flexCheckDefault1">
                                                                    <label class="form-check-label" for="flexCheckDefault1">GIA</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input lab-opt" type="checkbox" value="IGI" id="flexCheckDefault3">
                                                                    <label class="form-check-label" for="flexCheckDefault3">IGI</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button" id="fluorescenceDropdown" data-bs-toggle="dropdown" aria-expanded="false">Fluorescence</button>
                                                        <ul class="dropdown-menu" aria-labelledby="fluorescenceDropdown">
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input fl-opt" type="checkbox" value="None" id="flexCheckDefault13">
                                                                    <label class="form-check-label" for="flexCheckDefault13">None</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input fl-opt" type="checkbox" value="Faint" id="flexCheckDefault23">
                                                                    <label class="form-check-label" for="flexCheckDefault23">Faint</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input fl-opt" type="checkbox" value="Medium" id="flexCheckDefault33">
                                                                    <label class="form-check-label" for="flexCheckDefault33">Medium</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input fl-opt" type="checkbox" value="Strong" id="flexCheckDefault43">
                                                                    <label class="form-check-label" for="flexCheckDefault43">Strong</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input fl-opt" type="checkbox" value="Very Strong" id="flexCheckDefault43">
                                                                    <label class="form-check-label" for="flexCheckDefault43">Very Strong</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button" id="tableDropdown" data-bs-toggle="dropdown" aria-expanded="false">Table(%)</button>
                                                        <ul class="dropdown-menu" aria-labelledby="tableDropdown">
                                                            <div class="w-100 p-3">
                                                                <!-- <div class="slider">
                                                                    <div class="progress" id="table-progress" style="left: 0%; right: 0%;"></div>
                                                                </div>
                                                                <div class="range-input" id="table-range-input">
                                                                    <input type="range" class="range-min" id="table-min-range" min="18654.25" max="7020015.50" value="18654.25" step="0.1">
                                                                    <input type="range" class="range-max" id="table-max-range" min="18654.25" max="7020015.50" value="7020015.50" step="0.1">
                                                                </div>

                                                                <div class="price-input" id="table-input">
                                                                    <div class="field">
                                                                        <input type="number" id="table-min" class="input-min" value="0">
                                                                    </div>
                                                                    <div class="field">
                                                                        <input type="number" id="table-max" class="input-max" value="1000">
                                                                    </div>
                                                                </div> -->
                                                                <div class="slider">
                                                                    <div id="table-slider-range" class="progress"></div>
                                                                </div>
                                                                <div class="price-input" id="table-input">
                                                                    <div class="field">
                                                                        <input type="number" id="table-min" class="input-min" value="0">
                                                                    </div>
                                                                    <div class="field">
                                                                        <input type="number" id="table-max" class="input-max" value="1000">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </ul>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button" id="depthDropdown" data-bs-toggle="dropdown" aria-expanded="false">Depth(%)</button>
                                                        <ul class="dropdown-menu" aria-labelledby="depthDropdown">
                                                            <div class="w-100 p-3">
                                                                <!-- <div class="slider">
                                                                    <div class="progress" id="depth-progress" style="left: 0%; right: 0%;"></div>
                                                                </div>
                                                                <div class="range-input" id="depth-range-input">
                                                                    <input type="range" class="range-min" id="depth-min-range" min="18654.25" max="7020015.50" value="18654.25" step="0.1">
                                                                    <input type="range" class="range-max" id="depth-max-range" min="18654.25" max="7020015.50" value="7020015.50" step="0.1">
                                                                </div>
                                                                <div class="price-input" id="depth-input">
                                                                    <div class="field">
                                                                        <input type="number" id="depth-min" class="input-min" value="0">
                                                                    </div>
                                                                    <div class="field">
                                                                        <input type="number" id="depth-max" class="input-max" value="1000">
                                                                    </div>
                                                                </div> -->

                                                                <div class="slider">
                                                                    <div id="depth-slider-range" class="progress"></div>
                                                                </div>
                                                                <div class="price-input" id="depth-input">
                                                                    <div class="field">
                                                                        <input type="number" id="depth-min" class="input-min" value="0">
                                                                    </div>
                                                                    <div class="field">
                                                                        <input type="number" id="depth-max" class="input-max" value="1000">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </ul>
                                    </div>
                                    <div style="flex-shrink: 0;" id="clear-filter">
                                        <button class="btn p-1 fs-12">Clear Filters <i class="fa-solid fa-xmark ms-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-description">
                            <h3>View All Diamond<span class="total-available-product">[<span id="filtered_total">0</span> of <span id="total_diamond">0</span>]</span></h3>
                            <p>Pick your perfect diamond with Diamond Sutra. Start by choosing a high-quality diamond from our
                                selection of conflict-free diamonds. Diamond Sutra offers diamonds in a variety of diamond colors,
                                diamond cuts, and diamond shapes. Then, select your preferred ring setting! All our diamonds are
                                presented in high definition 360° so you know exactly what you are getting.</p>
                        </div>
                        <div class="product-grid">

                            <div class="row gy-3" id="diamond-filter-data">
                                <div class="table-responsive">
                                    <!-- <div id="api-loader" class="text-center">
                                        <img src="{{url('public/assets/img/spinner.gif')}}" alt="">
                                    </div> -->
                                    <div id="diamond-loader">
                                        <div class="d-flex justify-content-center" style="display: none;">
                                            <div class="loader-inner"></div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-hover table-light" id="solitaire-table"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($displaySecondStep && !$displayThirdStep)
            <div class="tab-pane fade {{$displaySecondStep==1 ? 'show active' : ''}}" id="setting-diamond" role="tabpanel" aria-labelledby="setting-diamond-tab">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-description">
                            <div class="d-flex mb-3 flex-wrap align-items-center justify-content-between gap-4">
                                <h3>{{$body['step2_title']}} Settings <span class="total-available-product">[{{count($body['solitiarProduct'])}}]</span></h3>
                            </div>
                            <p>Our selection of {{$body['step2_title']}} settings includes every metal and every style. Yellow gold, white
                                gold, platinum, and rose gold; vintage, modern, classic or trendy, Diamond Sutra has the perfect
                                {{$body['step2_title']}} setting for you. Whether you are choosing a timeless diamond or a colorful gemstone,
                                we have the ideal engagement ring setting that will shine as bright. A momentous moment deserves
                                nothing less than pure excellence, our collection of {{$body['step2_title']}} settings ensures that you are
                                able to present the ideal ring.
                            </p>
                        </div>
                        <div class="product-grid">
                            <div class="row gy-3">
                                <div class="col-lg-9">
                                    <div class="row gy-3">
                                        @foreach($body['solitiarProduct'] as $product)
                                        @php $color = config('constant.COLOR_CODE.'.$product['default_color']);@endphp
                                        @php
                                        $diamond = $product['diamond'];
                                        if(isset($diamond[0]['price_GH_SI']))
                                        $price = $diamond[0]['price_GH_SI'];
                                        else
                                        $price = $diamond[0]['carat'] * $body['settings']['price_IJ_SI'];
                                        @endphp
                                        <div class="col-6 col-lg-4 solitare_setting_product" style="cursor: pointer;" data-id="{{$product['id']}}">
                                            <!-- <input type="hidden" name="" value="{{json_encode($product)}}"> -->
                                            <div class="single-product-card">
                                                <div class="product-img">
                                                    <img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_'.$color.'1.jpg'}}" class="image-main" alt="">
                                                    <img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_Model_'.$color.'.jpg'}}" class="image-hover" alt="">
                                                </div>
                                                <div class="product-content">
                                                    <a href="javascript:void(0)" class="product-title">{{$product['name']}}</a>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="proPrice">
                                                            {{\General::currency_format($product['default_buy_price'] - $product['default_gst'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="border border-dark text-center bg-light fs-14">
                                        <h6 class="bg-dark text-white p-4">Your Selected Solitaire</h6>
                                        <div class="select-product-list">
                                            <div class="my-2">
                                                <img src="{{$selectedDiamond['ImageLink']}}" alt="Diamond Image" class="img-fluid w-100">
                                                <a href="javasript::void(0)" class="text-decoration-underline">{{$selectedDiamond['Weight']}} carat {{$selectedDiamond['DisplayShape']}} Diamond</a>
                                                <h6 class="fs-14">{{\General::currency_format($selectedDiamond['Price'],0,'',',')}}</h6>
                                            </div>
                                        </div>
                                        <div class="border border-top p-4">
                                            <h6><b>TOTAL</b><br>
                                                {{\General::currency_format($selectedDiamond['Price'],0,'',',')}}
                                            </h6>
                                            <div><button class="btn btn-outline-dark" id="choose-diamond-btn">Choose Another Diamond</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($displayThirdStep)
            <div class="tab-pane fade {{$displayThirdStep==1 ? 'show active' : ''}}" id="ring-step" role="tabpanel" aria-labelledby="ring-step-tab">
                <input type="hidden" id="gold-price-list" value="{{json_encode($selectedProduct['gold_price_list'])}}">
                <input type="hidden" id="gold-weight-list" value="{{json_encode($selectedProduct['gold_weight_list'])}}">
                <input type="hidden" id="making-charge-list" value="{{json_encode($selectedProduct['making_charge_list'])}}">
                <input type="hidden" id="diamond-price-list" value="{{json_encode($selectedProduct['diamond_price_list'])}}">
                <input type="hidden" id="color-code-list" value="{{json_encode($selectedProduct['color_code_list'])}}">
                <input type="hidden" id="color-list" value="{{json_encode($selectedProduct['color_list'])}}">
                <input type="hidden" id="diamond-quality-display-list" value="{{json_encode($selectedProduct['diamond_quality_display_list'])}}">
                <input type="hidden" id="solitaire_preset" value="{{$selectedProduct['is_solitaire']}}">
                <input type="hidden" id="is_diamond" value="{{$selectedProduct['is_diamond']}}">
                <input type="hidden" id="solitaire-price-list" value="{{json_encode($selectedProduct['solitaire_price_list'])}}">
                <input type="hidden" id="video-list" value="{{json_encode($selectedProduct['all_videos'])}}">
                <input type="hidden" id="stone-price" value="{{$selectedProduct['stone_price']}}">

                <input type="hidden" id="product-default-image-url" value="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku']}}">
                <input type="hidden" id="default-product-color-code" value="{{config('constant.COLOR_CODE.'.$selectedProduct['default_color'])}}">
                <input type="hidden" id="default-product-color" value="{{$selectedProduct['default_color']}}">
                <input type="hidden" id="default-product-video" value="{{$selectedProduct['default_video']}}">
                <input type="hidden" id="default-diamond-quality" value="{{$selectedProduct['default_diamond_quality']}}">
                <input type="hidden" id="product-size-chart" value="{{json_encode($selectedProduct['size_chart'])}}">


                <input type="hidden" id="14K_gold_price" value="{{$selectedProduct['14K_gold_price']}}">
                <input type="hidden" id="18K_gold_price" value="{{$selectedProduct['18K_gold_price']}}">
                <input type="hidden" id="14K_gold_weight" value="{{$selectedProduct['gold_weight_14k']}}">
                <input type="hidden" id="18K_gold_weight" value="{{$selectedProduct['gold_weight_18k']}}">
                <input type="hidden" id="diamond_price" value="{{$selectedProduct['price_IJ_SI']}}">
                <input type="hidden" id="default-making-charge" value="{{$selectedProduct['making_charges']}}">


                <input type="hidden" id="product-sku" value="{{$selectedProduct['product_sku']}}">
                <input type="hidden" id="selected-product-color" value="{{config('constant.COLOR_CODE.'.$selectedProduct['default_color'])}}">
                <input type="hidden" id="selected-product-size" value="{{$selectedProduct['default_size']}}">
                <input type="hidden" id="change-product-size" value="">
                <input type="hidden" id="selected-product-shape" value="">
                <input type="hidden" id="selected-diamond-quality" value="{{$selectedProduct['selected_diamond_quality']}}">
                <input type="hidden" id="selected-gold-carat" value="{{$selectedProduct['default_gold_quality']}}">
                <input type="hidden" id="selected-gold-weight" value="">
                <div class="row">
                    <div class="col-lg-5">
                        <div>
                            <div class="slider-content">
                                <div class="xzoom-container h-100">
                                    <a data-fancybox-trigger="gallery" href="javascript:;">
                                        <img class="xzoom h-100 w-100 image-1" id="xzoom-default" src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W1.jpg'}}" xoriginal="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W1.jpg'}}" />
                                    </a>
                                </div>
                            </div>
                            <div class="video-play-section w-100 h-100 d-flex justify-content-center d-none">
                                <video id="video1" data-id="1" class="w-100 h-100 " width="520" height="240" controls autoplay muted loop playsinline>
                                    <source id="video-source-1" src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W.mp4'}}" type="video/mp4">
                                    <source id="video-source-2" src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W.ogg'}}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="slider-thumb">
                                <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W1.jpg'}}" alt="" class="img-fluid thumb-image thumb-image-1"></div>
                                <div class="slide"><img src="{{url('public/assets/img/video-thumb.png')}}" alt="" data-id="1" class="img-fluid video-thumb-image"></div>
                                <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W2.jpg'}}" alt="" class="img-fluid thumb-image thumb-image-2"></div>
                                <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W3.jpg'}}" alt="" class="img-fluid thumb-image thumb-image-3"></div>
                                <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_Model_W.jpg'}}" alt="" class="img-fluid thumb-image thumb-model-image"></div>
                            </div>
                        </div>
                        <div class="certification mt-4 mt-lg-5">
                            <ul class="d-flex flex-wrap align-items-center gap-2 gap-lg-3 list-unstyled">
                                <li class=""><span class="small text-uppercase">Certified By</span></li>
                                <li class="sgl">
                                    <a href="https://sgl-labs.com/" class="d-inline-block" target="_blank">
                                        <img src="{{url('public/assets/img/gsi.png')}}" class="img-fluid" alt="">
                                    </a>
                                </li>
                                <li class="sgl">
                                    <a href="https://www.bis.gov.in/" class="d-inline-block" target="_blank">
                                        <img src="{{url('public/assets/img/certificate-2.png')}}" class="img-fluid" alt="">
                                    </a>
                                </li>
                                <li class="sgl">
                                    <a href="https://www.gia.edu/gem-lab-service/diamond-grading" class="d-inline-block" target="_blank">
                                        <img src="{{url('public/assets/img/certificate-3.png')}}" class="img-fluid" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="product-info-panel">

                            <h3 class="product-info-title" id="product-name">{{$selectedProduct['name']}}</h3>
                            <div class="product-info-price">
                                <span class="subtotal-price">{{\General::currency_format($selectedProduct['default_buy_price'] - $selectedProduct['default_gst'])}}</span><span class="disc-price">{{\General::currency_format($selectedProduct['default_base_price'])}}</span><span class="disc-percentage">-{{$selectedProduct['diamond_price_list'][$selectedProduct['default_diamond_quality']]['diamond_discount']}}%</span> <span class="discount-text">(On Diamond)</span>
                            </div>
                            <div class="mb-2 mb-lg-3 d-flex flex-wrap align-items-center gap-2 gap-lg-3">
                                <div class="title small">Gold :</div>
                                <div>
                                    <label class="form-check-label"><input type="radio" class="form-check-input me-1 carat-filter" name="goldCrt" value="14" @if($selectedProduct['default_gold_quality']==14) checked="checked" @endif> 14K</label>
                                </div>
                                <div>
                                    <label class="form-check-label"><input type="radio" class="form-check-input me-1 carat-filter" name="goldCrt" value="18" @if($selectedProduct['default_gold_quality']==18) checked="checked" @endif> 18K</label>
                                </div>
                            </div>

                            <div class="total-weight mb-3">
                                <span class="gold-quality-title">{{$selectedProduct['default_gold_quality']}}K {{$selectedProduct['default_color']}} Gold</span>
                                <div class="gold-quality">
                                    <div></div>
                                    <ul class="d-flex list-unstyled">
                                        @foreach($selectedProduct['all_colors'] as $color)
                                        <li class="color-filter">
                                            <label class="form-label" for="color-14-{{$color['color_code']}}">
                                                <input type="radio" class="btn" id="color-14-{{$color['color_code']}}" name="flexRadioDefault" value="{{$color['color_code']}}">
                                                <span class="color-14-{{$color['color']}}" data-crt="14" data-color="{{$color['color']}}">{{$color['color_code']}}</span>
                                            </label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            @if($selectedProduct['is_diamond'] == 'yes')
                            <!-- <div class="mb-2 mb-lg-3 d-flex flex-wrap align-items-center gap-2 gap-lg-3">
                                <div class="title small">Diamond :</div>
                                <div>
                                <label class="form-check-label"><input type="radio" class="form-check-input me-1 diamond-filter" id="price_IJ_SI" data-diamond="IJ_SI" data-display="IJ SI" name="diamondQuality" value="{{$selectedProduct['price_IJ_SI']}}" checked="checked">
                                    IJ SI
                                </label>
                                </div>
                                <div>
                                <label class="form-check-label"><input type="radio" class="form-check-input me-1 diamond-filter" id="price_GH_SI" data-diamond="GH_SI" data-display="GH SI" name="diamondQuality" value="{{$selectedProduct['price_GH_SI']}}"> GH SI</label>
                                </div>
                                <div>
                                <label class="form-check-label"><input type="radio" class="form-check-input me-1 diamond-filter" id="price_GH_VS" data-diamond="GH_VS" data-display="GH VS" name="diamondQuality" value="{{$selectedProduct['price_GH_VS']}}"> GH VS</label>
                                </div>
                                <div>
                                <label class="form-check-label"><input type="radio" class="form-check-input me-1 diamond-filter" id="price_EF_VVS" data-diamond="EF_VVS" data-display="EF VVS" name="diamondQuality" value="{{$selectedProduct['price_EF_VVS']}}"> EF VVS</label>
                                </div>
                            </div> -->
                            @endif

                            @if($selectedProduct['size_chart'] != null)
                            <div class="mb-2 mb-lg-3 d-flex flex-wrap align-items-center gap-2 gap-lg-3">
                                <div class="title small">{{$selectedProduct['size_chart_name']}} size :</div>
                                <div class="dropdown-wrapper ring-size-wrapper">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="size-chart" data-bs-toggle="dropdown" aria-expanded="false">select</button>
                                        <ul class="dropdown-menu" style="max-height: 200px;overflow-y: auto;" aria-labelledby="size-chart">
                                            @if($selectedProduct['category_id'] == 5)
                                            @foreach($selectedProduct['size_chart'] as $size)
                                            <li><a data-size='{{$size}}' data-display-size='2-{{$size}}(2 {{$size}}/16")' class="dropdown-item ring-size-filter @if($size == $selectedProduct['default_size']) {{'active'}} @endif" href="javascript:void(0)">2-{{$size}}(2 {{$size}}/16")</a></li>
                                            @endforeach
                                            @else
                                            @foreach($selectedProduct['size_chart'] as $size)
                                            <li><a data-size="{{$size}}" data-display-size="{{$size}}" class="dropdown-item ring-size-filter @if($size == $selectedProduct['default_size']) {{'active'}} @endif" href="javascript:void(0)">{{$size}}</a></li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <p class="m-0">Estimated Shipping:</p>
                            <div class="mb-3 d-flex flex-wrap gap-2">
                                <input type="text" class="form-control w-auto" id="pincode" placeholder="Enter Pincode">
                                <button class="btn btn-dark btn-sm" id="checkEstimatedDeliveryBtn">Check</button>
                            </div>
                            <div class="d-flex mb-2 align-items-center justify-content-between gap-2">
                                <p id="estimated-date"></p>
                            </div>
                            <div class="cart-btn-group">
                                <a href="javascript:void(0)" id="btn-buy-now" class="btn primary-btn large-btn w-100 mb-2 mb-sm-3">Buy Now</a>
                                <button class="btn w-100 btn-outline-dark large-btn" id="back-to-setting">Back To Setting</button>
                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-2 ms-auto mb-2 question-reach-out">
                                <p class="m-0 fw-bold me-2">If you have any questions, reach out to us</p>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="#" class="fs-4 text-success p-1"><i class="fa-solid fa-phone"></i></a>
                                    <span class="mx-1 fw-bold mb-0">or</span>
                                    <a href="#" class="fs-4 text-success p-1"><i class="fa-brands fa-whatsapp"></i></a>
                                </div>
                            </div>

                            <div class="diamondsutra-promises border bg-light d-inline-block py-3 px-4 fs-12">
                                <p class="mb-2 pb-2 d-block text-uppercase fw-bold border-bottom fs-12" style="letter-spacing: 2px;">Diamond Sutra Promises</p>
                                <div class="d-flex flex-wrap gap-3">
                                    <ul class="list-unstyled m-0">
                                        <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-certificate me-2 text-center" style="width:16px"></i> 100% certified jewelry</li>
                                        <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-hand-holding-dollar me-2 text-center" style="width:16px"></i> 15-day refund policy</li>
                                        <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-repeat me-2 text-center" style="width:16px"></i> Lifetime Exchange & Buyback</li>
                                    </ul>
                                    <ul class="list-unstyled m-0">
                                        <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-truck-fast me-2 text-center" style="width:16px"></i> Free Shipping and Insurance</li>
                                        <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-money-bill-wave me-2 text-center" style="width:16px"></i> Transparent Pricing</li>
                                        <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-compress me-2 text-center" style="width:16px"></i> Complementary Resizing</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="border border-dark text-center bg-light fs-14 position-sticky top-0">
                            <h6 class="bg-dark text-white p-4">Your Selected Solitaire</h6>
                            <div class="select-product-list">
                                <div class="my-2">
                                    <img src="{{$selectedDiamond['ImageLink']}}" alt="Diamond Image" class="img-fluid w-100">
                                    <a href="javasript::void(0)" class="text-decoration-underline">{{$selectedDiamond['Weight']}} carat {{$selectedDiamond['DisplayShape']}} Diamond</a>
                                    <h6 class="fs-14">{{\General::currency_format($selectedDiamond['Price'],0,'',',')}}</h6>
                                </div>
                            </div>
                            <div class="border border-top p-4">
                                <h6><b>TOTAL</b><br>
                                    {{\General::currency_format($selectedDiamond['Price'],0,'',',')}}
                                </h6>
                                <div><button class="btn btn-outline-dark" id="choose-diamond-btn">Choose Diamond</button></div>
                            </div>
                        </div>
                    </div>
                    <div class="product-description-pd">
                        <h3>PRODUCT DESCRIPTION</h3>
                        <span class="sku">{{$selectedProduct['product_sku']}}</span>
                        <p>{{$selectedProduct['description']}}</p>

                        <div class="accordion" id="accordionExample">
                            @if(isset($selectedProduct['dimension']) && $selectedProduct['dimension'] != '')
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">PRODUCT DETAIL</button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div>
                                            <!-- <h6>PRODUCT INFORMATION</h6> -->
                                            <table class="product-info-table">
                                                <tr>
                                                    <td>Height <i class="fa fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Height can vary in the final product."></i></td>
                                                    <td>{{$selectedProduct['dimension']['height']}} <span style="text-transform: lowercase;">mm</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Width <i class="fa fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Width can vary in the final product."></i></td>
                                                    <td>{{$selectedProduct['dimension']['width']}} <span style="text-transform: lowercase;">mm</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($selectedProduct['is_diamond'] == 'yes')
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">DIAMOND DETAILS</button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="product-info-table">
                                            <tr>
                                                <td>Diamond Quality</td>
                                                <td class="display-diamond-quality-info">{{$selectedProduct['diamond_quality_display_list'][$selectedProduct['default_diamond_quality']]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Weight</td>
                                                <td>{{$selectedProduct['diamond'][0]['carat']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Diamonds</td>
                                                <td>{{$selectedProduct['diamond'][0]['quantity']}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- solitaire section removed -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">MATEL DETAILS</button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="product-info-table">
                                            <tr>
                                                <td>Type</td>
                                                <td class="metal-type-info">GOLD</td>
                                            </tr>
                                            <tr>
                                                <td>Total Weight <i class="fa fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="The final invoice amount will be adjusted in case of variation in weight."></i></td>
                                                <td id="selected-metal-weight-info"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">PRICE BREAKUP</button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="product-info-table">
                                            <tr>
                                                <td>Gold</td>
                                                <td class="gold-price-info"></td>
                                            </tr>
                                            @if($selectedProduct['is_diamond'] == 'yes')
                                            <tr>
                                                <td>Diamond</td>
                                                <td class="diamond-price-info"></td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>Making Charges</td>
                                                <td class="making-charges-info"></td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td class="total-price-info"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</main>

@stop
@section('footer')
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

<script>
    /* The redirect to autoplay page function */
    function redirect() {
        window.location.href = `{{ asset('/') }}`;
    }
    var initial = setTimeout(redirect, 1800000);
    console.log(initial);
    $(document).click(function(event) {
        clearTimeout(initial);
        initial = setTimeout(redirect, 1800000);
    });
    var format = new Intl.NumberFormat('hi-IN', {
        style: 'currency',
        currency: 'INR',
        minimumFractionDigits: 0,
    });
    var base_url = $('#base_url').val();
    var token = $('#token').val();
    var defaultImagePath;
    var selectedColorCode
    var selectedColor
    var selectedCarat
    var selectedDiamond

    var diamondQualityChart
    var displayDiamondQuality
    var selectedSize
    var defaultMakingCharge
    var selectedSolitaireQuality
    var selectedSolitaireDisplay;
    var selectedSolitaireCarat

    var goldPriceList
    var goldWeightList
    var makingChargeList
    var diamondPriceList
    var solitairePriceList
    var videoList

    var goldPrice;
    var goldWeight;
    var makingCharge;
    var diamondBuyPrice = 0;
    var diamondDiscount = 0;
    var diamondBasePrice = 0;
    var gst;
    var totalAmount;
    var diamondDiscountAmount;
    var buyPrice;
    var finalBuyPriceWithGst;
    var solitairePresetPrice = 0;

    var stonePrice = 0;
    if ($('#stone-price').val() != '')
        stonePrice = $('#stone-price').val();

    var filteredData = []
    var apiSolitaire = false;
    var apiRanwaka = false;
    var exchangeRate = 83;
    var currentPage = 1;
    const itemsPerPage = 10;
    var totalRecord = 0;
    var cutParam = [];
    var shapeParam = ["Round"];
    var colorParam = [];
    var clarityParam = [];
    var polishParam = [];
    var flParam = [];
    var labParam = [];
    var symParam = [];
    var dataTableData = [];
    var filterParam = {
        cut: cutParam,
        color: colorParam,
        clarity: clarityParam,
        polish: polishParam,
        fl: flParam,
        lab: labParam,
        shape: shapeParam,
        sym: symParam,
        carat: {
            min: 0,
            max: 11
        },
        price: {
            min: 0,
            max: 100000000
        },
        table: {
            min: 0,
            max: 100000000
        },
        depth: {
            min: 0,
            max: 100000000
        },
    };
    var base_url = $('#base_url').val();

    $(document).on('click', '#checkEstimatedDeliveryBtn', function() {
        let pincode = $('#pincode').val();
        let base_url = $('#base_url').val();
        $.ajax({
            type: 'GET',
            url: base_url + '/check-estimated-delivery/' + pincode,
            // data: {
            //     pincode: pincode,
            //     _token: $('#token').val()
            // },
            success: function(res) {
                console.log(res);
                if (res.flag === 1) {
                    $('#estimated-date').html('<b>Estimated Delivery by date: </b>' + res.data);
                } else {
                    $('#estimated-date').html('');
                    Toast(res.msg, 3000, res.flag);
                }
            },
        });
    });

    $(document).on('click', '#btn-buy-now', function() {
        if ($('#selected-product-size').val() != '') {
            let size = $('#change-product-size').val();
            if (size == '' || size == undefined) {
                Toast('Please select size', 3000, 0);
                return;
            }
        }
        const productSku = $('#product-sku').val();
        const selectedProductColor = $('#selected-product-color').val();
        const selectedProductSize = $('#selected-product-size').val();
        const selectedProductShape = $('#selected-product-shape').val();
        const selectedDiamondQuality = $('#selected-diamond-quality').val();
        const selectedGoldCarat = $('#selected-gold-carat').val();
        const productDiamondPrice = $('#product-diamond-price').val();
        const productGoldPrice = $('#product-gold-price').val();
        const productMakingCharges = $('#product-making-charges').val();
        const productGstAmount = $('#product-gst-amount').val();
        const productNetAmount = $('#product-net-amount').val();
        const productFinalAmount = $('#product-final-amout').val();
        const productGoldWeight = $('#selected-gold-weight').val();

        // Prepare the data object
        var cartProduct = [];
        const productData = {
            product_sku: productSku,
            color: selectedProductColor,
            size: selectedProductSize,
            diamondQuality: selectedDiamondQuality,
            goldCarat: selectedGoldCarat,
            diamondPrice: productDiamondPrice,
            goldWeight: productGoldWeight,
            goldPrice: productGoldPrice,
            makingCharges: productMakingCharges,
            gstAmount: productGstAmount,
            netAmount: productNetAmount,
            product_type: 'solitaire',
            finalAmount: productFinalAmount
        };
        cartProduct.push(productData);

        // Send the data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: base_url + '/start-checkout', // Replace with your endpoint
            data: {
                _token: token,
                productData: cartProduct,
                // diamondData:
            },
            success: function(res) {
                // Redirect the user to the checkout page
                if (res.flag === 1) {
                    window.location.href = base_url + '/checkout-method';
                } else {
                    Toast(res.msg, 3000, res.flag);
                }
            },
            error: function(xhr, status, error) {
                // Handle errors if the AJAX request fails
                console.error(error);
                // Show an error message to the user or retry the action
            }
        });
    })

    $.urlParam = function(name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }

    $(document).on('click', '.solitare_setting_product', function() {
        var product = $(this).children('input').val();
        var base_url = $('#base_url').val();
        var selectedSolitaire = localStorage.getItem('selected_solitaire');
        let category = decodeURIComponent(($.urlParam('cat')))
        if (selectedSolitaire) {
            $.ajax({
                type: 'POST',
                url: base_url + '/product/select', // Replace with your endpoint
                data: {
                    _token: token,
                    id: $(this).data('id'),
                },
                success: function(res) {
                    // Redirect the user to the checkout page
                    if (res.flag === 1) {
                        window.location.href = base_url + '/design-your-own-diamond-' + category + '?cat=' + category + '&selected=2';
                    } else {
                        Toast(res.msg, 3000, res.flag);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors if the AJAX request fails
                    console.error(error);
                    // Show an error message to the user or retry the action
                }
            });
        }
    });

    function playPause(videoId) {
        var myVideo = document.getElementById("video" + videoId);
        if (myVideo.paused)
            myVideo.play();
    }

    function pause(videoId) {
        var myVideo = document.getElementById("video" + videoId);
        if (myVideo.play)
            myVideo.pause();
    }

    function play(videoId) {
        var myVideo = document.getElementById("video" + videoId);
        if (myVideo.paused)
            myVideo.play();
    }

    var maxValue;
    var minValue;

    var maxPriceValue;
    var minPriceValue;

    var maxtableValue;
    var mintableValue;

    var maxDepthValue;
    var minDepthValue;

    $(document).ready(function() {

        let categoryQueryStr = decodeURIComponent(($.urlParam('cat')))

        if (categoryQueryStr == 'rings') {
            $('.ring-icon-svg').show();
            $('.pendant-icon-svg').hide();
        } else if (categoryQueryStr == 'pendants') {
            $('.ring-icon-svg').hide();
            $('.pendant-icon-svg').show();
        }


        let displayThirdStep = `{{$displayThirdStep}}`
        if (displayThirdStep == 1) {
            $('#step-3-name').text($('#product-name').text())
            defaultImagePath = $('#product-default-image-url').val();
            selectedColorCode = $('#default-product-color-code').val();
            selectedColor = $('#default-product-color').val();
            selectedCarat = $('#selected-gold-carat').val();
            selectedDiamond = $('#selected-diamond-quality').val();

            if (selectedDiamond != '') {
                diamondQualityChart = JSON.parse($('#diamond-quality-display-list').val());
                displayDiamondQuality = diamondQualityChart[selectedDiamond];
            }
            selectedSize = $('#selected-product-size').val();
            defaultMakingCharge = $('#default-making-charge').val();
            selectedSolitaireQuality = $('#selected-solitaire').val();
            selectedSolitaireCarat = $('#selected-solitaire-carat').val();

            goldPriceList = JSON.parse($('#gold-price-list').val());
            goldWeightList = JSON.parse($('#gold-weight-list').val());
            makingChargeList = JSON.parse($('#making-charge-list').val());
            diamondPriceList = JSON.parse($('#diamond-price-list').val());
            videoList = JSON.parse($('#video-list').val());
            // solitairePriceList = JSON.parse($('#solitaire-price-list').val());


            updateData(selectedColorCode, selectedCarat, selectedColor);
            updateProductPrice();

            $('.accordion-collapse').addClass('show');
            $('.accordion-button').click(function() {
                var targetCollapse = $(this).attr('data-bs-target');
                var isExpanded = $(this).attr('aria-expanded') === 'true';
                if (isExpanded) {
                    $(targetCollapse).removeClass('show');
                }
            });


            $(document).on('click', '.thumb-image', function() {
                $('.video-play-section').addClass('d-none');
                $('.slider-content').removeClass('d-none');
                let src = $(this).attr('src');
                $('#xzoom-default').attr('src', src);
                $('#xzoom-default').attr('xoriginal', src);
                pause(1);
            })

            $(document).on('click', '.video-thumb-image', function() {
                $('.slider-content').addClass('d-none');
                $('.video-play-section').removeClass('d-none');
                var video = $(this).data('id');
                play(video);
            });

        }
        $('.accordion-collapse').addClass('show');
        $('.accordion-button').click(function() {
            var targetCollapse = $(this).attr('data-bs-target');
            var isExpanded = $(this).attr('aria-expanded') === 'true';
            if (isExpanded) {
                $(targetCollapse).removeClass('show');
            }
        });
        var diamondSelected = "{{$diamondSelected}}";
        // if (diamondSelected == 1) {
        //     $('#setting-diamond-tab').click();
        // }

        $('#diamond-loader').show();
        $.ajax({
            url: base_url + '/solitaire',
            method: 'GET',
            dataType: 'json',
            success: function(res) {
                $('#diamond-loader').hide();
                apiSolitaire = res.data;
                $('#total_diamond').text(res.data.length)
                console.log(apiSolitaire);
                filteredData = apiSolitaire;
                totalRecord = apiSolitaire.length
                maxValue = apiSolitaire.reduce((max, obj) => (parseFloat(obj.Weight) > max ? obj.Weight : max), parseFloat(apiSolitaire[0].Weight));
                minValue = apiSolitaire.reduce((min, obj) => (parseFloat(obj.Weight) < min ? obj.Weight : min), parseFloat(apiSolitaire[0].Weight));

                maxValue = parseFloat(maxValue)
                minValue = parseFloat(minValue)

                apiSolitaire.forEach(ele => {
                    tempJson = {}
                    tempJson.SHAPE = ele.DisplayShape
                    tempJson.CARAT = ele.Weight
                    tempJson.PRICE = format.format(ele.Price)
                    tempJson.CLARITY = ele.Clarity
                    tempJson.CUT = ele.DisplayCut
                    tempJson.COLOR = ele.Color
                    tempJson.POLISH = ele.DisplayPol
                    tempJson.FLOURESCENCE = ele.Clarity
                    tempJson.CERTIFICATE_TYPE = ele.CertNo
                    tempJson.MEASUREMENTS = ele.Diameter
                    dataTableData.push(tempJson);
                });

                console.log("Max", maxValue)
                console.log("Min", minValue)
                $('#carat-min').val(minValue)
                $('#carat-max').val(maxValue)

                maxPriceValue = apiSolitaire[apiSolitaire.length - 1].Price;
                minPriceValue = apiSolitaire[0].Price;
                console.log("Max Price", maxPriceValue)
                console.log("Min Price", minPriceValue)
                $('#price-min').val(minPriceValue)
                $('#price-max').val(maxPriceValue)

                maxtableValue = apiSolitaire.reduce((max, obj) => (parseFloat(obj.Table) > max ? obj.Table : max), parseFloat(apiSolitaire[0].Table));
                mintableValue = apiSolitaire.reduce((min, obj) => (parseFloat(obj.Table) < min ? obj.Table : min), parseFloat(apiSolitaire[0].Table));

                maxtableValue = parseInt(maxtableValue)
                mintableValue = parseInt(mintableValue)

                maxDepthValue = apiSolitaire.reduce((max, obj) => (parseFloat(obj.TopDepth) > max ? obj.TopDepth : max), parseFloat(apiSolitaire[0].TopDepth));
                minDepthValue = apiSolitaire.reduce((min, obj) => (parseFloat(obj.TopDepth) < min ? obj.TopDepth : min), parseFloat(apiSolitaire[0].TopDepth));

                maxDepthValue = parseInt(maxDepthValue)
                minDepthValue = parseInt(minDepthValue)

                console.log("Max Table", maxtableValue)
                console.log("Min Table", mintableValue)
                $('#table-min').val(mintableValue)
                $('#table-max').val(maxtableValue)

                console.log("Max Depth", maxDepthValue)
                console.log("Min Depth", minDepthValue)

                $('#depth-min').val(minDepthValue)
                $('#depth-max').val(maxDepthValue)

                $('#price-min').val(minPriceValue)
                $('#price-max').val(maxPriceValue)


                $(function() {
                    $("#price-slider-range").slider({
                        range: true,
                        min: minPriceValue,
                        max: maxPriceValue,
                        values: [minPriceValue, maxPriceValue],
                        step: 1,
                        slide: function(event, ui) {
                            console.log(ui.values[0], ui.values[1])
                            $('#price-min').val(ui.values[0])
                            $('#price-max').val(ui.values[1])
                            filterParam.price.min = ui.values[0]
                            filterParam.price.max = ui.values[1]
                            console.log(filterParam)
                            filterDiamondData()
                        },
                    });
                    console.log($("#price-slider-range").slider("values"))
                    $("#carat-slider-range").slider({
                        range: true,
                        min: minValue,
                        max: maxValue,
                        values: [minValue, maxValue],
                        step: 0.1,
                        slide: function(event, ui) {
                            $('#carat-min').val(ui.values[0])
                            $('#carat-max').val(ui.values[1])
                            filterParam.carat.min = ui.values[0]
                            filterParam.carat.max = ui.values[1]
                            console.log(filterParam)
                            filterDiamondData()
                        },
                    });
                    $('#carat-min').val($("#carat-slider-range").slider("values", 0))
                    $('#carat-max').val($("#carat-slider-range").slider("values", 1))

                    $("#table-slider-range").slider({
                        range: true,
                        min: mintableValue,
                        max: maxtableValue,
                        values: [mintableValue, maxtableValue],
                        step: 1,
                        slide: function(event, ui) {
                            $('#table-min').val(ui.values[0])
                            $('#table-max').val(ui.values[1])
                            filterParam.table.min = ui.values[0]
                            filterParam.table.max = ui.values[1]
                            console.log(filterParam)
                            filterDiamondData()
                        },
                    });
                    $('#table-min').val($("#table-slider-range").slider("values", 0))
                    $('#table-max').val($("#table-slider-range").slider("values", 1))

                    $("#depth-slider-range").slider({
                        range: true,
                        min: minDepthValue,
                        max: maxDepthValue,
                        values: [minDepthValue, maxDepthValue],
                        step: 1,
                        slide: function(event, ui) {
                            $('#depth-min').val(ui.values[0])
                            $('#depth-max').val(ui.values[1])
                            filterParam.depth.min = ui.values[0]
                            filterParam.depth.max = ui.values[1]
                            console.log(filterParam)
                            filterDiamondData()
                        },
                    });
                    $('#depth-min').val($("#depth-slider-range").slider("values", 0))
                    $('#depth-max').val($("#depth-slider-range").slider("values", 1))

                });

                console.log("Intial Filter :", filterParam);
                filterDiamondData()
            }
        });

    });

    $('.color-filter').on('click', function() {
        selectedColorCode = $(this).children('label').find('input[type="radio"]').val();
        selectedColor = $(this).children('label').children('span').data('color');
        updateData();
        // updateCaratPrice();
        updateProductPrice();
    });

    $('.carat-filter').on('click', function() {
        selectedCarat = $(this).val();
        console.log('carat', selectedCarat);
        $('.metal-type-info').text(selectedCarat + 'K Gold');
        // updateCaratPrice();

        // new code 
        $('.metal-type-info').text(selectedCarat + 'K Gold');
        updateProductPrice();
    });

    $('.ring-size-filter').on('click', function() {
        // debugger
        $('.ring-size-filter').removeClass('active');
        $(this).addClass('active');
        selectedSize = $(this).data('size');
        $('#change-product-size').val(selectedSize);
        // updateCaratPrice();
        updateProductPrice();
    });

    $('.solitaire-carat-filter').on('click', function() {
        $('.solitaire-carat-filter').removeClass('active');
        $(this).addClass('active');
        selectedSolitaireCarat = $(this).data('carat');
        // updateCaratPrice();
        updateProductPrice();
    });

    $('.diamond-filter').on('click', function() {
        selectedDiamond = $(this).data('diamond');
        displayDiamondQuality = $(this).data('display');
        // updateCaratPrice();
        updateProductPrice();
    });

    $('.solitaire-quality-filter').on('click', function() {
        selectedSolitaireQuality = $(this).data('diamond');
        selectedSolitaireDisplay = $(this).data('display');
        console.log('selected : ', selectedDiamond);
        console.log('display : ', displayDiamondQuality);
        updateProductPrice();
    });

    function updateData() {
        console.log('update data called')
        let goldPrice = $('#' + selectedCarat + 'K_gold_price').val();
        let defaultVideo = $('#default-product-video').val();

        $('.metal-type-info').text(selectedCarat + 'K Gold');
        $('.display-diamond-quality-info').text(displayDiamondQuality);
        $('.display-solitaire-weight').text(selectedSolitaireCarat);
        $('.display-solitaire-quality-info').text(selectedSolitaireDisplay);
        $('#color-' + selectedCarat + '-' + selectedColorCode).prop('checked', true);
        $('.gold-quality-title').text(selectedCarat + 'K ' + selectedColor + ' gold');
        $('#xzoom-default').attr('src', defaultImagePath + '_' + selectedColorCode + '1.jpg');
        $('#xzoom-default').attr('xoriginal', defaultImagePath + '_' + selectedColorCode + '1.jpg');

        $('.thumb-image-1').attr('src', defaultImagePath + '_' + selectedColorCode + '1.jpg');
        $('.thumb-image-2').attr('src', defaultImagePath + '_' + selectedColorCode + '2.jpg');
        $('.thumb-image-3').attr('src', defaultImagePath + '_' + selectedColorCode + '3.jpg');
        $('.thumb-model-image').attr('src', defaultImagePath + '_Model_' + selectedColorCode + '.jpg');

        $('#selected-metal-info').text(selectedCarat + 'K Gold');


        $('#video-source-1').attr('src', defaultImagePath + '_' + videoList[selectedColorCode] + '.mp4');
        $('#video-source-2').attr('src', defaultImagePath + '_' + videoList[selectedColorCode] + '.ogg');
        let myVideo = document.getElementById("video1");
        myVideo.load();
        myVideo.pause();
        $('.thumb-image-1').trigger('click');
    }

    // $(document).on('click', '#checkEstimatedDeliveryBtn', function() {
    //     let pincode = $('#pincode').val();
    //     let base_url = $('#base_url').val();
    //     $.ajax({
    //         type: 'GET',
    //         url: base_url + '/check-estimated-delivery/' + pincode,
    //         // data: {
    //         //     pincode: pincode,
    //         //     _token: $('#token').val()
    //         // },
    //         success: function(res) {
    //             console.log(res);
    //             if (res.flag === 1)
    //                 $('#estimated-date').html('<b>Estimated Delivery by date: </b>' + res.data);
    //         },
    //     });
    // });
    $(document).on('click', '#back-to-setting', function() {
        let category = decodeURIComponent(($.urlParam('cat')))
        $.ajax({
            type: 'POST',
            url: base_url + '/setting/reset',
            data: {
                _token: $('#token').val()
            },
            success: function(res) {
                console.log(res);
                window.location.href = base_url + '/design-your-own-diamond-' + category + '?cat=' + category + '&selected=1';
            },
        });
    });
    $(document).on('click', '#choose-diamond-btn', function() {
        let category = decodeURIComponent(($.urlParam('cat')))
        $.ajax({
            type: 'POST',
            url: base_url + '/diamond/reset',
            data: {
                _token: $('#token').val()
            },
            success: function(res) {
                console.log(res);
                window.location.href = base_url + '/design-your-own-diamond-' + category + '?cat=' + category;
            },
        });
    });

    function updateProductPrice() {
        updateData();
        if ($('#product-size-chart').val() == 'null') {
            goldPrice = goldPriceList[selectedCarat];
            goldWeight = goldWeightList[selectedCarat];
            makingCharge = makingChargeList[selectedCarat];
        } else {
            goldPrice = goldPriceList[selectedCarat][selectedSize];
            goldWeight = goldWeightList[selectedCarat][selectedSize];
            makingCharge = makingChargeList[selectedCarat][selectedSize];
        }
        let solitairePreset = $('#solitaire_preset').val();
        let is_diamond = $('#is_diamond').val();

        if (is_diamond === 'yes') {
            diamondBuyPrice = diamondPriceList[selectedDiamond]['diamond_buy_price']
            diamondDiscount = diamondPriceList[selectedDiamond]['diamond_discount'];
            diamondBasePrice = diamondPriceList[selectedDiamond]['diamond_base_price'];
        }

        gst = Math.round(((parseFloat(goldPrice) + Math.round(parseFloat(stonePrice)) + parseFloat(diamondBuyPrice) + parseFloat(makingCharge)) * 3) / 100);
        totalAmount = (parseFloat(goldPrice) + Math.round(parseFloat(stonePrice)) + parseFloat(diamondBasePrice) + parseFloat(makingCharge));
        buyPrice = (parseFloat(goldPrice) + Math.round(parseFloat(stonePrice)) + parseFloat(diamondBuyPrice) + parseFloat(makingCharge));
        finalBuyPriceWithGst = buyPrice + gst;

        $('#' + selectedCarat + 'K_gold_weight').val(goldWeight);
        $('#selected-metal-weight-info').text(goldWeight + 'gm');

        if (diamondDiscount == 0) {
            $('.disc-price').addClass('d-none');
            $('.disc-percentage').addClass('d-none');
            $('.discount-text').addClass('d-none');
        } else {
            $('.disc-price').removeClass('d-none');
            $('.disc-percentage').removeClass('d-none');
            $('.discount-text').removeClass('d-none');
        }

        $('.subtotal-price').text(format.format(buyPrice) + ' /-');
        $('.disc-price').text(format.format(totalAmount) + ' /-');
        $('.gold-price-info').text(format.format(goldPrice) + ' /-');
        $('.diamond-price-info').text(format.format(diamondBuyPrice) + ' /-');
        // $('.solitaire-price-info').text(solitairePresetPrice);
        $('.making-charges-info').text(format.format(makingCharge) + ' /-');
        // $('.gst-price-info').html(format.format(gst) + ' /-');
        $('.total-price-info').html(format.format(buyPrice) + ' /-');

        $('#selected-gold-weight').val(goldWeight);
        $('#selected-product-color').val(selectedColorCode);
        $('#selected-solitaire').val(selectedSolitaireQuality);
        $('#selected-solitaire-carat').val(selectedSolitaireCarat);
        $('#selected-product-size').val(selectedSize);
        $('#selected-diamond-quality').val(selectedDiamond);
        $('#selected-gold-carat').val(selectedCarat);

    }


    function filterDiamondData() {
        filteredData = apiSolitaire;
        if (filterParam.cut && filterParam.cut.length > 0) {
            filteredData = filteredData.filter(obj => filterParam.cut.includes(obj.Cut));
        }
        if (filterParam.color && filterParam.color.length > 0) {
            filteredData = filteredData.filter(obj => filterParam.color.includes(obj.Color));
        }
        if (filterParam.clarity && filterParam.clarity.length > 0) {
            filteredData = filteredData.filter(obj => filterParam.clarity.includes(obj.Clarity));
        }
        if (filterParam.polish && filterParam.polish.length > 0) {
            filteredData = filteredData.filter(obj => filterParam.polish.includes(obj.Pol));
        }
        if (filterParam.fl && filterParam.fl.length > 0) {
            filteredData = filteredData.filter(obj => filterParam.fl.includes(obj.DisplayFl));
        }
        if (filterParam.lab && filterParam.lab.length > 0) {
            filteredData = filteredData.filter(obj => filterParam.lab.includes(obj.Cert));
        }
        if (filterParam.sym && filterParam.sym.length > 0) {
            filteredData = filteredData.filter(obj => filterParam.sym.includes(obj.Sym));
        }
        if (filterParam.shape && filterParam.shape.length > 0) {
            filteredData = filteredData.filter(obj => filterParam.shape.includes(obj.DisplayShape));
        }
        if (filterParam.carat) {
            filteredData = filteredData.filter(obj => filterParam.carat.min <= obj.Weight && filterParam.carat.max >= obj.Weight);
        }
        if (filterParam.price) {
            filteredData = filteredData.filter(obj => filterParam.price.min <= obj.Price && filterParam.price.max >= obj.Price);
        }
        if (filterParam.table) {
            filteredData = filteredData.filter(obj => filterParam.table.min <= obj.Table && filterParam.table.max >= obj.Table);
        }
        if (filterParam.depth) {
            filteredData = filteredData.filter(obj => filterParam.depth.min <= obj.TopDepth && filterParam.depth.max >= obj.TopDepth);
        }
        currentPage = 1
        displayList(filteredData, $('#solitaire-table')[0], itemsPerPage, 1);

    }

    function displayList(items, wrapper, itemsPerPage, page) {
        wrapper.innerHTML = "";
        page--;
        $('#filtered_total').text(items.length)
        let start = itemsPerPage * page;
        let end = start + itemsPerPage;
        let paginatedItems = items.slice(start, end);
        // if (paginatedItems.length == 0) $('#solitaire-table').append(`<tr><td class="text-center" colspan="12">No Diamond Found!</td></tr>`);

        $.fn.dataTableExt.sErrMode = 'none'
        let table = new DataTable('#solitaire-table', {
            responsive: true,
            destroy: true,
            columns: [{
                    data: "DisplayShape",
                    title: 'Shape'
                },
                {
                    data: "Weight",
                    title: 'Carat'
                },
                {
                    data: "Price",
                    title: 'Price(₹)',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = format.format(row.Price) + '/-';
                        }
                        return data;
                    },
                },
                {
                    data: "Clarity",
                    title: 'Clarity'
                },
                {
                    data: "DisplayCut",
                    title: 'Cut'
                },
                {
                    data: "Color",
                    title: 'Color'
                },
                {
                    data: "DisplayPol",
                    title: 'Polish'
                },
                {
                    data: "DisplayFl",
                    title: 'Flourescence'
                },
                {
                    data: "Cert",
                    title: 'Certificate Type'
                },
                {
                    data: "CertNo",
                    title: 'Certificate No.'
                },
                {
                    data: "Diameter",
                    title: 'Measurements'
                },
                {
                    "data": "RefNo",
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `<button class="btn btn-link view-solitair-btn" data-diamond="r" data-id="${row.RefNo}">View Details</button>`;
                        }
                        return data;
                    },
                    title: "View"
                },
            ],
            data: filteredData,
            "language": {
                "emptyTable": "No data available"
            },
            "paging": true,
            searching: false
        });



        // paginatedItems.forEach(function(diamond) {
        //     console.log(diamond.Price);
        //     let diamondRow = `
        //                 <tr>
        //                     <td>${diamond.DisplayShape}</td>
        //                     <td>${diamond.Weight}</td>
        //                     <td>${formatNumberWithCommas(diamond.Price)}</td>
        //                     <td>${diamond.Clarity}</td>
        //                     <td>${diamond.DisplayCut}</td>
        //                     <td>${diamond.Color}</td>
        //                     <td>${diamond.DisplayPol}</td>
        //                     <td>${diamond.DisplayFl}</td>
        //                     <td>${diamond.Cert}</td>
        //                     <td>${diamond.CertNo}</td>
        //                     <td>${diamond.Diameter}</td>
        //                     <td><button class="btn btn-link view-solitair-btn" data-diamond="r" data-id="${diamond.RefNo}">View Details</button></td>
        //                 </tr>
        //                 `;
        //     $('#solitaire-table').append(diamondRow);
        // });
    }

    function formatNumberWithCommas(number) {
        // return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        format = new Intl.NumberFormat('hi-IN', {
            style: 'currency',
            currency: 'INR',
            minimumFractionDigits: 0,
        });
        return format;
    }

    $(document).on('click', '.view-solitair-btn', function() {
        let refNo = $(this).data('id');
        let diamond = $(this).data('diamond');
        console.log('refNo : ', refNo);

        filterSolitaire = apiSolitaire.filter(
            diamond => diamond.RefNo == refNo
        );
        var base_url = $('#base_url').val();
        var token = $('#token').val();
        const solitaireData = filterSolitaire[0];
        $.ajax({
            type: 'POST',
            url: base_url + '/show-solitaire-detail', // Replace with your endpoint
            data: {
                _token: token,
                solitaireData: solitaireData,
                product: `{{$_GET['cat']}}`
            },
            success: function(res) {
                if (res.flag === 1) {
                    window.location.href = base_url + '/solitaire-detail';
                } else {
                    Toast(res.msg, 3000, res.flag);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    })
    $(document).on('click', '.cut-option-input', function() {
        var cut = $(this).val();
        if ($(this).prop('checked')) {
            cutParam.push(cut)
            filterParam.cut = cutParam
            filterDiamondData()
            $(this).parent('.cut-option').addClass('active');
        } else {
            let index = cutParam.indexOf(cut);
            if (index !== -1) {
                cutParam.splice(index, 1);
            }
            filterParam.cut = cutParam;
            filterDiamondData()
            $(this).parent('.cut-option').removeClass('active');
        }
    });
    $(document).on('click', '.shape-option-input', function() {
        var shape = $(this).val();
        if ($(this).prop('checked')) {
            shapeParam.push(shape)
            filterParam.shape = shapeParam
            filterDiamondData()
            $(this).parent('.shape-opt').addClass('active');
        } else {
            let index = shapeParam.indexOf(shape);
            if (index !== -1) {
                shapeParam.splice(index, 1);
            }
            console.log(shapeParam);
            filterParam.shape = shapeParam;
            filterDiamondData()
            $(this).parent('.shape-opt').removeClass('active');
        }
    });
    $(document).on('click', '.color-option-input', function() {
        var color = $(this).val();
        if ($(this).prop('checked')) {
            colorParam.push(color)
            filterParam.color = colorParam
            filterDiamondData()
            $(this).parent('.color-opt').addClass('active');
        } else {
            let index = colorParam.indexOf(color);
            if (index !== -1) {
                colorParam.splice(index, 1);
            }
            console.log(colorParam);
            filterParam.color = colorParam;
            filterDiamondData()
            $(this).parent('.color-opt').removeClass('active');
        }
    });
    $(document).on('click', '.clarity-option-input', function() {
        var clarity = $(this).val();
        if ($(this).prop('checked')) {
            clarityParam.push(clarity)
            filterParam.clarity = clarityParam
            filterDiamondData()
            $(this).parent('.clarity-opt').addClass('active');
        } else {
            let index = clarityParam.indexOf(clarity);
            if (index !== -1) {
                clarityParam.splice(index, 1);
            }
            console.log(clarityParam);
            filterParam.clarity = clarityParam;
            filterDiamondData()
            $(this).parent('.clarity-opt').removeClass('active');
        }
    });
    $(document).on('change', '.polish-opt', function() {
        var polish = $(this).val();
        if ($(this).prop('checked')) {
            polishParam.push(polish)
            filterParam.polish = polishParam
            filterDiamondData()
        } else {
            let index = polishParam.indexOf(polish);
            if (index !== -1) {
                polishParam.splice(index, 1);
            }
            console.log(polishParam);
            filterParam.polish = polishParam;
            filterDiamondData()
        }
        if (polishParam.length > 0) {
            $('#polishDropdown').text('Polish (' + polishParam.length + ')')
        } else {
            $('#polishDropdown').text('Polish')
        }
    });
    $(document).on('change', '.fl-opt', function() {
        var fl = $(this).val();
        if ($(this).prop('checked')) {
            flParam.push(fl)
            filterParam.fl = flParam
            filterDiamondData()
        } else {
            let index = flParam.indexOf(fl);
            if (index !== -1) {
                flParam.splice(index, 1);
            }
            console.log(flParam);
            filterParam.fl = flParam;
            filterDiamondData()
        }
        if (flParam.length > 0) {
            $('#fluorescenceDropdown').text('Fluorescence (' + flParam.length + ')')
        } else {
            $('#fluorescenceDropdown').text('Fluorescence')
        }
    });
    $(document).on('change', '.lab-opt', function() {
        var lab = $(this).val();
        if ($(this).prop('checked')) {
            labParam.push(lab)
            filterParam.lab = labParam
            filterDiamondData()
        } else {
            let index = labParam.indexOf(lab);
            if (index !== -1) {
                labParam.splice(index, 1);
            }
            console.log(labParam);
            filterParam.lab = labParam;
            filterDiamondData()
        }
        if (labParam.length > 0) {
            $('#labDropdown').text('Lab (' + labParam.length + ')')
        } else {
            $('#labDropdown').text('Lab')
        }
    });
    $(document).on('change', '.sym-opt', function() {
        var sym = $(this).val();
        if ($(this).prop('checked')) {
            symParam.push(sym)
            filterParam.sym = symParam
            filterDiamondData()
        } else {
            let index = symParam.indexOf(sym);
            if (index !== -1) {
                symParam.splice(index, 1);
            }
            console.log(symParam);
            filterParam.sym = symParam;
            filterDiamondData()
        }
        if (symParam.length > 0) {
            $('#symmetryDropdown').text('Symmetrys (' + symParam.length + ')')
        } else {
            $('#symmetryDropdown').text('Symmetrys')
        }
    });

    // Price Input filter
    $("#price-min,#price-max").on("change", function() {
        let min_price_range = parseInt($("#price-min").val());
        let max_price_range = parseInt($("#price-max").val());
        if (min_price_range > max_price_range) {
            $("#price-max").val(min_price_range);
        }
        $("#price-slider-range").slider({
            values: [min_price_range, max_price_range],
        });
        filterParam.price.min = min_price_range
        filterParam.price.max = max_price_range
        console.log(filterParam)
        filterDiamondData()
    });
    $("#price-min,#price-max").on("paste keyup", function() {
        let min_price_range = parseInt($("#price-min").val());
        let max_price_range = parseInt($("#price-max").val());
        $("#price-slider-range").slider({
            values: [min_price_range, max_price_range],
        });
        filterParam.price.min = min_price_range
        filterParam.price.max = max_price_range
        console.log(filterParam)
        filterDiamondData()
    });

    // Carat Input filter
    $("#carat-min,#carat-max").on("change", function() {
        let min_price_range = parseFloat($("#carat-min").val());
        let max_price_range = parseFloat($("#carat-max").val());
        if (min_price_range > max_price_range) {
            $("#carat-max").val(min_price_range);
        }
        $("#carat-slider-range").slider({
            values: [min_price_range, max_price_range],
        });
        filterParam.carat.min = min_price_range
        filterParam.carat.max = max_price_range
        console.log(filterParam)
        filterDiamondData()
    });
    $("#carat-min,#carat-max").on("paste keyup", function() {
        let min_price_range = parseFloat($("#carat-min").val());
        let max_price_range = parseFloat($("#carat-max").val());
        $("#carat-slider-range").slider({
            values: [min_price_range, max_price_range],
        });
        filterParam.carat.min = min_price_range
        filterParam.carat.max = max_price_range
        console.log(filterParam)
        filterDiamondData()
    });

    // Table Input filter
    $("#table-min,#table-max").on("change", function() {
        let min_price_range = parseInt($("#table-min").val());
        let max_price_range = parseInt($("#table-max").val());
        if (min_price_range > max_price_range) {
            $("#table-max").val(min_price_range);
        }
        $("#table-slider-range").slider({
            values: [min_price_range, max_price_range],
        });
        filterParam.table.min = min_price_range
        filterParam.table.max = max_price_range
        console.log(filterParam)
        filterDiamondData()
    });
    $("#table-min,#table-max").on("paste keyup", function() {
        let min_price_range = parseInt($("#table-min").val());
        let max_price_range = parseInt($("#table-max").val());
        $("#table-slider-range").slider({
            values: [min_price_range, max_price_range],
        });
        filterParam.table.min = min_price_range
        filterParam.table.max = max_price_range
        console.log(filterParam)
        filterDiamondData()
    });

    // Depth Input filter
    $("#depth-min,#depth-max").on("change", function() {
        let min_price_range = parseInt($("#depth-min").val());
        let max_price_range = parseInt($("#depth-max").val());
        if (min_price_range > max_price_range) {
            $("#depth-max").val(min_price_range);
        }
        $("#depth-slider-range").slider({
            values: [min_price_range, max_price_range],
        });
        filterParam.depth.min = min_price_range
        filterParam.depth.max = max_price_range
        console.log(filterParam)
        filterDiamondData()
    });
    $("#depth-min,#depth-max").on("paste keyup", function() {
        let min_price_range = parseInt($("#depth-min").val());
        let max_price_range = parseInt($("#depth-max").val());
        $("#depth-slider-range").slider({
            values: [min_price_range, max_price_range],
        });
        filterParam.depth.min = min_price_range
        filterParam.depth.max = max_price_range
        console.log(filterParam)
        filterDiamondData()
    });

    $(document).on('click', '#clear-filter', function() {
        $("[name='shapeOption']").prop("checked", false);
        $("[name='cutOption']").prop("checked", false);
        $("[name='colorOption']").prop("checked", false);
        $("[name='clarityOption']").prop("checked", false);

        $('.color-opt').removeClass('active');
        $('.shape-opt').removeClass('active');
        $('.cut-opt').removeClass('active');
        $('.clarity-opt').removeClass('active');

        $('.polish-opt').prop('checked', false);
        $('.sym-opt').prop('checked', false);
        $('.lab-opt').prop('checked', false);
        $('.fl-opt').prop('checked', false);

        $('#polishDropdown').text('Polish');
        $('#symmetryDropdown').text('Symmetrys');
        $('#labDropdown').text('Lab');
        $('#fluorescenceDropdown').text('Fluorescence');

        $('#price-min').val(minPriceValue);
        $('#price-max').val(maxPriceValue);
        $('#carat-min').val(minValue);
        $('#carat-max').val(maxValue);
        $('#table-min').val(mintableValue);
        $('#table-max').val(maxtableValue);
        $('#depth-min').val(minDepthValue);
        $('#depth-max').val(maxDepthValue);

        $("#carat-slider-range").slider({
            values: [minValue, maxValue],
        });
        $("#price-slider-range").slider({
            values: [minPriceValue, maxPriceValue],
        });
        $("#depth-slider-range").slider({
            values: [minDepthValue, maxDepthValue],
        });
        $("#table-slider-range").slider({
            values: [mintableValue, maxtableValue],
        });

        filterParam = {
            cut: [],
            color: [],
            clarity: [],
            shape: [],
            fl: [],
            lab: [],
            shape: [],
            sym: [],
            carat: {
                min: minValue,
                max: maxValue + 1
            },
            price: {
                min: minPriceValue,
                max: maxPriceValue + 1000
            },
            table: {
                min: mintableValue,
                max: maxtableValue + 1
            },
            depth: {
                min: minDepthValue,
                max: maxDepthValue + 1
            },
        };
        console.log("Reset Filter : ", filterParam);
        filterDiamondData()
    })
</script>

@stop