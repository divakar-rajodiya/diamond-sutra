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

<main>
    <div class="page-title mb-3">
        <div class="page-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Solitaire Diamonds</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active step-2" id="choose-diamond" role="tabpanel" aria-labelledby="choose-diamond-tab">
                <div class="choose-setting-wrapper mx-2">
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
                                                    <span><img src="http://localhost:8080/diamondsutra/public/assets/img/shape/round.png"> Round</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Pear" class="shape-option-input">
                                                    <span><img src="http://localhost:8080/diamondsutra/public/assets/img/shape/pear.png">Pear</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Heart" class="shape-option-input">
                                                    <span><img src="http://localhost:8080/diamondsutra/public/assets/img/shape/heart.png">Heart</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Princess" class="shape-option-input">
                                                    <span><img src="http://localhost:8080/diamondsutra/public/assets/img/shape/princess.png">Princess</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Emerald" class="shape-option-input">
                                                    <span><img src="http://localhost:8080/diamondsutra/public/assets/img/shape/emerald.png">Emerald</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Cushion" class="shape-option-input">
                                                    <span><img src="http://localhost:8080/diamondsutra/public/assets/img/shape/cushion.png">Cushion</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Marquise" class="shape-option-input">
                                                    <span><img src="http://localhost:8080/diamondsutra/public/assets/img/shape/marquise.png">Marquise</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Oval" class="shape-option-input">
                                                    <span><img src="http://localhost:8080/diamondsutra/public/assets/img/shape/oval.png">Oval</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Radiant" class="shape-option-input">
                                                    <span><img src="http://localhost:8080/diamondsutra/public/assets/img/shape/radiant.png">Radiant</span>
                                                </label>
                                                <label class="cut-option btn btn-outline-secondary shape-opt">
                                                    <input type="checkbox" name="shapeOption" value="Trilliant" class="shape-option-input">
                                                    <span><img src="http://localhost:8080/diamondsutra/public/assets/img/shape/trilliant.png">Trilliant</span>
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
                                        <img src="http://localhost:8080/diamondsutra/public/assets/img/spinner.gif" alt="">
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

        $('.accordion-collapse').addClass('show');
        $('.accordion-button').click(function() {
            var targetCollapse = $(this).attr('data-bs-target');
            var isExpanded = $(this).attr('aria-expanded') === 'true';
            if (isExpanded) {
                $(targetCollapse).removeClass('show');
            }
        });

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
                    tempJson.PRICE = format.format(ele.product_buy_price)
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

                maxPriceValue = apiSolitaire[apiSolitaire.length - 1].product_buy_price;
                minPriceValue = apiSolitaire[0].product_buy_price;
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

                console.log("Intial Filter :", filterParam);
                filterDiamondData()
            }
        });

    });

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
            filteredData = filteredData.filter(obj => filterParam.price.min <= obj.product_buy_price && filterParam.price.max >= obj.product_buy_price);
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
                            data = format.format(row.product_buy_price) + '/-';
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
            searching: false,
            "order": [[2, 'asc']]
        });

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
            },
            success: function(res) {
                if (res.flag === 1) {
                    window.location.href = base_url + '/solitaire-details/';
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