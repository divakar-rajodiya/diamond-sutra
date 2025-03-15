@extends('layouts.admin')
@section('content')

<div class="layout-sidenav-content">
    <div class="p-4 p-md-5">
        <div class="md-form-group float-label">
            <input type="text" class="md-input d-none" name="email_broadcas" id="site_content_ck">
        </div>
        <form action="{{url('admin/upload-product-seo-data')}}" id="upload-csv-form" method="post">
            @csrf
            <div class="mb-3 row d-flex align-items-end">
                <h4>Upload Product SEO CSV File</h4>
               
                <div class="col-lg-3 col-md-3 col-12 mb-2">
                    <label for="csv_file">Select Product SEO CSV File</label>
                    <input class="form-control bg-transparent ps-4" type="file" id="csv_file" name="csv_file">
                </div>
               
                <div class="col-lg-3 col-md-3 col-12 mb-2">
                    <button type="button" id="upload-csv-btn" class="btn text-white text-uppercase w-100 rounded-5">Submit</button>
                </div>
            </div>
        </form>

        <form action="{{url('admin/upload-product-desc-data')}}" id="upload-desc-csv-form" method="post">
            @csrf
            <div class="mb-3 row d-flex align-items-end">
                <h4>Upload Product Description csv</h4>
               
                <div class="col-lg-3 col-md-3 col-12 mb-2">
                    <label for="csv_file">Select Product Description CSV File</label>
                    <input class="form-control bg-transparent ps-4" type="file" id="csv_file" name="csv_file">
                </div>
               
                <div class="col-lg-3 col-md-3 col-12 mb-2">
                    <button type="button" id="upload-desc-csv-btn" class="btn text-white text-uppercase w-100 rounded-5">Submit</button>
                </div>
            </div>
        </form>
    </div>


    @endsection
    @section('footer')
    <script>
        $(document).on("click", "#upload-desc-csv-btn", function () {
            $("#upload-desc-csv-btn").prop("disabled", true);
            $("#upload-desc-csv-form")
                .ajaxForm(function (res) {
                    Toast(res.msg, 3000, res.flag);
                    if (res.flag == 1) {
                        $("#upload-desc-csv-form")[0].reset();
                    }
                    $("#upload-desc-csv-btn").prop("disabled", false);
                })
                .submit();
        });
    </script>
    @stop