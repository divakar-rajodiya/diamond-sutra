

<footer class="p-4 mt-auto border-top border-secondary position-sticky bottom-0 text-center bg-light">
                <div class="container-fluid">
                    <h6 class="text-dark m-0">©{{date('Y')}} {{config('constant.PLATFORM_NAME')}}. All Rights Reserved.</h6>
                </div>
            </footer>
        </div>
    </div>

</body>
<script src="{{url('public/assets/js/admin/admin_common.min.js')}}"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    var endpoint = window.location.pathname;
if(endpoint.includes('admin/order')){

    $('#from_date').datepicker({    
       format: 'yyyy-mm-dd',
       endDate: "today"
    }); 
    
    $('#from_date').on('changeDate', function(selected){
        var fromDate = new Date(selected.date.valueOf());
        $('#to_date').datepicker('setStartDate', fromDate);
    });
    
    $('#to_date').datepicker({    
       format: 'yyyy-mm-dd',
       startDate: $('#from_date').val(),
       endDate: "today"
    }); 
<<<<<<< HEAD
}
=======



    $('.num-counter').each(function () {
    var countText = $(this).text().replace(/\D/g, ''); // Remove non-numeric characters
    $(this).prop('Counter',0).animate({
        Counter: countText
    }, {
        duration: 2500,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now).toLocaleString()); // Convert to locale string format
        }
    });
});

>>>>>>> 3808804 (code merge)

</script>