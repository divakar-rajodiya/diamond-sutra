@extends('layouts.admin')
@section('content')

<style>
    .product-tag-main .ss-multi-selected{
        padding: 8px 10px;
        border-radius: 8px;
        border-color: rgba(0, 0, 0, 0.2);
    }
</style>
<div class="layout-sidenav-content">
    <div class="p-4 p-md-5">
        <div class="md-form-group float-label">
            <input type="text" class="md-input d-none" name="email_broadcas" id="site_content_ck">
        </div>
        <form action="{{url('admin/upload-product-data')}}" id="upload-csv-form" method="post">
            @csrf
            <div class="mb-3 row d-flex align-items-end">
                <h4>Upload Product CSV File</h4>
                <div class="col-lg-3 col-md-3 col-12 mb-2">
                    <!-- <div class="form-floating mb-3"> -->
                        <label for="categorySelect">Select Main Category</label>
                        <select class="form-select bg-transparent" name="category" id="categorySelect" >
                            @foreach($body['category'] as $category)
                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                            @endforeach
                        </select>
                    <!-- </div> -->
                </div>
                <div class="col-lg-3 col-md-3 col-12 mb-2">
                    <label for="csv_file">Select Product CSV File</label>
                    <input class="form-control bg-transparent ps-4" type="file" id="csv_file" name="csv_file">
                </div>
                <div class="col-lg-3 col-md-3 col-12 mb-2 product-tag-main">
                    <!-- <div class="p-3 mb-3" style="border-radius: 10px;border: 1px solid rgba(0, 0, 0, 0.2)"> -->
                        <label for="multiple"><label for="categorySelect">Select Sub Category</label></label>
                        <select class="bg-transparent" name="sub_category[]" id="multiple" data-choices="data-choices" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                            @foreach($body['subcategory'] as $sc)
                            <option value="{{$sc['id']}}">{{$sc['name']}}</option>
                            @endforeach
                        </select>
                    <!-- </div> -->
                </div>
                <div class="col-lg-3 col-md-3 col-12 mb-2">
                    <button type="button" id="upload-csv-btn" class="btn text-white text-uppercase w-100 rounded-5">Submit</button>
                </div>
            </div>
        </form>
        <div class="col-lg-12">
            <div class="row form-group">
                <div class="col-lg-3 col-sm-4 py-2">
                    <input type="text" class="form-control bg-transparent" name="" id="search" placeholder="search">
                </div>
                <div class="col-lg-2 col-sm-4 py-2">
                    <button id="admin-search" class="btn btn-dark btn-md">Search</button>
                    <button id="admin-reset" class="btn btn-dark btn-md"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                </div>
                <div class="col-lg-2 col-sm-4 py-2">
                </div>
            </div>
            <div class="table-responsive" id="product-table">
               
            </div>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
            <div class="p-4"></div>
        </div>
    </div>

    <div class="modal fade" id="deleteProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteProductModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteProductModalLabel">Delete Product</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete_product_form" method="post" action="{{url('admin/product/delete')}}"> 
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">
                        <div>
                            <p>Are you sure ?</p>
                        </div>
                        <button type="button" id="delete_product_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var productUrl = `{{url('admin/product/list')}}`;
        var getSubCategory = `{{url('admin/subcategory/get')}}`;
    </script>
    @endsection
    @section('footer')
    <script>
        $(document).on('click','#admin-search', function (){
            flushFilters(true);
            filterData(productUrl, "product-table");
        });
        
        $(document).on('click','#admin-reset', function (){
            $('#search').val('');
            flushFilters(true);
            filterData(productUrl, "product-table");
        });
    </script>
    @stop