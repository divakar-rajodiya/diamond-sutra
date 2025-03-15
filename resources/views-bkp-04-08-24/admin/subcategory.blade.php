@extends('layouts.admin')
@section('content')
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">
        <button type="button" class="btn text-white" id="add_subcategory_modal">Add SubCategory</button>
        <div class="col-lg-12">
            <div class="p-4"></div>
            <div class="table-responsive" id="subcategory-table">

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


    <div class="modal fade" id="addSubCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSubCategoryModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addSubCategoryModalLabel">Add SubCategory</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_subcategory_form" method="post" action="{{url('admin/subcategory/add')}}">
                        @csrf
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="name" id="subcategory_name" placeholder="sub category" value="">
                            <label for="subcategory_name">SubCategory Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select bg-transparent" name="category_id" id="category" aria-label="Floating label select example">
                                @foreach($body['category'] as $c)
                                <option value="{{$c['id']}}">{{$c['name']}}</option>
                                @endforeach
                            </select>
                            <label for="category">Category</label>
                        </div>
                        <button type="button" id="add_subcategory_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editSubCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSubCategoryModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editSubCategoryModalLabel">Update SubCategory</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_subcategory_form" method="post" action="{{url('admin/subcategory/update')}}">
                        @csrf
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="name" id="update_subcategory_name" placeholder="sub category" value="">
                            <label for="update_subcategory_name">SubCategory Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select bg-transparent" name="category_id" id="update_category" aria-label="Floating label select example">
                                @foreach($body['category'] as $c)
                                <option value="{{$c['id']}}">{{$c['name']}}</option>
                                @endforeach
                            </select>
                            <label for="category">Category</label>
                        </div>
                        <button type="button" id="update_subcategory_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteSubCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteSubCategoryModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteSubCategoryModalLabel">Delete SubCategory</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete_subcategory_form" method="post" action="{{url('admin/subcategory/delete')}}">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">
                        <div>
                            <p>Are you sure ?</p>
                        </div>
                        <button type="button" id="delete_subcategory_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var subCategoryListUrl = `{{url('admin/subcategory/list')}}`;
        var categoryUrl = `{{url('admin/category/get')}}`;
    </script>
    @endsection
    @section('footer')
    @stop