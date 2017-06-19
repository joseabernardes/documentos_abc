


/*
 * --------------------------------- Event Handlers ---------------------------------
 */

function liveSearchEVH(event) {
    if (getUserDOM().length > 0) {
        searchUserAJAX(getUserDOM());
    } else {
        removeSugestionDOM();
    }
}



$(document).ready(function () {

    $("#addButton").keyup(liveSearchEVH);

});