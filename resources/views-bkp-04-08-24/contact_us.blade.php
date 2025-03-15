@extends('layouts.site')
@section('content')

    <main>
        <div class="page-title">
            <div class="container">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
                            <li class="breadcrumb-item"><a href="#">contact us</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="contact-us pt-sm-5 pt-4 pb-3">
            <div class="container">
                <div class="row gy-4 align-items-center justify-content-between">
                    <div class="col-lg-6">
                        <div class="contact-us-left">
                            <h2><span class="sqr"></span> CONTACT US</h2>
                            <p>Thank you for choosing Diamond Sutra for your diamond jewelry needs. We're thrilled to
                                connect with you and assist in making your diamond dreams come true. Whether it's
                                customizing a piece, resolving queries, or sharing our passion for exquisite jewelry, we're
                                here to make your experience exceptional.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-us-right">
                            <ul class="m-0 p-0 list-unstyled">
                                <li>
                                    <p><strong>Address:</strong>3972, Sukhlecho ka chawk, Johri Bazaar, Jaipur 302003</p>
                                </li>
                                <li>
                                    <p><strong>Write to Us: </strong><a
                                            href="mailto:info@diamondsutra.in">info@diamondsutra.in</a></p>
                                </li>
                                <li>
                                    <p><strong>Contact No.:</strong><a href="tel:+91 97999975281"> +91 97999975281</a></p>
                                </li>
                                <li>
                                    <p><strong>Whatsapp: </strong> <a target="_blank"
                                            href="https://api.whatsapp.com/send?phone=919799975281&amp;text=Hi! Need information on the product | https://diamondsutra.in">Click
                                            here to open chat</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="in-touch py-sm-5 py-4">
            <div class="container">
                <div class="row gy-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="in-touch-left text-center text-lg-start">
                            <img src="{{ url('public/assets/img/contact_us.jpg') }}" class="img-fluid w-100"
                                alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="in-touch-right">
                            <h2>WRITE TO US</h2>
                            <form method="post" action="{{ url('contact-us') }}" class="faq-form" id="contact-us-form"
                                onsubmit="return false;">
                                @csrf
                                <div class="form-grop mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="userName" name="name"
                                            placeholder="Name" value="">
                                        <label for="userName">Name</label>
                                    </div>
                                </div>
                                <div class="form-grop mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="email" name="email"
                                            placeholder="Email" value="">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="form-grop mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-transparent" id="msg" name="msg" placeholder="your-message"></textarea>
                                        <label for="msg">Message</label>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-dark w-100 py-3" id="contact-us-btn">SEND <span
                                        id="contact-us-spinner" style="display:none"><i
                                            class="fas fa-spinner fa-spin"></i></span></button>
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
    $(document).on('click', '#contact-us-btn', function() {
        let redirect = $('#redirect').val();
        $('#contact-us-btn').prop('disabled', true);
        $('#contact-us-spinner').show();
        $('#contact-us-form').ajaxForm(function(res) {
            $('#contact-us-spinner').hide();
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $('#contact-us-form ')[0].reset();
            }
            $('#contact-us-btn').prop('disabled', false);
        }).submit();
    })
</script>
@stop
