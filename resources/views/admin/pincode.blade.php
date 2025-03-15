@extends('layouts.admin')
@section('content')
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">
        <form action="{{url('admin/pincode/upload')}}" id="upload-csv-form" method="post">
            @csrf
            <div class="mb-3 row">
                <div class="col-lg-3">
                    <label class="form-label" for="excel_file">Upload Pincode Excel </label>
                    <input class="form-control bg-transparent ps-4 py-3 mb-3" type="file" id="excel_file" name="excel_file">
                    <button type="button" id="upload-csv-btn" class="btn text-white text-uppercase w-100 rounded-5">Submit</button>
                </div>
            </div>
        </form>
        <div class="col-lg-12">
            <div class="table-responsive" id="pincode-table">

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

    <div class="modal fade" id="deletePincodeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletePincodeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePincodeModalLabel">Delete Pincode</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete_pincode_form" method="post" action="{{url('admin/pincode/delete')}}">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">
                        <div>
                            <p>Are you sure ?</p>
                        </div>
                        <button type="button" id="delete_pincode_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var pincodeUrl = `{{url('admin/pincode/list')}}`;
    </script>
    @endsection
    @section('footer')
    @stop