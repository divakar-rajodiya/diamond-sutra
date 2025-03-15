@extends('layouts.admin')
@section('content')
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">
        <div class="col-lg-12">
            <div class="p-4"></div>
            <div class="table-responsive" id="solitaire-price-table">

            </div>
            <!-- <nav aria-label="...">
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
            </nav> -->
            <div class="p-4"></div>
        </div>
    </div>
    
    <div class="modal fade" id="editSolitairePriceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSolitairePriceModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editSolitairePriceModalLabel">Update Solitaire Price</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_solitaire_price_form" method="post" action="{{url('admin/solitaire-price/update')}}"> 
                        @csrf
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="price" id="update_solitaire_price" placeholder="solitaire price" value="">
                            <label for="update_solitaire_price">Solitaire Price</label>
                        </div>
                        <button type="button" id="update_solitaire_price_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var solitaireListUrl = `{{url('admin/solitaire-price/list')}}`;
    </script>
    @endsection
    @section('footer')
    @stop