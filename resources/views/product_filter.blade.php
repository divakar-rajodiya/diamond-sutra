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
                <!-- <div class="advance-search">
                    <form action="#">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search products…">
                            <button type="button" class="btn" data-bs-dismiss="modal"><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div> -->
                <h3 class="m-0 text-capitalize fw-bold">{{$body['heading']}}</h3>
                <div class="d-flex flex-wrap justify-content-end ms-auto align-items-center gap-2">
                    <input type="hidden" name="" id="category" value="">
                    <input type="hidden" name="" id="search" value="">
                    <input type="hidden" name="" id="price_from" value="">
                    <input type="hidden" name="" id="price_to" value="">
                    <input type="hidden" name="" id="sol" value="">
                    @if(isset($body['subcategoryList']))
                    <select id="subcategory" name="" class="orderby form-select" style="text-transform:capitalize;" aria-label="Shop order">
                    <option value="" selected disabled> Type </option>
                        @foreach($body['subcategoryList'] as $subcategory)
                        @if($subcategory['category_id'] == 4 && $subcategory['name'] == 'Pendants without chain')
                        @continue
                        @endif
                        <option value="{{$subcategory['name']}}" data-id="{{$subcategory['id']}}" @if($subcategory['id']==$body['filters']['sc']) {{'selected'}} @endif> {{$subcategory['name'] }}</option>
                        @endforeach
                    </select>
                    @endif
                    @php $sort = $body['filters']['sort']; @endphp
                    <select id="sorting" name="" class="orderby form-select" aria-label="Shop order">
                        <option value="relevance">Relevance</option>
                        <option value="popularity" @if($sort=='popularity' ) {{"selected"}} @endif>Sort by popularity</option>
                        <option value="date" @if($sort=='date' ) {{"selected"}} @endif>Sort by latest</option>
                        <option value="price" @if($sort=='price' || $sort == null) {{"selected"}} @endif>Sort by price: low to high</option>
                        <option value="price-desc" @if($sort=='price-desc' ) {{"selected"}} @endif>Sort by price: high to low</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="" id="load_more" value="1">
            <input type="hidden" name="" id="page_no" value="1">
            <div class="row gy-3" id="product-data">
                <!-- <div class="col-12 mt-4 mt-md-5">
                    <nav aria-label="navigation" class="product-pagination">
                        <ul class="pagination justify-content-center gap-2">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                        </ul>
                    </nav>
                </div> -->
            </div>
            <div class="col-12 col-lg-12 col-xl-12" id="no-record" style="display: none;">
                <center>No Product Found!</center>  
            </div>
        </div>
        
    </div>
</main>


@stop
@section('footer')
<script>
    $(document).ready(function() {
        var container = document.getElementById('lazyLoadContainer');
        var url = new URL(window.location.href);
        var params = new URLSearchParams(url.search);
        var category = params.get('c');
        var subcategory = params.get('sc');
        var mainSegment = 0;
        console.log('main segment', mainSegment);
       
        if(category == null || category == undefined){
            var path = url.pathname.split('/');
            category = path[mainSegment+1]; // This would be 'Category'
            
            if(category === 'solitaire-rings'){
                category = 'Rings';
                subcategory = 'sol';
            } else if(category === 'solitaire-pendants'){
                category = 'Pendants';
                subcategory = 'sol';
            } else if(category === 'solitaire-earrings'){
                category = 'Earrings';
                subcategory = 'sol';
            } else {
                mainSegment++;
                category = path[mainSegment+1];
                if(path[mainSegment+2] != undefined)
                    subcategory = path[mainSegment+2].replace(/-/g, ' ');
                else 
                    subcategory = '';
            }
        }
        console.log('category', category);
        console.log('subcategory', subcategory);
        var search = params.get('search');
        var range = params.get('range');
        var to = params.get('to');
        if(subcategory != 'sol')
            $('#subcategory').val(subcategory);
        else
            $('#sol').val(subcategory);
        $('#category').val(category);
        $('#search').val(search);
        $('#price_from').val(range);
        $('#price_to').val(to);
        product_filter();
        $(window).scroll(async function() {
            console.log(' CH : ' + $(container).height() + ' DH: ' + $(document).height() + ' WST: ' + $(window).scrollTop());
            if (($(window).scrollTop() >= $(container).height() - 600) && $('#load_more').val() != 0) {
                $('#load_more').val(0);
                let res = await product_filter();
            }
        });
    });

    $(document).on('change','#subcategory', function(){
        $('#page_no').val(1);
        $('#load_more').val(1);
        product_filter();
    });

    $(document).on('change','#sorting', function(){
        $('#page_no').val(1);
        $('#load_more').val(1);
        product_filter();
    });


    async function product_filter() {
        var pageNo = $('#page_no').val();
        var itemPerPage = 8;
        var subcategory = $('#subcategory').find(':selected').data('id');
        var type = '';
        var category = $('#category').val();
        var sol = $('#sol').val();
        if(sol == 'sol'){
            subcategory = 'sol';
            type = $('#subcategory').find(':selected').data('id');
        }
        var search = $('#search').val();
        var range_from = $('#price_from').val();
        var range_to = $('#price_to').val();
        let sorting = $('#sorting').val();
        let base_url = $('#base_url').val();
        let token = $('#token').val();
        var data = {
            currentPage: pageNo,
            itemPerPage: itemPerPage,
            c: category,
            sc: subcategory,
            type: type,
            search: search,
            range: range_from,
            sort : sorting,
            to: range_to,
            _token: token
        };

        $.ajax({
            type: 'POST',
            url: base_url + '/product-filter',
            data : data,
            success: function(res) {
                if (res.flag === 1) {
                    if(pageNo == 1){
                        if(res.total_record > 0){
                            $('#no-record').hide();
                            $('#product-data').show();
                            $('#product-data').html(res.blade);
                        } else {
                            $('#product-data').hide();
                            $('#no-record').show();
                        }
                    } else {
                        if(res.total_record > 0){
                            $('#no-record').hide();
                            $('#product-data').show();
                            $('#product-data').append(res.blade);
                        } else {
                            $('#product-data').hide();
                            $('#no-record').show();
                        }
                    }
                    $('#load_more').val(1);
                    pageNo = parseInt(pageNo) + 1;
                    $('#page_no').val(parseInt(pageNo));
                }
            },
        });
    }
    $(document).on('click', '.like-btn', function() {
        var elem = $(this);
        $(this).addClass('fill-heart');
        var productId = $(this).data('id');
        let base_url = $('#base_url').val();
        $.ajax({
            type: 'GET',
            url: base_url + '/update-wishlist/' + productId,
            success: function(res) {
                console.log(res);
                if (res.flag === 1) {
                    Toast(res.msg, 3000, res.flag);
                    if (res.data === 'added') $(elem).addClass('fill-heart');
                    else $(elem).removeClass('fill-heart');
                }
            },
        });
    });
</script>
@stop