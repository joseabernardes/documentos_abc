
function change(event) {
    
    if ( $(event.target).parent().siblings(".content").css("display") === "none") {
       $(event.target).parent().siblings(".content").css("display", "block");
        $(event.target).text("-");
    } else {
       $(event.target).parent().siblings(".content").css("display", "none");
        $(event.target).text("+");
    }


}


$(document).ready(function () {
    $("main#view-doc div.expand > span:last-child").click(change);
});

