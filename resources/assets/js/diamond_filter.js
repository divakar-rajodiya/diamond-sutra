// $(".slider-content").slick({
//     slidesToShow: 1,
//     slidesToScroll: 1,
//     arrows: false,
//     fade: false,
//     speed: 1000,
//     asNavFor: ".slider-thumb",
// });
$('.slider-thumb').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    infinite: false,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    arrows: true,
    responsive: [{
        breakpoint: 375,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
        },
    },
    {
        breakpoint: 575,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
        },
    },
    ],
});


// var advanceFilter = document.getElementsByClassName('.advance-btn')
$(".advance-btn").click(function () {
    $(".advance-btn .fa-solid").toggleClass("fa-circle-plus");
    $(".advance-filter-list-in").toggleClass("show");
});
