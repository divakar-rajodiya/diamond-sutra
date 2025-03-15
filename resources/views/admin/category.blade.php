@extends('layouts.admin')
@section('content')
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">
        <button type="button" class="btn text-white" id="add_category_modal">Add Category</button>
        <div class="col-lg-12">
            <div class="p-4"></div>
            <div class="table-responsive" id="category-table">

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


    <div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCategoryModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCategoryModalLabel">Add Category</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_category_form" method="post" action="{{url('admin/category/add')}}"> 
                        @csrf
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="name" id="category_name" placeholder="category" value="">
                            <label for="category_name">Category Name</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <label class="form-check-label" for="category_status">Status</label>
                            <input class="form-check-input" type="checkbox" name="status" role="switch" id="category_status" checked="">
                        </div>
                        <button type="button" id="add_category_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="editCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCategoryModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editCategoryModalLabel">Update Category</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_category_form" method="post" action="{{url('admin/category/update')}}"> 
                        @csrf
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="name" id="update_category_name" placeholder="category" value="">
                            <label for="update_category_name">Category Name</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <label class="form-check-label" for="update_category_status">Status</label>
                            <input class="form-check-input" type="checkbox" name="status" role="switch" id="update_category_status" checked="">
                        </div>
                        <button type="button" id="update_category_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="deleteCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteCategoryModalLabel">Delete Category</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete_category_form" method="post" action="{{url('admin/category/delete')}}"> 
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">
                        <div>
                            <p>Are you sure ?</p>
                        </div>
                        <button type="button" id="delete_category_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var categoryListUrl = `{{url('admin/category/list')}}`;
    </script>
    @endsection
    @section('footer')
    @stop