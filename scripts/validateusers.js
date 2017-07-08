

/*
 * -------------------------------------- AJAX --------------------------------------
 */

function validateUsersAJAXproce(data, id) {
    if (data === 'true') {
        $("[for=" + id + "]").css('background-color', 'lightgray').text("Invalidar");
        $("#" + id).prop('checked', true);

    } else if (data === 'false') {
        $("[for=" + id + "]").css('background-color', 'rgb(84,144,242)').text("Validar");
        $("#" + id).prop('checked', false);

    }
}

function validateUsersAJAX(event) {
    event.preventDefault();
    var id = $(event.target).attr("for");
    $.post('../Application/Services/validateUsers.php', {id: id, type: $('#' + id).prop("checked")}, function (data) {
        validateUsersAJAXproce(data, id);
    }).fail(function () {
        alert("erro");
    });
}


/*
 * --------------------------------- Event Handlers ---------------------------------
 */

$(document).ready(function () {
    $(".valid").click(validateUsersAJAX);
});