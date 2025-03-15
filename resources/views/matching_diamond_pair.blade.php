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
                        <li class="breadcrumb-item active" aria-current="page">Design your own Solitaire Earring</li>
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
                                <h4>DIAMONDS PAIR</h4>
                            </div>
                        </div>
                        <div class="step-ring">
                            <span style="font-size: 0px; fill: rgb(198, 200, 206); width: 21px">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 43.39 29.2">
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
                                            <path class="cls-1" d="M21.19,14.75c0-.05,0-.1,0-.15s0-.1,0-.15l0-.14c0-.05,0-.1-.05-.14l0-.08L21,14,21,14,11.5.47h0a1.25,1.25,0,0,0-.16-.17L11.25.21,11.13.15l-.19-.1h0l-.12,0a1.46,1.46,0,0,0-.22,0l-.15,0a.86.86,0,0,0-.17,0h0a.79.79,0,0,0-.16.08L10,.21s0,.06-.08.08a.85.85,0,0,0-.16.17h0L.19,14l0,.06,0,.06a.26.26,0,0,0,0,.08.58.58,0,0,0,0,.14l0,.14a1.13,1.13,0,0,0,0,.3l0,.14a.78.78,0,0,0,0,.14.26.26,0,0,0,0,.08l0,.06,0,.06L9.7,28.73h0l0,.05a1.37,1.37,0,0,0,.17.17L10,29l.2.1.06,0h0a.93.93,0,0,0,.6,0h0l.05,0,.21-.1.08-.06a1.45,1.45,0,0,0,.18-.17l0-.05h0L21,15.23s0,0,0-.06l0-.06,0-.08.05-.14ZM10.6,18.84,7.89,15l-.28-.39,3-4.25.59.85,2.4,3.4-1.87,2.65Zm4.9-5.34L11.7,8.09V4.57L18,13.5Zm-6-8.93V8.09L5.69,13.5H3.21ZM5.69,15.7,6.9,17.41,9.5,21.1v3.53L3.21,15.7Zm6,8.93V21.1l3.8-5.4H18Z" />
                                            <path class="cls-1" d="M43.38,14.74a.61.61,0,0,0,0-.14.76.76,0,0,0,0-.15.32.32,0,0,0,0-.14.58.58,0,0,0-.05-.14s0-.05,0-.08L43.23,14l0-.06L33.69.47h0a1.06,1.06,0,0,0-.15-.15l-.1-.1-.1,0a1.39,1.39,0,0,0-.21-.11h0L33,0a1.33,1.33,0,0,0-.21,0L32.6,0l-.14,0h0l-.19.1-.11.06-.1.1a1.06,1.06,0,0,0-.15.15h0L22.39,14s0,0,0,.06l-.05.06s0,.05,0,.08a.58.58,0,0,0-.05.14.32.32,0,0,0,0,.14,1.13,1.13,0,0,0,0,.3.39.39,0,0,0,0,.14.78.78,0,0,0,.05.14s0,.05,0,.08l.05.06s0,0,0,.06l9.5,13.5h0s0,0,0,0a.77.77,0,0,0,.18.18l.08.06.21.1.05,0h0a.93.93,0,0,0,.29.05.94.94,0,0,0,.3-.05h0l0,0,.21-.1.08-.06a1.53,1.53,0,0,0,.18-.18l0,0h0l9.51-13.5,0-.06.05-.06,0-.08a.78.78,0,0,0,.05-.14A.4.4,0,0,0,43.38,14.74Zm-7.6-.14-3,4.24-3-4.24,3-4.25.82,1.16Zm1.92-1.1-1.8-2.56-2-2.85V4.57l6.29,8.93Zm-6-8.93V8.09l-3.8,5.41H25.41ZM27.89,15.7l3.8,5.4v3.53L25.41,15.7Zm6,8.93V21.1l3.81-5.4h2.48Z" />
                                        </g>
                                    </g>
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.45 24.2">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: #c6c8ce;
                                            }
                                        </style>
                                    </defs>
                                    <title>Asset 3</title>
                                    <g id="Layer_2" data-name="Layer 2">
                                        <g id="OBJECTS">
                                            <path class="cls-1" d="M8.73,3.48a1.89,1.89,0,0,0,.87-1.6A1.83,1.83,0,1,0,6,1.88a1.89,1.89,0,0,0,.87,1.6L.11,13a.59.59,0,0,0,0,.69L7.29,23.94a.59.59,0,0,0,.49.26.61.61,0,0,0,.49-.26l7.17-10.21a.59.59,0,0,0,0-.69Zm-1-2.28a.66.66,0,0,1,.62.68.63.63,0,1,1-1.25,0A.66.66,0,0,1,7.78,1.2Zm0,21.36L1.33,13.38,7.78,4.21l6.44,9.17Z" />
                                            <path class="cls-1" d="M31.35,13,24.63,3.48a1.89,1.89,0,0,0,.87-1.6,1.83,1.83,0,1,0-3.65,0,1.89,1.89,0,0,0,.87,1.6L16,13a.59.59,0,0,0,0,.69l7.18,10.21a.59.59,0,0,0,.49.26.61.61,0,0,0,.49-.26l7.18-10.21A.62.62,0,0,0,31.35,13ZM23.68,1.2a.66.66,0,0,1,.62.68.63.63,0,1,1-1.25,0A.66.66,0,0,1,23.68,1.2Zm0,21.36-6.45-9.18,6.45-9.17,6.44,9.17Z" />
                                        </g>
                                    </g>
                                </svg>
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
                                <span>complete</span>
                                <h4 id="step-3-name">{{$_GET['cat']}}</h4>
                            </div>
                        </div>
                        <div class="step-ring">
                            <span style="font-size: 0px; fill: rgb(198, 200, 206); width: 21px">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.44 24.2">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: #c6c8ce;
                                            }
                                        </style>
                                    </defs>
                                    <title>Asset 4</title>
                                    <g id="Layer_2" data-name="Layer 2">
                                        <g id="OBJECTS">
                                            <path class="cls-1" d="M15.5,13.23s0-.09,0-.12l0,0s0,0,0,0L8.72,3.48a1.89,1.89,0,0,0,.87-1.6,1.83,1.83,0,1,0-3.65,0,1.89,1.89,0,0,0,.87,1.6L.1,13a.06.06,0,0,0,0,0l0,0a.42.42,0,0,0,0,.12.8.8,0,0,0,0,.15.76.76,0,0,0,0,.16.53.53,0,0,0,0,.12l0,0a.06.06,0,0,0,0,0L7.28,23.94h0a.58.58,0,0,0,.19.16l0,0s0,0,.07,0a.56.56,0,0,0,.36,0s0,0,.06,0l.05,0A.43.43,0,0,0,8.25,24h0l7.17-10.21s0,0,0,0l0,0a.5.5,0,0,0,0-.12.41.41,0,0,0,0-.16A.4.4,0,0,0,15.5,13.23Zm-4.15-.45-3-4.24V5.07l5.42,7.71Zm-3.58-3,1.32,1.88,1.22,1.73L7.77,17,5.23,13.38l1-1.37Zm0-8.57a.66.66,0,0,1,.62.68.63.63,0,1,1-1.25,0A.66.66,0,0,1,7.77,1.2Zm-.6,3.87V8.54L5.64,10.7,4.18,12.78H1.75ZM4.18,14l1,1.38,2,2.87V21.7L1.75,14ZM8.37,21.7V18.23l2.11-3L11.35,14h2.44Z" />
                                            <path class="cls-1" d="M31.44,13.38a.42.42,0,0,0,0-.15s0-.09,0-.12l0,0a.06.06,0,0,1,0,0L24.62,3.48a1.89,1.89,0,0,0,.87-1.6,1.83,1.83,0,1,0-3.65,0,1.89,1.89,0,0,0,.87,1.6L16,13a.06.06,0,0,0,0,0l0,0s0,.08,0,.12a.8.8,0,0,0,0,.15.76.76,0,0,0,0,.16s0,.08,0,.12l0,0a.06.06,0,0,0,0,0l7.18,10.21h0a.58.58,0,0,0,.19.16l.06,0s0,0,.06,0a.56.56,0,0,0,.36,0s0,0,.06,0l.05,0a.53.53,0,0,0,.2-.16h0l7.18-10.21a.06.06,0,0,1,0,0l0,0a.5.5,0,0,0,0-.12A.42.42,0,0,0,31.44,13.38Zm-4.19-.6-3-4.25V5.07l5.42,7.71ZM23.67,17l-2.54-3.62,1-1.37,1.58-2.24,2.08,3,.46.65-2,2.89Zm0-15.8a.66.66,0,0,1,.62.68.63.63,0,1,1-1.25,0A.66.66,0,0,1,23.67,1.2Zm-.6,3.87V8.53l-3,4.25H17.65Zm-3,8.91,3,4.25V21.7L17.65,14Zm4.19,7.72V18.23l3-4.25h2.44Z" />
                                        </g>
                                    </g>
                                </svg>
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
                                            <div class="w-100">
                                                <!-- <div class="slider">
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
                                                </div> -->
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
                                                <!-- <div class="slider">
                                                    <div class="progress" id="price-progress"></div>
                                                </div>
                                                <div class="range-input" id="price-range-input">
                                                    <input type="range" class="range-min" id="price-min-range" min="0" max="10000" value="0" step="1000">
                                                    <input type="range" class="range-max" id="price-max-range" min="0" max="10000" value="10000" step="1000">
                                                </div>
                                                <div class="price-input" id="price-input">
                                                    <div class="field">
                                                        <input type="number" id="price-min" class="input-min" value="0">
                                                    </div>
                                                    <div class="field">
                                                        <input type="number" id="price-max" class="input-max" value="1000">
                                                    </div>
                                                </div> -->
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
                        <div class="tab-pane fade" id="labDiamond" role="tabpanel" aria-labelledby="lab-diamond">
                            <div class="diamond-option-wrapper">
                                <div class="row gy-4 gy-lg-5">
                                    <div class="col-lg-6">
                                        <div class="diamond-filter-option">
                                            <h2>shape <i class="fa-regular fa-circle-question"></i></h2>
                                            <ul class="diamond-shape-list">
                                                <li>
                                                    <label class="single-shape-btn">
                                                        <input type="radio" name="Radio1" value="shape1" checked="">
                                                        <span class="shape-label"><i class="fa-regular fa-gem"></i></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="single-shape-btn">
                                                        <input type="radio" name="Radio1" value="shape2">
                                                        <span class="shape-label"><i class="fa-regular fa-gem"></i></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="single-shape-btn">
                                                        <input type="radio" name="Radio1" value="shape3">
                                                        <span class="shape-label"><i class="fa-regular fa-gem"></i></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="single-shape-btn">
                                                        <input type="radio" name="Radio1" value="shape4">
                                                        <span class="shape-label"><i class="fa-regular fa-gem"></i></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="single-shape-btn">
                                                        <input type="radio" name="Radio1" value="shape5">
                                                        <span class="shape-label"><i class="fa-regular fa-gem"></i></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="single-shape-btn">
                                                        <input type="radio" name="Radio1" value="shape6">
                                                        <span class="shape-label"><i class="fa-regular fa-gem"></i></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="single-shape-btn">
                                                        <input type="radio" name="Radio1" value="shape7">
                                                        <span class="shape-label"><i class="fa-regular fa-gem"></i></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="single-shape-btn">
                                                        <input type="radio" name="Radio1" value="shape8">
                                                        <span class="shape-label"><i class="fa-regular fa-gem"></i></span>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="diamond-filter-option">
                                            <h2>Cut <i class="fa-regular fa-circle-question"></i></h2>
                                            <ul></ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="diamond-filter-option">
                                            <h2>Color <i class="fa-regular fa-circle-question"></i></h2>
                                            <div class="w-100"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="diamond-filter-option">
                                            <h2>Carat<i class="fa-regular fa-circle-question"></i></h2>
                                            <div class="w-100"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="diamond-filter-option">
                                            <h2>Clarity<i class="fa-regular fa-circle-question"></i></h2>
                                            <div class="w-100"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="diamond-filter-option">
                                            <h2>Clarity<i class="fa-regular fa-circle-question"></i></h2>
                                            <div class="w-100"></div>
                                        </div>
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
                                        <div class="d-flex justify-content-center"  style="display: none;">
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
                            <h3>Earring Settings <span class="total-available-product">[{{count($body['solitiarProduct'])}}]</span></h3>
                            <p>Our selection of earring settings includes every metal and every style. Yellow gold, white
                                gold, platinum, and rose gold; vintage, modern, classic or trendy, Diamond Sutra has the perfect
                                earring setting for you. Whether you are choosing a timeless diamond or a colorful gemstone,
                                we have the ideal engagement ring setting that will shine as bright. A momentous moment deserves
                                nothing less than pure excellence, our collection of earring settings ensures that you are
                                able to present the ideal ring.</p>
                        </div>
                        <div class="product-grid">
                            <div class="row gy-3">
                                <div class="col-lg-9">
                                    <div class="row gy-3">
                                        @foreach($body['solitiarProduct'] as $product)
                                        @php $color = config('constant.COLOR_CODE.'.$product['default_color']);@endphp
                                        @php
                                        $diamond =$product['diamond'];
                                        if(isset($diamond[0]['price_GH_SI']))
                                        $price = $diamond[0]['price_GH_SI'];
                                        else
                                        $price = $diamond[0]['carat'] * $body['settings']['price_IJ_SI'];
                                        @endphp
                                        <div class="col-6 col-lg-4 solitare_setting_product" style="cursor: pointer;" data-id="{{$product['id']}}">
                                            <input type="hidden" name="" value="{{json_encode($product)}}">
                                            <div class="single-product-card">
                                                <div class="product-img">
                                                    <img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_'.$color.'1.webp'}}" class="image-main" alt="">
                                                    <img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_Model_'.$color.'.webp'}}" class="image-hover" alt="">
                                                </div>
                                                <div class="product-content">
                                                    <a href="ring-detail.html" class="product-title">{{$product['name']}}</a>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="proPrice">
                                                            {{\General::currency_format($product['default_buy_price'])}}
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
                                            @php
                                            $selectsolitaire[] = $selectedDiamond[0];
                                            $selectsolitaire[] = $selectedDiamond[1];
                                            @endphp
                                            @foreach($selectsolitaire as $sl)
                                            <div class="my-2">
                                                <img src="{{$sl['ImageLink']}}" alt="Diamond Image" class="img-fluid w-100">
                                                <a href="javasript::void(0)" class="text-decoration-underline">{{$sl['Weight']}} carat {{$sl['DisplayShape']}} Diamond</a>
                                                <h6 class="fs-14">{{\General::currency_format($sl['product_buy_price'],0,'',',')}}</h6>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="border border-top p-4">
                                            <h6><b>TOTAL</b><br>
                                                {{\General::currency_format($selectedDiamond['total_price'],0,'',',')}}
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
                <input type="hidden" id="making-charge-discount-list" value="{{json_encode($selectedProduct['making_charge_discount_list'])}}">
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
                <input type="hidden" id="selected-solitaire" value="{{$selectedProduct['solitaire_default_quality']}}">
                {{-- <input type="hidden" id="selected-solitaire-carat" value="{{$selectedProduct['solitaire_default_carat']}}"> --}}
                <div class="row">
                    <div class="col-lg-5">
                        <div>
                            <div class="slider-content">
                                <div class="xzoom-container h-100">
                                    <a data-fancybox-trigger="gallery" href="javascript:;">
                                        <img class="xzoom h-100 w-100 image-1" id="xzoom-default" src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W1.webp'}}" xoriginal="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W1.webp'}}" />
                                    </a>
                                </div>
                            </div>
                            <div class="video-play-section w-100 h-100 d-flex justify-content-center d-none">
                                <video id="video1" class="w-100 h-100 " width="520" height="240" controls autoplay muted loop>
                                    <source id="video-source-1" src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W.mp4'}}" type="video/mp4">
                                    <source id="video-source-2" src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W.ogg'}}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="slider-thumb">
                                <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W1.webp'}}" alt="" class="img-fluid thumb-image thumb-image-1"></div>
                                <div class="slide"><img src="{{url('public/assets/img/video-thumb.png')}}" alt="" class="img-fluid video-thumb-image"></div>
                                <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W2.webp'}}" alt="" class="img-fluid thumb-image thumb-image-2"></div>
                                <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_W3.webp'}}" alt="" class="img-fluid thumb-image thumb-image-3"></div>
                                <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$selectedProduct['product_sku'].'/'.$selectedProduct['product_sku'].'_Model_W.webp'}}" alt="" class="img-fluid thumb-image thumb-model-image"></div>
                            </div>
                        </div>
                        <div class="certification">
                            <p class="my-2 fw-bold text-capitalize fs-6 pb-2 border-bottom">100% certified Jewelry</p>
                            <ul class="d-flex flex-wrap justify-content-center align-items-center gap-2 gap-lg-3 list-unstyled">
                                <li class=""><span class="small text-uppercase">Certified By</span></li>
                                <li class="sgl">
                                    <a href="https://sgl-labs.com/" class="d-inline-block" target="_blank">
                                        <img src="{{url('public/assets/img/gsi.png')}}" class="img-fluid" alt="" style="width:120px;height:40px;">
                                    </a>
                                </li>
                                <li class="sgl">
                                    <a href="https://www.bis.gov.in/" class="d-inline-block" target="_blank">
                                        <img src="{{url('public/assets/img/certificate-2.png')}}" class="img-fluid" alt="" style="width:120px;height:40px;">
                                    </a>
                                </li>
                                <li class="sgl">
                                    <a href="https://www.gia.edu/gem-lab-service/diamond-grading" class="d-inline-block" target="_blank">
                                        <img src="{{url('public/assets/img/certificate-3.png')}}" class="img-fluid" alt="" style="width:120px;height:40px;">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="product-info-panel">

                            <h3 class="product-info-title" id="product-name">{{$selectedProduct['name']}}</h3>
                            <div class="product-info-price">
                                <span class="subtotal-price">{{\General::currency_format($selectedProduct['default_buy_price'])}}</span><span class="disc-price">{{\General::currency_format($selectedProduct['default_base_price'])}}</span><span class="disc-percentage">-{{$selectedProduct['diamond_price_list'][$selectedProduct['default_diamond_quality']]['diamond_discount']}}%</span> <span class="discount-text">(On Diamond)</span>
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
                            <div class="mb-2 mb-lg-3 d-flex flex-wrap align-items-center gap-2 gap-lg-3">
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
                            </div>
                            @endif

                            @if($selectedProduct['size_chart'] != null)
                            <div class="mb-2 mb-lg-3 d-flex flex-wrap align-items-center gap-2 gap-lg-3">
                                <div class="dropdown-wrapper ring-size-wrapper">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="size-chart" data-bs-toggle="dropdown" aria-expanded="false">{{$selectedProduct['size_chart_name']}} size</button>
                                        <ul class="dropdown-menu" style="max-height: 200px;overflow-y: auto;" aria-labelledby="size-chart">
                                            @foreach($selectedProduct['size_chart'] as $size)
                                            <li><a data-size="{{$size}}" class="dropdown-item ring-size-filter @if($size == $selectedProduct['default_size']) {{'active'}} @endif" href="javascript:void(0)">{{$size}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="cart-btn-group">
                                <a href="javascript:void(0)" id="btn-buy-now" class="btn primary-btn large-btn w-100 mb-2 mb-sm-3">Buy Now</a>
                                <button class="btn w-100 btn-outline-dark large-btn" id="back-to-setting">Back To Setting</button>
                            </div>
                            <div class="d-flex flex-wrap align-items-center gap-2 ms-auto mb-2 question-reach-out">
                                <p class="m-0 fw-bold me-2">If you have any questions, reach out to us</p>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="tel:+919799975281" class="fs-4 text-success p-1"><i class="fa-solid fa-phone"></i></a>
                                    <span class="mx-1 fw-bold mb-0">or</span>
                                    <a href="https://api.whatsapp.com/send?phone=919799975281&amp;text=Hi! Need information on the product | https://diamondsutra.in" class="fs-4 text-success p-1"><i class="fa-brands fa-whatsapp"></i></a>
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
                        <div class="border border-dark text-center bg-light fs-14">
                            <h6 class="bg-dark text-white p-4">Your Selected Solitaire</h6>
                            <div class="select-product-list">
                                @php
                                $selectsolitaire[] = $selectedDiamond[0];
                                $selectsolitaire[] = $selectedDiamond[1];
                                @endphp
                                @foreach($selectsolitaire as $sl)
                                <div class="my-2">
                                    <img src="{{$sl['ImageLink']}}" alt="Diamond Image" class="img-fluid w-100">
                                    <a href="javasript::void(0)" class="text-decoration-underline">{{$sl['Weight']}} carat {{$sl['DisplayShape']}} Diamond</a>
                                    <h6 class="fs-14">{{\General::currency_format($sl['product_buy_price'],0,'',',')}}</h6>
                                </div>
                                @endforeach
                            </div>
                            <div class="border border-top p-4">
                                <h6><b>TOTAL</b><br>
                                    {{\General::currency_format($selectedDiamond['total_price'],0,'',',')}}
                                </h6>
                                <div><button class="btn btn-outline-dark" id="choose-diamond-btn">Choose Another Diamond</button></div>
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
                                                    <td>{{$selectedProduct['dimension']['height']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Width <i class="fa fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Width can vary in the final product."></i></td>
                                                    <td>{{$selectedProduct['dimension']['width']}}</td>
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
                                    <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">SOLITAIRE DETAILS</button>
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
                            @if($selectedProduct['is_solitaire'] == 'yes')
                            <!-- <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSolitaire">
                            <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">SOLITAIRE DETAILS</button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingSolitaire" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="product-info-table">
                                <tr>
                                    <td>Solitaire Quality</td>
                                    <td class="display-solitaire-quality-info">{{$selectedProduct['diamond_quality_display_list'][$selectedProduct['solitaire_default_quality']]}}</td>
                                </tr>
                                <tr>
                                    <td>Total Weight</td>
                                    <td class="display-solitaire-weight">{{$selectedProduct['solitaire_default_carat']}}</td>
                                </tr>
                                <tr>
                                    <td>Total No. of Solitaires</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>Shape</td>
                                    <td>Round</td>
                                </tr>
                                <tr>
                                    <td>Cut-Polish-Symmetry</td>
                                    <td>Min. VG - VG - VG</td>
                                </tr>
                                <tr>
                                    <td>Fluorescence</td>
                                    <td>NONE</td>
                                </tr>
                                </table>
                            </div>
                            </div>
                        </div> -->
                            @endif
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">METAL DETAILS</button>
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
                                                <td><span class="diamond-price-info"> </span> <strike><span class="diamond-price-actual-info fw-bold"></span></strike></td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>Making Charges</td>
                                                <td><span class="making-charges-info"> </span> <strike><span class="making-charge-actual-info fw-bold"></span></strike></td>
                                            </tr>
                                            <tr>
                                                <td>GST</td>
                                                <td class="gst-price-info">{{$selectedProduct['default_gst']}}</td>
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

<script>

    /* The redirect to autoplay page function */
    function redirect(){
        window.location.href = `{{ asset('/') }}`;
    }
    var initial=setTimeout(redirect,1800000);
    console.log(initial);
    $(document).click(function(event) { 
        clearTimeout( initial );
        initial=setTimeout(redirect,1800000); 
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
    var stonePrice = 0;
    if($('#stone-price').val() != '')
      stonePrice = $('#stone-price').val();

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

    $(document).on('click', '.solitare_setting_product', function() {
        var product = $(this).children('input').val();
        var base_url = $('#base_url').val();
        var selectedSolitaire = localStorage.getItem('selected_solitaire');
        let category = decodeURIComponent(($.urlParam('cat')))
        if (selectedSolitaire) {
            $.ajax({
                type: 'POST',
                url: base_url + '/product/pair/select', // Replace with your endpoint
                data: {
                    _token: $('#token').val(),
                    id: $(this).data('id'),
                },
                success: function(res) {
                    // Redirect the user to the checkout page
                    if (res.flag === 1) {
                        window.location.href = base_url + '/design-your-own-solitaire-earrings?cat=' + category + '&selected=2';
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

    var maxValue;
    var minValue;

    var maxPriceValue;
    var minPriceValue;

    var maxtableValue;
    var mintableValue;

    var maxDepthValue;
    var minDepthValue;

    $(document).ready(function() {

        let displayThirdStep = `{{$displayThirdStep}}`
        let displayFirstStep = `{{$displayFirstStep}}`
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
            makingChargeDiscountList = JSON.parse($('#making-charge-discount-list').val());
            diamondPriceList = JSON.parse($('#diamond-price-list').val());
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
                playPause();
            })

            $(document).on('click', '.video-thumb-image', function() {
                $('.slider-content').addClass('d-none');
                $('.video-play-section').removeClass('d-none');
                playPause();
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

        var diamondSelected = "{{$diamondSelected}}";
        if (diamondSelected == 1) {
            $('#setting-diamond-tab').click();
        }

        if (displayFirstStep != 0) {
            $('#diamond-loader').show();
            $.ajax({
                url: base_url + '/diamond-pair',
                method: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#diamond-loader').hide();
                    apiSolitaire = res.data;
                    $('#total_diamond').text(res.data.length)
                    console.log(apiSolitaire);
                    filteredData = apiSolitaire;
                    totalRecord = apiSolitaire.length

                    maxValue = apiSolitaire.reduce((max, obj) => (parseFloat(obj[0].Weight) > max ? obj[0].Weight : max), parseFloat(apiSolitaire[0][0].Weight));
                    minValue = apiSolitaire.reduce((min, obj) => (parseFloat(obj[0].Weight) < min ? obj[0].Weight : min), parseFloat(apiSolitaire[0][0].Weight));


                    maxValue = parseFloat(maxValue)
                    minValue = parseFloat(minValue)
                    console.log("Max", maxValue)
                    console.log("Min", minValue)
                    $('#carat-min').val(minValue)
                    $('#carat-max').val(maxValue)

                    maxPriceValue = apiSolitaire[apiSolitaire.length - 1].total_price;
                    minPriceValue = apiSolitaire[0].total_price;

                    console.log("Max Price", maxPriceValue)
                    console.log("Min Price", minPriceValue)
                    $('#price-min').val(minPriceValue)
                    $('#price-max').val(maxPriceValue)

                    maxtableValue = apiSolitaire.reduce((max, obj) => (parseFloat(obj[0].Table) > max ? obj[0].Table : max), parseFloat(apiSolitaire[0][0].Table));
                    mintableValue = apiSolitaire.reduce((min, obj) => (parseFloat(obj[0].Table) < min ? obj[0].Table : min), parseFloat(apiSolitaire[0][0].Table));

                    maxtableValue = parseInt(maxtableValue)
                    mintableValue = parseInt(mintableValue)

                    console.log("Max Table", maxtableValue)
                    console.log("Min Table", mintableValue)
                    $('#table-min').val(mintableValue)
                    $('#table-max').val(maxtableValue)

                    maxDepthValue = apiSolitaire.reduce((max, obj) => (parseFloat(obj[0].TopDepth) > max ? obj[0].TopDepth : max), parseFloat(apiSolitaire[0][0].TopDepth));
                    minDepthValue = apiSolitaire.reduce((min, obj) => (parseFloat(obj[0].TopDepth) < min ? obj[0].TopDepth : min), parseFloat(apiSolitaire[0][0].TopDepth));

                    maxDepthValue = parseInt(maxDepthValue)
                    minDepthValue = parseInt(minDepthValue)
                    console.log("Max Depth", maxDepthValue)
                    console.log("Min Depth", minDepthValue)
                    $('#depth-min').val(minDepthValue)
                    $('#depth-max').val(maxDepthValue)

                    $(function() {
                        $("#price-slider-range").slider({
                            range: true,
                            min: minPriceValue,
                            max: maxPriceValue,
                            values: [minPriceValue, maxPriceValue],
                            step: 1000,
                            slide: function(event, ui) {
                                $('#price-min').val(ui.values[0])
                                $('#price-max').val(ui.values[1])
                                filterParam.price.min = ui.values[0]
                                filterParam.price.max = ui.values[1]
                                console.log(filterParam)
                                filterDiamondData()
                            },
                        });
                        $('#price-min').val($("#price-slider-range").slider("values", 0))
                        $('#price-max').val($("#price-slider-range").slider("values", 1))
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

                    filterDiamondData()
                }
            });
        }

    });

    $(document).on('click', '#btn-buy-now',async function() {
        if( $('#selected-product-size').val() != ''){
            let size = $('#change-product-size').val();
            if(size == '' || size == undefined) {
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

        const selectedSolitaire = '';
        const selectedSolitaireCarat = '';

        // add to cart section

        let custProdParam = {
            sku: productSku,
            product_type: 'solitaire_setting', //  solitaire or product
            color: selectedColor,
            size: selectedProductSize,
            diamond: selectedDiamondQuality,
            goldCarat: selectedGoldCarat,
            solitaire: selectedSolitaire,
            solitaireCarat: selectedSolitaireCarat
        }

        let res = await getProductPrice(custProdParam);
        if(res.flag != 1){
            Toast(res.msg, 3000, res.flag);
            return;
        }

        let settingDetail = await res.data;
        let solitairePairDetail = JSON.parse(localStorage.getItem('selected_solitaire')) || {};
        
        let cart = JSON.parse(localStorage.getItem('cart')) || {};
        let mount_id = solitairePairDetail[0].cart_id;

        for (let key in cart) {
            if (cart[key].mount_id == mount_id && cart[key].product_type == 'solitaire_setting') {
                delete cart[key];
            }
        }

        solitairePairDetail.forEach(solitaireDetail => {
            delete cart[solitaireDetail.cart_id];
        });

        localStorage.setItem('cart', JSON.stringify(cart));
        cart = JSON.parse(localStorage.getItem('cart')) || {};

        let sort_index = Object.keys(cart).length;
        solitairePairDetail.forEach(solitaireDetail => {     
            console.warn('sort index : ',sort_index);
            solitaireDetail.sort_index = sort_index;
            sort_index++;
            solitaireDetail.mount_id = mount_id;
            // add solitaire in cart
            cart[solitaireDetail.cart_id] = solitaireDetail;
            
        });
        
        console.warn(sort_index);
        sort_index = Object.keys(cart).length;
        settingDetail.sort_index = sort_index;
        // get selected solitaire 
        settingDetail.mount_id = mount_id;
        // add setting in cart
        cart[settingDetail.cart_id] = settingDetail;
        

        localStorage.setItem('cart', JSON.stringify(cart));
        refreshCartLogo();

        window.location.replace(base_url + '/cart');

        // add to cart end 
    })

    $.urlParam = function(name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }

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

    function updateProductPrice() {
        updateData();
        if ($('#product-size-chart').val() == 'null') {
            goldPrice = goldPriceList[selectedCarat];
            goldWeight = goldWeightList[selectedCarat];
            makingCharge = makingChargeList[selectedCarat];
            makingChargeActual = makingChargeDiscountList[selectedCarat]['actual_price'];
        } else {
            goldPrice = goldPriceList[selectedCarat][selectedSize];
            goldWeight = goldWeightList[selectedCarat][selectedSize];
            makingCharge = makingChargeList[selectedCarat][selectedSize];
            makingChargeActual = makingChargeDiscountList[selectedCarat]['actual_price'];
        }
        let solitairePreset = $('#solitaire_preset').val();
        let is_diamond = $('#is_diamond').val();

        if (is_diamond === 'yes') {
            diamondBuyPrice = diamondPriceList[selectedDiamond]['diamond_buy_price'];
            diamondDiscount = diamondPriceList[selectedDiamond]['diamond_discount'];
            diamondBasePrice = diamondPriceList[selectedDiamond]['diamond_base_price'];
        }

        gst = (((parseFloat(goldPrice) + Math.round(parseFloat(stonePrice)) + parseFloat(diamondBuyPrice) + parseFloat(makingCharge)) * 3) / 100);
        totalAmount = (parseFloat(goldPrice) + Math.round(parseFloat(stonePrice)) + parseFloat(diamondBasePrice) + parseFloat(makingChargeActual));
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

        let priceWithGst
        $('.subtotal-price').text(format.format(Math.round(buyPrice + gst)) + ' /-');
        $('.disc-price').text(format.format(Math.round(totalAmount + gst)) + ' /-');
        $('.gold-price-info').text(format.format(goldPrice) + ' /-');
        $('.diamond-price-info').text(format.format(diamondBuyPrice) + ' /-');
        $('.diamond-price-actual-info').text(format.format(diamondBasePrice) + '/-');
        // $('.solitaire-price-info').text(solitairePresetPrice);
        $('.making-charges-info').text(format.format(makingCharge) + ' /-');
        $('.making-charge-actual-info').text(format.format(makingChargeActual) + '/-');
        $('.gst-price-info').html(format.format(Math.round(gst)) + ' /-');
        $('.total-price-info').html(format.format(Math.round(buyPrice + gst)) + ' /-');

        $('#selected-gold-weight').val(goldWeight);
        $('#selected-product-color').val(selectedColorCode);
        $('#selected-solitaire').val(selectedSolitaireQuality);
        $('#selected-solitaire-carat').val(selectedSolitaireCarat);
        $('#selected-product-size').val(selectedSize);
        $('#selected-diamond-quality').val(selectedDiamond);
        $('#selected-gold-carat').val(selectedCarat);

    }

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
        $('#xzoom-default').attr('src', defaultImagePath + '_' + selectedColorCode + '1.webp');
        $('#xzoom-default').attr('xoriginal', defaultImagePath + '_' + selectedColorCode + '1.webp');

        $('.thumb-image-1').attr('src', defaultImagePath + '_' + selectedColorCode + '1.webp');
        $('.thumb-image-2').attr('src', defaultImagePath + '_' + selectedColorCode + '2.webp');
        $('.thumb-image-3').attr('src', defaultImagePath + '_' + selectedColorCode + '3.webp');
        $('.thumb-model-image').attr('src', defaultImagePath + '_Model_' + selectedColorCode + '.webp');

        $('#selected-metal-info').text(selectedCarat + 'K Gold');

        if (defaultVideo === '0') {
            $('#video-source-1').attr('src', defaultImagePath + '.mp4');
            $('#video-source-2').attr('src', defaultImagePath + '.ogg');
            let myVideo = document.getElementById("video1");
            myVideo.load();
            myVideo.play();
        } else {
            $('#video-source-1').attr('src', defaultImagePath + '_' + selectedColorCode + '.mp4');
            $('#video-source-2').attr('src', defaultImagePath + '_' + selectedColorCode + '.ogg');
            //   let myVideo = document.getElementById("video1");
            //   myVideo.load();
            //   myVideo.play();
        }
    }

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
                if (res.flag === 1)
                    $('#estimated-date').html('<b>Estimated Delivery by date: </b>' + res.data);
            },
        });
    });

    function filterDiamondData() {
        filteredData = apiSolitaire;
        if (filterParam.cut && filterParam.cut.length > 0) {
            filteredData = filteredData.filter(obj => (filterParam.cut.includes(obj[0].Cut) && filterParam.cut.includes(obj[1].Cut)));
        }
        if (filterParam.color && filterParam.color.length > 0) {
            filteredData = filteredData.filter(obj => (filterParam.color.includes(obj[0].Color) && filterParam.color.includes(obj[1].Color)));
        }
        if (filterParam.clarity && filterParam.clarity.length > 0) {
            filteredData = filteredData.filter(obj => (filterParam.clarity.includes(obj[0].Clarity) && filterParam.clarity.includes(obj[1].Clarity)));
        }
        if (filterParam.polish && filterParam.polish.length > 0) {
            filteredData = filteredData.filter(obj => (filterParam.polish.includes(obj[0].Pol) && filterParam.polish.includes(obj[1].Pol)));
        }
        if (filterParam.fl && filterParam.fl.length > 0) {
            filteredData = filteredData.filter(obj => (filterParam.fl.includes(obj[0].DisplayFl) && filterParam.fl.includes(obj[1].DisplayFl)));
        }
        if (filterParam.lab && filterParam.lab.length > 0) {
            filteredData = filteredData.filter(obj => (filterParam.lab.includes(obj[0].Cert) && filterParam.lab.includes(obj[1].Cert)));
        }
        if (filterParam.sym && filterParam.sym.length > 0) {
            filteredData = filteredData.filter(obj => (filterParam.sym.includes(obj[0].Sym) && filterParam.sym.includes(obj[1].Sym)));
        }
        if (filterParam.shape && filterParam.shape.length > 0) {
            filteredData = filteredData.filter(obj => (filterParam.shape.includes(obj[0].DisplayShape) && filterParam.shape.includes(obj[1].DisplayShape)));
        }
        if (filterParam.carat) {
            filteredData = filteredData.filter(obj => (filterParam.carat.min <= obj[0].Weight && filterParam.carat.max >= obj[0].Weight) && (filterParam.carat.min <= obj[1].Weight && filterParam.carat.max >= obj[1].Weight));
        }
        if (filterParam.price) {
            filteredData = filteredData.filter(obj => filterParam.price.min <= obj.total_price && filterParam.price.max >= obj.total_price);
        }
        if (filterParam.table) {
            filteredData = filteredData.filter(obj => (filterParam.table.min <= obj[0].Table && filterParam.table.max >= obj[0].Table) && (filterParam.table.min <= obj[1].Table && filterParam.table.max >= obj[1].Table));
        }
        if (filterParam.depth) {
            filteredData = filteredData.filter(obj => (filterParam.depth.min <= obj[0].TopDepth && filterParam.depth.max >= obj[0].TopDepth) && (filterParam.depth.min <= obj[1].TopDepth && filterParam.depth.max >= obj[1].TopDepth));
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

        $.fn.dataTableExt.sErrMode = 'none'
        let table = new DataTable('#solitaire-table', {
            responsive: true,
            destroy: true,
            columns: [{
                    title: 'Shape',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `${row[0].DisplayShape}<br>${row[1].DisplayShape}`
                        }
                        return data;
                    },
                },
                {
                    title: 'Carat',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `${row[0].Weight}<br>${row[1].Weight}`
                        }
                        return data;
                    },
                },
                {
                    title: 'Price(₹)',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = format.format(row.total_price) + '/-';
                        }
                        return data;
                    },
                },
                {
                    title: 'Clarity',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `${row[0].Clarity}<br>${row[1].Clarity}`
                        }
                        return data;
                    },
                },
                {
                    title: 'Cut',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `${row[0].DisplayCut}<br>${row[1].DisplayCut}`
                        }
                        return data;
                    },
                },
                {
                    title: 'Color',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `${row[0].Color}<br>${row[1].Color}`
                        }
                        return data;
                    },
                },
                {
                    title: 'Polish',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `${row[0].DisplayPol}<br>${row[1].DisplayPol}`
                        }
                        return data;
                    },
                },
                {
                    title: 'Flourescence',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `${row[0].DisplayFl}<br>${row[1].DisplayFl}`
                        }
                        return data;
                    },
                },
                {
                    title: 'Certificate Type',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `${row[0].Cert}<br>${row[1].Cert}`
                        }
                        return data;
                    },
                },
                {
                    title: 'Certificate No.',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `${row[0].CertNo}<br>${row[1].CertNo}`
                        }
                        return data;
                    },
                },
                {
                    title: 'Measurements',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `${row[0].Diameter}<br>${row[1].Diameter}`
                        }
                        return data;
                    },
                },
                {
                    "data": "RefNo",
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = `<button class="btn btn-link view-solitair-btn" data-diamond="r" data-ref-0="${row[0].RefNo}" data-ref-1="${row[1].RefNo}">View Details</button>`;
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
            searching: false,
            "order": [[2, 'asc']]
        });
    }

    function formatNumberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    $.urlParam = function(name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }

    $(document).on('click', '.view-solitair-btn', function() {
        let refNo_0 = $(this).data('ref-0');
        let refNo_1 = $(this).data('ref-1');
        let diamond = $(this).data('diamond');

        filterSolitaire = apiSolitaire.filter(
            diamond => diamond[0].RefNo == refNo_0 && diamond[1].RefNo == refNo_1
        );
        console.warn('get data sol : ', filterSolitaire[0]);
        var base_url = $('#base_url').val();
        var token = $('#token').val();
        const solitaireData = filterSolitaire[0];
        $.ajax({
            type: 'POST',
            url: base_url + '/show-solitaire-pair-detail',
            data: {
                _token: token,
                solitaireData: solitaireData,
                product: decodeURIComponent(($.urlParam('cat'))),
            },
            success: function(res) {
                if (res.flag === 1) {
                    window.location.href = base_url + '/solitaire-pair-detail';
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
        if (min_price_range == max_price_range) {
            max_price_range = min_price_range + 1000;
            $("#price-min").val(min_price_range);
            $("#price-max").val(max_price_range);
        }
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
        let min_price_range = parseInt($("#carat-min").val());
        let max_price_range = parseInt($("#carat-max").val());
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
        let min_price_range = parseInt($("#carat-min").val());
        let max_price_range = parseInt($("#carat-max").val());
        if (min_price_range == max_price_range) {
            max_price_range = min_price_range + 1000;
            $("#carat-min").val(min_price_range);
            $("#carat-max").val(max_price_range);
        }
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
        if (min_price_range == max_price_range) {
            max_price_range = min_price_range + 1000;
            $("#table-min").val(min_price_range);
            $("#table-max").val(max_price_range);
        }
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
        if (min_price_range == max_price_range) {
            max_price_range = min_price_range + 1000;
            $("#depth-min").val(min_price_range);
            $("#depth-max").val(max_price_range);
        }
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