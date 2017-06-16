

/*
 * -------------------------------------- AJAX --------------------------------------
 */


function addCommentAJAX() {
    
    
    
}


/*
 * --------------------------------- DOM ACCESS/CREATE ---------------------------------
 */




/*
 * --------------------------------- Event Handlers ---------------------------------
 */

function addCommentEVH() {
    addUserAJAX(getUserDOM());

}


$(document).ready(function () {
    $("#send").click(addCommentEVH);
});



