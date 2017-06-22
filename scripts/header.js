
function open(event) {
    $(event.target).siblings("ul").css("display", "block").css("box-shadow", "0px 8px 8px 0px rgba(0,0,0,0.5)");
    event.preventDefault();
}
;


$(document).ready(function () {

    $(".noclick").parent().focusout(function (event) {
        setTimeout(function () {
            $(event.target).siblings("ul").css("display", "none").css("box-shadow", "none");
        }, 100);
    });

    $(".noclick").click(open);

});
