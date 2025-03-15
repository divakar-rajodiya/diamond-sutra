@extends('layouts.admin')
@section('content')
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">
        <a href="{{ asset('admin/subscribe-export') }}"><button type="button" class="btn text-white" id="">Export Data</button></a>
        <div class="col-lg-12">
            <div class="p-4"></div>
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
    <script>
        var productUrl = `{{url('admin/subscribe-filter')}}`;
    </script>
    @endsection
    @section('footer')
    @stop
