@extends('layouts.admin')
@section('content')
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">
        <a href="{{ asset('admin/contact-export') }}"><button type="button" class="btn text-white" id="">Export Data</button></a>
        <div class="col-lg-12">
            <div class="p-2"></div>
            <div class="table-responsive" id="user-table">

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
    <div class="modal fade" id="deleteContactusUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteContactusUserModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteContactusUserModalLabel">Delete Contact Us</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete_contactus_form" method="post" action="{{url('admin/contactus/delete')}}">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">
                        <div>
                            <p>Are you sure ?</p>
                        </div>
                        <button type="button" id="delete_contactus_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var contactUsUrl = `{{url('admin/contactus-filter')}}`;
    </script>
    @endsection
    @section('footer')
    @stop
