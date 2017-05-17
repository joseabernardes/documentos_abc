
function change() {
    if ( $("main#view-doc div#content").css("display") === "none") {
        $("main#view-doc div#content").css("display", "block");
         $("main#view-doc div#details > span:last-child").text("-");
    } else {
        $("main#view-doc div#content").css("display", "none");
         $("main#view-doc div#details > span:last-child").text("+");
    }


}


$(document).ready(function () {
    $("main#view-doc div#details > span:last-child").click(change);
});

