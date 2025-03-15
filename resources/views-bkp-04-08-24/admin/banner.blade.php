@extends('layouts.admin')
@section('content')
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">
        <button type="button" class="btn text-white" id="add_banner_modal">Add New Banner</button>
        <div class="col-lg-12">
            <div class="p-4"></div>
            <div class="table-responsive" id="banner-table">

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


    <div class="modal fade" id="addBannerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addBannerModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addBannerModalLabel">Add New Banner</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_banner_form" method="post" action="{{url('admin/banner/add')}}" enctype="multipart/form-data"> 
                        @csrf
                        <div class="mb-3">
                            <label for="banner_image" class="form-label">Banner Image</label>
                            <input class="form-control bg-transparent ps-4 py-3" type="file" name="banner_image" id="banner_image" accept="image/*">
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="link" id="banner_link" placeholder="Link" value="">
                            <label for="banner_link">Link</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="sort_order" id="sort_order" placeholder="Order" value="">
                            <label for="sort_order">Sort Order</label>
                        </div>
                        <button type="button" id="add_banner_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="editBannerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBannerModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editBannerModalLabel">Update Banner</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_banner_form" method="post" action="{{url('admin/banner/update')}}" enctype="multipart/form-data"> 
                        @csrf
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="mb-3">
                            <label for="banner_image" class="form-label">Banner Image</label>
                            <input class="form-control bg-transparent ps-4 py-3" type="file" name="banner_image" id="update_banner_image">
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="link" id="update_banner_link" placeholder="category" value="">
                            <label for="update_banner_link">Link</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="sort_order" id="update_sort_order" placeholder="Order" value="">
                            <label for="update_sort_order">Sort Order</label>
                        </div>
                        <button type="button" id="update_banner_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="deleteBannerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteBannerModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteBannerModalLabel">Delete Banner</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete_banner_form" method="post" action="{{url('admin/banner/delete')}}"> 
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">
                        <div>
                            <p>Are you sure ?</p>
                        </div>
                        <button type="button" id="delete_banner_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var bannerListUrl = `{{url('admin/banner/list')}}`;
    </script>
    @endsection
    @section('footer')
    @stop