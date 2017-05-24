

function open() {
    $(".drop > ul").css("display", "block").css("box-shadow", "0px 8px 8px 0px rgba(0,0,0,0.5)");
}

$(document).ready(function () {

    $(".noclick").parent().focusout(function (event) {
        $(event.target).siblings("ul").css("display", "none").css("box-shadow", "none");



    });

    $(".noclick").click(function (event) {
        $(event.target).siblings("ul").css("display", "block").css("box-shadow", "0px 8px 8px 0px rgba(0,0,0,0.5)");
        event.preventDefault();
//        open();
    });
});
