@extends('layouts.admin')
@section('content')
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">
        <button type="button" class="btn text-white" id="add_review_modal" data-bs-toggle="modal" data-bs-target="#AddReviewModal">Add New Review</button>
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
    <div class="modal fade" tabindex="-1" id="AddReviewModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="addreview" action="{{ url('/admin/add-product-review') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-md-6">
                            <label for="product_sku" class="form-label">Product</label>
                            <select class="form-select bg-transparent" name="product_sku" id="product_sku" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                                @foreach($body['product'] as $p)
                                <option value="{{$p['product_sku']}}">{{$p['product_sku'] .' ('. $p['default_color'].')'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" class="form-control bg-transparent" name="username" id="username" placeholder="Enter Designation" readonly value="Diamondsutra">
                        </div>
                        <div class="col-md-6">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" class="form-control bg-transparent" name="rating" id="rating" placeholder="Enter Rating">
                        </div>
                        <div class="col-md-6">
                            <label for="review" class="form-label">Review</label>
                            <input type="text" class="form-control bg-transparent" name="title" id="title" placeholder="Enter Rreview">
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control bg-transparent" name="description" id="description" placeholder="Enter Description"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Review Image 1</label>
                            <input type="file" class="form-control bg-transparent" name="image1" onchange="imagesPreview(event);">
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Review Image 2</label>
                            <input type="file" class="form-control bg-transparent" name="image2" onchange="imagesPreview(event);">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn text-white" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn text-white" onclick="addreview()">Add Review
                                <span id="spinner" style="display:none"><i class="fas fa-spinner fa-spin"></i></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="edit_review">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="updatereview" action="{{ url('/admin/update-product-review') }}" method="post">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-md-6">
                            <label for="product_sku" class="form-label">Product</label>
                            <input type="text" class="form-control bg-transparent" name="product_sku" id="product_sku" placeholder="Enter Product">
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" class="form-control bg-transparent" name="username" id="username" placeholder="Enter Designation">
                        </div>
                        <div class="col-md-4">
                            <label for="order_id" class="form-label">Order Id</label>
                            <input type="text" class="form-control bg-transparent" name="order_id" id="order_id" placeholder="Enter Order Id">
                        </div>
                        <div class="col-md-4">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="text" class="form-control bg-transparent" name="rating" id="rating" placeholder="Enter Rating">
                        </div>
                        <div class="col-md-4">
                            <label for="review" class="form-label">Review</label>
                            <input type="text" class="form-control bg-transparent" name="review" id="review" placeholder="Enter review">
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control bg-transparent" name="description" id="description" placeholder="Enter Client Feedback"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Review Image 1</label>
                            <input type="file" class="form-control bg-transparent" name="image1" onchange="imagesPreview(event);">
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Review Image 2</label>
                            <input type="file" class="form-control bg-transparent" name="image2" onchange="imagesPreview(event);">
                        </div>
                        <div class="col-md-6" id="gallery_div">
                            <div class="gallery">
                                <img src='' id="images" height="100" width="100">
                                <img src='' id="images1" height="100" width="100">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn text-white" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn text-white" onclick="updatereview()">Update <span id="spinner" style="display:none"><i class="fas fa-spinner fa-spin"></i></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="view_review_model">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="" action="javascript:void(0)" method="post">
                        <div class="col-md-6">
                            <label for="product_sku" class="form-label">Product</label>
                            <input type="text" class="form-control bg-transparent" name="product_sku" id="view_product_sku" placeholder="Enter Product" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" class="form-control bg-transparent" name="username" id="view_username" placeholder="Enter Designation" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="order_id" class="form-label">Order Id</label>
                            <input type="text" class="form-control bg-transparent" name="order_id" id="view_order_id" placeholder="Enter Order Id" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="text" class="form-control bg-transparent" name="rating" id="view_rating" placeholder="Enter Rating" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="review" class="form-label">Review</label>
                            <input type="text" class="form-control bg-transparent" name="review" id="view_review" placeholder="Enter review" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control bg-transparent" name="description" id="view_description" placeholder="Enter Client Feedback" disabled></textarea>
                        </div>
                        <div class="col-md-6" id="gallery_div">
                            <div class="gallery">
                                <img src='' id="view_images" height="100" width="100">
                                <img src='' id="view_images1" height="100" width="100">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn text-white" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteReviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteReviewModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteReviewModalLabel">Delete Product Review</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="review_form" method="post" action="{{ url('admin/delete-product-review') }}">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">
                        <div>
                            <p>Are you sure ?</p>
                        </div>
                        <button type="button" id="review_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var productUrl = `{{ url('admin/filter-product-review') }}`;
    </script>
    @endsection
    @section('footer')

    <script>
        function Editdata(img1, img2, product_sku, username, order_id, rating, review, description) {

            $('#id').val(id);
            $("#images").attr("src", img1);
            $("#images1").attr("src", img2);
            $("#product_sku").val(product_sku);
            $("#username").val(username);
            $("#order_id").val(order_id);
            $("#rating").val(rating);
            $("#review").val(review);
            $("#description").val(description);
            $('#edit_review').modal('show');
        }

        function ViewReview(img1, img2, product_sku, username, order_id, rating, review, description) {

            $('#id').val(id);
            $("#view_images").attr("src", img1);
            $("#view_images1").attr("src", img2);
            $("#view_product_sku").val(product_sku);
            $("#view_username").val(username);
            $("#view_order_id").val(order_id);
            $("#view_rating").val(rating);
            $("#view_review").val(review);
            $("#view_description").val(description);
            $('#view_review_model').modal('show');
        }

        function addreview() {
            $("#spinner").show();
            $("#btn").attr('disabled', true);
            $('#addreview').ajaxForm(function(res) {
                Toast(res.msg, 3000, res.flag);
                if (res.flag == 1) {
                    document.getElementById('addreview').reset();
                    $('.btn-close').trigger('click');
                    filterData(productUrl, 'user-table');
                }
                $("#spinner").hide();
                $("#btn").attr('disabled', false);
            }).submit();
        }

        function updatereview() {
            $("#spinner").show();
            $("#btn").attr('disabled', true);
            $('#updatereview').ajaxForm(function(res) {
                Toast(res.msg, 3000, res.flag);
                if (res.flag == 1) {
                    document.getElementById('updatereview').reset();
                    $('#gallery').attr('src', '');
                    $('.btn-close').trigger('click');
                    $('.btn-close').trigger('click');
                    filterData(productUrl, 'user-table');
                }
                $("#spinner").hide();
                $("#btn").attr('disabled', false);
            }).submit();
        }

        function imagesPreview(event) {
            // placeToInsertImagePreview.html("");
            $("#gallery_div").show();
            var output = document.getElementById('gallery');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        }

        function Delete(id) {
            $("#delete_id").val(id);
            $("#deleteReviewModal").modal("show");
        }

        $(document).on("click", "#review_btn", function() {
            $("#review_btn").prop("disabled", true);
            $("#review_form")
                .ajaxForm(function(res) {
                    Toast(res.msg, 3000, res.flag);
                    if (res.flag == 1) {
                        $("#review_form")[0].reset();
                        $("#deleteReviewModal").modal("hide");
                        filterData(productUrl, "user-table");
                    }
                    $("#review_btn").prop("disabled", false);
                })
                .submit();
        });
    </script>
    @stop