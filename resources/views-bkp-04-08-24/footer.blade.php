<footer>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row justify-content-between align-items-center gy-3">
          <div class="col-md-8 col-lg-6">
            <div class="d-flex flex-wrap gap-3 align-items-center">
              <h5 class="m-0 fw-bold text-uppercase">Our Newsletter</h5>
              <form class="d-flex align-items-center gap-2 border p-2 fs-12" method="post" action="{{ url('subscribe-us') }}" id="subscribe-us-form"  onsubmit="return false;">
                    @csrf
                    <input type="email" class="form-control bg-transparent border-0 shadow-none" id="floatingInputGrid" name="email" placeholder="name@example.com" value="" required style="">
                    <button type="button" class="btn bg-black rounded-0 text-white fs-12 p-3 shadow" id="subscribe-us-btn"><i class="fa-solid fa-arrow-right"></i> <span
                        id="subscribe-us-spinner" style="display:none"><i
                            class="fas fa-spinner fa-spin"></i></span></button>
              </form>
            </div>
          </div>
          <div class="col-md-4 col-lg-6">
            <div class="fs-4 gap-4 d-flex align-items-center justify-content-md-end">
              <a target="_blank" href="https://www.instagram.com/diamondsutra_jewellery" class="text-black"><i class="fa-brands fa-instagram"></i></a>
              <a target="_blank" href="https://www.facebook.com/profile.php?id=61555042030921&mibextid=eQY6cl&rdid=ZgbmBzY3CnDjQ9Jm" class="text-black"><i class="fa-brands fa-facebook-f"></i></a>
              <a target="_blank" href="https://api.whatsapp.com/send?phone=919799975281&amp;text=Hi! Need information on the product | https://diamondsutra.in" class="text-black"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main-footer py-5">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="footer-box">
              <h6>Quick Links</h6>
              <ul class="footer-link-ul">
                <li><a href="{{url('about')}}">Who we are?</a></li>
                <li><a href="mailto:">Careers</a></li>
                <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                <li><a href="{{url('faqs')}}">FAQ</a></li>

              </ul>
              <div class="fs-14">
                <a class="fw-bold mb-2 d-inline-block position-relative ps-4" href="tel:+919799975281"><i class="fa-sharp fa-solid fa-phone position-absolute start-0 top-0 bottom-0 m-auto d-flex align-items-center"></i> +91 9799975281</a>
                <div class="mb-2 position-relative ps-4"><i class="fa-sharp fa-solid fa-clock position-absolute start-0 top-0 bottom-0 m-auto d-flex align-items-center"></i> (9AM - 9PM, 7 days a week)</div>
                <div class="position-relative ps-4"><i class="fa-sharp fa-solid fa-location-dot position-absolute start-0 top-0 bottom-0 m-auto d-flex align-items-center"></i><b>Registered Address:</b> C-69, SHIKSHA VIHAR, SKIT ROAD,JAGATPURA, Jaipur 302017</div>
                <div class="position-relative ps-4"><i class="fa-sharp fa-solid fa-location-dot position-absolute start-0 top-0 bottom-0 m-auto d-flex align-items-center"></i><b>Office Address:</b> 3972, Sukhlecho ka chowk, Johri Bazaar, Jaipur 302003</div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="footer-box">
              <h6>POLICIES</h6>
              <ul class="footer-link-ul">
                <li><a href="{{url('returns-policy')}}">15-Day Returns</a></li>
                <li><a href="{{url('lifetime-exchange-buy-back-policy')}}">Lifetime Exchange & Buy back</a></li>
                <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                <li><a href="{{url('terms-conditions')}}">Terms & Conditions</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="footer-box">
              <h6>SHOP WITH CONFIDENCE</h6>
              <ul class="footer-link-ul">
                <li><a href="{{url('why-buy-from-us')}}">Why Buy From Us?</a></li>
                <li><a href="{{url('our-certifications')}}">Our Certifications</a></li>
                <li><a href="{{url('/#home-testimonial')}}">Testimonials</a></li>
                <li><a href="{{url('contact-us')}}">Corporate Gifting</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="footer-box">
              <h6>JEWELLERY GUIDE</h6>
              <ul class="footer-link-ul">
                <li><a href="{{url('certification-guide')}}">Diamond Jewelry Care Guide</a></li>
                <li><a href="{{url('ring-size-guide')}}">Ring Size Guide</a></li>
                <li><a href="{{url('solitaire-buying-guide')}}">Solitaire Buying Guide</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="fs-12 text-uppercase fw-light py-4 text-center text-white bg-black">
      ©
      <script>
        document.write(new Date().getFullYear());
      </script>
      Diamond Sutra. All Rights Reserved.
    </div>
    <a href="javascript:" id="return-to-top"><i class="fa-solid fa-angles-up"></i></a>
  </footer>
  <!-- <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/custom.js"></script> -->
  <script src="{{url('public/assets/js/site/site.min.js')}}"></script>
  <?php
  if (isset($footer['js'])) {
    for ($i = 0; $i < count($footer['js']); $i++) {
      if (strpos($footer['js'][$i], "https://") !== FALSE || strpos($footer['js'][$i], "http://") !== FALSE)
        echo '<script type="text/javascript" src="' . $footer['js'][$i] . '"></script>';
      else
        echo '<script type="text/javascript" src="' . \URL::to('/public/assets/js/' . $footer['js'][$i]) . '"></script>';
    }
  }
  ?>
  @yield('footer')

  <script>
    $(".home-carousel").owlCarousel({
      loop: true,
      margin: 0,
      nav: false,
      items: 1,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      dots: true,
    });

    $(".engagement-carousel").owlCarousel({
      loop: true,
      margin: 2,
      center: true,
      autoplay: true,
      autoplayTimeout: 3000,
      autoplayHoverPause: true,
      nav: true,
      dots: false,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 3,
        },
        1000: {
          items: 5,
        },
      },
    });
    $(".testimonial-carousel").owlCarousel({
      loop: true,
      margin: 10,
      center: true,
      autoplay: true,
      autoplayTimeout: 3000,
      autoplayHoverPause: true,
      nav: true,
      dots: false,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 2,
        },
        1000: {
          items: 3,
        },
      },
    });

    $(".instagram-carousel").owlCarousel({
      loop: true,
      margin: 2,
      center: true,
      autoplay: false,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      nav: false,
      dots: false,
      responsive: {
        0: {
          items: 2,
        },
        600: {
          items: 3,
        },
        1000: {
          items: 5,
        },
      },
    });

    $(document).on('click', '#search-btn', function() {
      search();
    });

    $(document).on("keypress", "#search-text", function(event) {
      if (event.charCode == 13) {
        search();
      }
    });

    function search(){
      var base_url = $('#base_url').val();
      var search = $('#search-text').val();
      if (search != '' || search != ' ') {
        window.location.href = base_url + '/products?search=' + search;
      }
    }
    $(document).on('click', '#subscribe-us-btn', function() {
        let redirect = $('#redirect').val();
        $('#subscribe-us-btn').prop('disabled', true);
        $('#subscribe-us-spinner').show();
        $('#subscribe-us-form').ajaxForm(function(res) {
            $('#subscribe-us-spinner').hide();
            Toast(res.msg, 3000, res.flag);
            if (res.flag == 1) {
                $('#subscribe-us-form ')[0].reset();
            }
            $('#subscribe-us-btn').prop('disabled', false);
        }).submit();
    });


    // ===== Scroll to Top ==== 
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });

  </script>
  </body>


  </html>
