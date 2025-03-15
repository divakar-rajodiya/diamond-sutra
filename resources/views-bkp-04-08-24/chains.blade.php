@extends('layouts.site')
@section('content')

<main>
    <div class="page-title">
        <div class="page-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                        <li class="breadcrumb-item active" aria-current="page">{{$body['title']}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="lazyLoadContainer" class="search-product-wrapper">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
               
                <h3 class="m-0 text-capitalize fw-bold">{{$body['heading']}}</h3>
                <div class="d-flex flex-wrap justify-content-end ms-auto align-items-center gap-2">
                    <input type="hidden" name="" id="category" value="">
                    <input type="hidden" name="" id="search" value="">
                    <input type="hidden" name="" id="price_from" value="">
                    <input type="hidden" name="" id="price_to" value="">
                  
                    @php $sort = $body['filters']['sort']; @endphp
                    <!-- <select id="sorting" name="" class="orderby form-select" aria-label="Shop order">
                        <option value="relevance" @if($sort=='null' ) {{"selected"}} @endif>Relevance</option>
                        <option value="popularity" @if($sort=='popularity' ) {{"selected"}} @endif>Sort by popularity</option>
                        <option value="date" @if($sort=='date' ) {{"selected"}} @endif>Sort by latest</option>
                        <option value="price" @if($sort=='price' ) {{"selected"}} @endif>Sort by price: low to high</option>
                        <option value="price-desc" @if($sort=='price-desc' ) {{"selected"}} @endif>Sort by price: high to low</option>
                    </select> -->
                </div>
            </div>
            <input type="hidden" name="" id="load_more" value="1">
            <input type="hidden" name="" id="page_no" value="1">
            <div class="row gy-3" id="product-data">
                @foreach($body['chains'] as $product)
                <div class="col-6 col-lg-4 col-xl-3">
                    <a href="{{ url('chain').'/'.$product['product_sku'].'/'.$product['default_color'].'-gold/'.str_replace(' ', '-', $product['name']) }}">

                        <div class="single-product-card">
                            <div class="product-img">
                                @php $color = config('constant.COLOR_CODE.'.$product['default_color']);@endphp
                                <img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_'.$color.'1.jpg'}}" class="image-main" alt="">
                                @php        
                                    $checkImage = \General::checkProductImages($product['product_sku'],$color);
                                @endphp
                                @if($checkImage['model_image'])
                                    <img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_Model_'.$color.'.jpg'}}" class="image-hover" alt="">
                                @endif
                            </div>
                            <div class="product-content">
                                <a href="{{url('chain').'/'.$product['product_sku'].'/'.$product['default_color'].'-gold/'.str_replace(' ', '-',$product['name'])}}" class="product-title">{{$product['name']}}</a>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="proPrice">
                                        {{\General::currency_format($product['default_buy_price'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="col-6 col-lg-4 col-xl-3" id="no-record" style="display: none;">
                <h2>No Products found</h2>
            </div>
        </div>

    </div>
</main>


@stop
@section('footer')

@stop