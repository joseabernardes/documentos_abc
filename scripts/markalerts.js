/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function markAlerts(event) {
    var id = $(event.target).attr("id");
    console.log(id);
    $.post('../Application/Services/markAlerts.php', {id: id}, function (data) {
        check(data,id);
    }).fail(function () {
        alert("erro");
    });
}

function check(data, id) {
    if (data === 'true') {
        $("#" + id).parent().remove();
    }
}

$(document).ready(function () {
    $(".markAlert").click(markAlerts);
});
