
/*
 * -------------------------------------- AJAX --------------------------------------
 */
function deleteAlertsAJAXproce(data, id) {
    try {
        var json = JSON.parse(data);
    } catch (err) {
        window.console.log(err);
        json = false;
    }
    if (json === true) {
        deleteAlertDOM(id);
    }
}


function deleteAlertsAJAX(event) {
    var id = getIDDOM(event);
    $.post('../Application/Services/markAlerts.php', {id: id}, function (data) {
        deleteAlertsAJAXproce(data, id);
    }).fail(function () {
        alert("erro");
    });
}


/*
 * --------------------------------- DOM ACCESS/CREATE ---------------------------------
 */

function getIDDOM(event) {
    return $(event.target).attr("id");
}

function deleteAlertDOM(id) {
    $("#" + id).parent().remove();

}


/*
 * --------------------------------- Event Handlers ---------------------------------
 */

$(document).ready(function () {
    $(".markAlert").click(deleteAlertsAJAX);
});


