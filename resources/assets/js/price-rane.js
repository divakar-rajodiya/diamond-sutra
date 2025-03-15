$(document).ready(function () {
    console.log($("#slider-range"));
    $("#price-range-submit").hide();

    $("#min_price,#max_price").on("change", function () {
        $("#price-range-submit").show();
        var min_price_range = parseInt($("#min_price").val());
        var max_price_range = parseInt($("#max_price").val());
        if (min_price_range > max_price_range) {
            $("#max_price").val(min_price_range);
        }
        $("#slider-range").slider({
            values: [min_price_range, max_price_range],
        });
    });
    $("#min_price,#max_price").on("paste keyup", function () {
        $("#price-range-submit").show();
        var min_price_range = parseInt($("#min_price").val());
        var max_price_range = parseInt($("#max_price").val());
        if (min_price_range == max_price_range) {
            max_price_range = min_price_range + 100;
            $("#min_price").val(min_price_range);
            $("#max_price").val(max_price_range);
        }
        $("#slider-range").slider({
            values: [min_price_range, max_price_range],
        });
    });

    //-----JS for Price Range slider-----

    $(function () {
        $("#slider-range").slider({
            range: true,
            min: 130,
            max: 500,
            values: [130, 250],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            },
        });
        $("#amount").val(
            "$" +
                $("#slider-range").slider("values", 0) +
                " - $" +
                $("#slider-range").slider("values", 1)
        );
    });
});
