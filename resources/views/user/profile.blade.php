@extends('layouts.site')
@section('content')

@php
$carousel_image = app('carousel_image');
$userData = $body['user'];
@endphp
<main>
    <div class="page-title mb-3">
        <div class="page-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="profile-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="profile-inner">
                        <form id="profile-update" method="post" onsubmit="return false;" action="{{url('/user/update-profile')}}">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-12">
                                    <div class="profile-avatar">
                                        <div class="form-group text-center">
                                            <label for="avatar">
                                                <input type="file" class="d-none" id="avatar" name="image">
                                                <img id="image_preview" src="{{$userData['profile_image_url']}}" class="img-fluid" alt="">
                                            </label>
                                            <h6>{{$userData['name']}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="hidden" name="id" value="{{$userData['id']}}">
                                        <input type="text" class="form-control bg-transparent" id="name" name="fullname" placeholder="Enter Your Fullname" autocomplete="off" value="{{$userData['name']}}">
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-transparent" id="lName" placeholder="last Name" value="Erica Jordon" autocomplete="off">
                                    <label for="lName">last Name</label>
                                </div>
                            </div> -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-transparent" name="email" id="email" placeholder="Enter Your Email" value="{{$userData['email']}}" readonly>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control bg-transparent" name="{{$userData['number']}}" id="phone" placeholder="Enter Your Phone Number" value="{{$userData['number']}}" readonly>
                                        <label for="phone">Phone</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control bg-transparent" name="password" id="password" placeholder="Enter Your Password" value="">
                                        <label for="password">New Password</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label><b>Note</b>: Password must be minimum 6 and maximum 15 characters long and can use A-Z, a-z, 0-9 and special characters.</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="button" class="btn primary-btn" onclick="saveProfile();">Save Change</button>
                                    <a href="{{asset('user/orders')}}" class="btn primary-btn">View Orders</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop
@section('footer')
<script>
    function saveProfile() {
        console.log('Funciton caled');
        let url = document.getElementById("base_url").value + '/user/update-profile';
        $('#profile-update').ajaxForm(function(res) {
            if (res.flag == 1) {
                console.log('response');
                Toast(res.msg, 3000, res.flag);
                window.location.reload();
            } else {
                Toast(res.msg, 3000, res.flag);
            }
        }).submit();
    }

    function imagePreview(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                // $('#preview').html('<img src="' + event.target.result + '" width="300" height="auto"/>');
                $('#image_preview').attr("src", event.target.result);
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }
    $("#avatar").change(function() {
        imagePreview(this);
    });
</script>
@stop