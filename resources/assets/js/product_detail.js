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
$(document).ready(function () {
    // You can try out different effects here
    $(".xzoom, .xzoom-gallery").xzoom({
        zoomWidth: 600,
        zoomHeight: 600,
        title: true,
        tint: "#333",
        lensShape: 'box',
        scroll: false,
        Xoffset: 15
    });

    //Integration with hammer.js
    var isTouchSupported = "ontouchstart" in window;

    if (isTouchSupported) {
        //If touch device
        $(".xzoom").each(function () {
            var xzoom = $(this).data("xzoom");
            xzoom.eventunbind();
        });

        $(".xzoom").each(function () {
            var xzoom = $(this).data("xzoom");
            $(this)
                .hammer()
                .on("tap", function (event) {
                    event.pageX = event.gesture.center.pageX;
                    event.pageY = event.gesture.center.pageY;
                    var s = 1,
                        ls;

                    xzoom.eventmove = function (element) {
                        element.hammer().on("drag", function (event) {
                            event.pageX = event.gesture.center.pageX;
                            event.pageY = event.gesture.center.pageY;
                            xzoom.movezoom(event);
                            event.gesture.preventDefault();
                        });
                    };

                    xzoom.eventleave = function (element) {
                        element.hammer().on("tap", function (event) {
                            xzoom.closezoom();
                        });
                    };
                    xzoom.openzoom(event);
                });
        });

    } else {

        //Integration with magnific popup plugin
        $("#xzoom-magnific").bind("click", function (event) {
            var xzoom = $(this).data("xzoom");
            xzoom.closezoom();
            var gallery = xzoom.gallery().cgallery;
            var i,
                images = new Array();
            for (i in gallery) {
                images[i] = {
                    src: gallery[i]
                };
            }
            $.magnificPopup.open({
                items: images,
                type: "image",
                gallery: {
                    enabled: true
                }
            });
            event.preventDefault();
        });
    }

});
// $(".slider-thumb").slick({
//     slidesToShow: 4,
//     slidesToScroll: 4,
//     asNavFor: ".slider-content",
//     arrows: false,
//     dots: false,
//     centerMode: false,
//     focusOnSelect: true,
//     responsive: [
//         {
//             breakpoint: 575,
//             settings: {
//                 slidesToShow: 3,
//                 slidesToScroll: 3,
//             },
//         },
//     ],
// });

function formatNumberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
