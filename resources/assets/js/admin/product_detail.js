var slim;
var slim2;

var data = subcategoryData.split(",");
var data2 = relatedData.split(",");
$(document).ready(function () {
    slim = new SlimSelect({
        select: "#multiple",
        settings: {
            hideSelected: true,
            closeOnSelect: false,
        },
    });
    slim.set(data);

    slim2 = new SlimSelect({
        select: "#multiple_related",
        settings: {
            hideSelected: true,
            closeOnSelect: false,
        },
    });
    slim2.set(data2);

});

$(document).on("change", "#categorySelect", function () {
    let val = $(this).val();
    console.log(val);
    postAjax(getSubCategory, { id: val }, function (res) {
        console.log(res);
        let tempArr = [];
        res.data.forEach((ele) => {
            tempArr.push({ value: ele.id, text: ele.name });
        });
        console.log(tempArr);
        slim.setData(tempArr);
        slim.set(data);
    });
});
