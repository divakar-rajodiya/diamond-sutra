@extends('layouts.admin')
@section('content')
    <div class="layout-sidenav-content">

        <div class="p-4 p-md-5">
            <button type="button" class="btn text-white" id="add_category_modal" data-bs-toggle="modal"
                data-bs-target="#AddTestimonial">Add New Testimonial</button>
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
        <div class="modal fade" tabindex="-1" id="AddTestimonial">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Testimonial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="addtestimonial" action="{{ url('/admin/add-testimonial') }}"
                            method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-5">
                                <label for="client_name" class="form-label">Client Name</label>
                                <input type="text" class="form-control bg-transparent" name="client_name"
                                    placeholder="Enter Client Name">
                            </div>
                            <div class="col-md-4">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control bg-transparent" name="designation"
                                    placeholder="Enter Designation">
                            </div>
                            <div class="col-md-3">
                                <label for="rating" class="form-label">Rating</label>
                                <input type="text" class="form-control bg-transparent" name="rating"
                                    placeholder="Enter Rating">
                            </div>
                            <div class="col-md-12">
                                <label for="msg" class="form-label">Message</label>
                                <textarea class="form-control bg-transparent" name="msg" placeholder="Enter Client Feedback"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="testimonial_image" class="form-label">Testimonial Image</label>
                                <input type="file" class="form-control bg-transparent" name="testimonial_image"
                                    onchange="imagesPreview(event);">
                            </div>
                            <div class="col-md-6" id="gallery_div">
                                <div class="gallery">
                                    <img id="gallery" height="100" width="100" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn text-white" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn text-white" onclick="addTestimonial()">Add Testimonial
                                    <span id="spinner" style="display:none"><i
                                            class="fas fa-spinner fa-spin"></i></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="Testimonial">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Testimonial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="updatetestimonial" action="{{ url('/admin/update-testimonial') }}"
                            method="post">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-5">
                                <label for="client_name" class="form-label">Client Name</label>
                                <input type="text" class="form-control bg-transparent" name="client_name"
                                    id="client_name" placeholder="Enter Client Name">
                            </div>
                            <div class="col-md-4">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control bg-transparent" name="designation"
                                    id="designation" placeholder="Enter Designation">
                            </div>
                            <div class="col-md-3">
                                <label for="rating" class="form-label">Rating</label>
                                <input type="text" class="form-control bg-transparent" name="rating" id="rating"
                                    placeholder="Enter Rating">
                            </div>
                            <div class="col-md-12">
                                <label for="msg" class="form-label">Message</label>
                                <textarea class="form-control bg-transparent" name="msg" id="msg" placeholder="Enter Client Feedback"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">Testimonial Image</label>
                                <input type="file" class="form-control bg-transparent" name="testimonial_image"
                                    onchange="imagesPreview(event);">
                            </div>
                            <div class="col-md-6" id="gallery_div">
                                <div class="gallery">
                                    <img src='' id="images" height="100" width="100">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn text-white" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn text-white" onclick="updateTestimonial()">Update <span
                                        id="spinner" style="display:none"><i
                                            class="fas fa-spinner fa-spin"></i></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="deleteTestimonialModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="deleteTestimonialModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-light text-dark">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteTestimonialModalLabel">Delete Testimonial</h1>
                        <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="testimonial_form" method="post" action="{{ url('admin/delete-testimonial') }}">
                            @csrf
                            <input type="hidden" name="delete_id" id="delete_id">
                            <div>
                                <p>Are you sure ?</p>
                            </div>
                            <button type="button" id="testimonial_btn"
                                class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var productUrl = `{{ url('admin/filter-testimonial') }}`;
        </script>
    @endsection
    @section('footer')
        <script>
            function Editdata(id, img, client_name, designation, rating, msg) {

                $('#id').val(id);
                $("#images").attr("src", img);
                $("#client_name").val(client_name);
                $("#designation").val(designation);
                $("#rating").val(rating);
                $("#msg").val(msg);
                $('#Testimonial').modal('show');
            }

            function addTestimonial() {
                $("#spinner").show();
                $("#btn").attr('disabled', true);
                $('#addtestimonial').ajaxForm(function(res) {
                    Toast(res.msg, 3000, res.flag);
                    if (res.flag == 1) {
                        document.getElementById('addtestimonial').reset();
                        $('.btn-close').trigger('click');
                        filterData(productUrl, 'user-table');
                    }
                    $("#spinner").hide();
                    $("#btn").attr('disabled', false);
                }).submit();
            }

            function updateTestimonial() {
                $("#spinner").show();
                $("#btn").attr('disabled', true);
                $('#updatetestimonial').ajaxForm(function(res) {
                    Toast(res.msg, 3000, res.flag);
                    if (res.flag == 1) {
                        document.getElementById('updatetestimonial').reset();
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
                $("#deleteTestimonialModal").modal("show");
            }

            $(document).on("click", "#testimonial_btn", function() {
                $("#testimonial_btn").prop("disabled", true);
                $("#testimonial_form")
                    .ajaxForm(function(res) {
                        Toast(res.msg, 3000, res.flag);
                        if (res.flag == 1) {
                            $("#testimonial_form")[0].reset();
                            $("#deleteTestimonialModal").modal("hide");
                            filterData(productUrl, "coupon-table");
                        }
                        $("#testimonial_btn").prop("disabled", false);
                    })
                    .submit();
            });
        </script>
    @stop
