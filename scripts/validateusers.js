/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validateUsers(event) {
    event.preventDefault();
    var id = $(event.target).attr("for");
    console.log($('#12').prop("checked"));
//    console.log(id);
    $.post('../Application/Services/validateUsers.php', {id: id, type: $('#' + id).prop("checked")}, function (data) {
        check(data, id);
    }).fail(function () {
        alert("erro");
    });
}

function check(data, id) {
    if (data === 'true') {
        $("[for=" + id + "]").css('background-color', 'rgb(12,14,22)');
        $("#" + id).prop('checked', true);

    } else if (data === 'false') {
        $("[for=" + id + "]").css('background-color', 'rgb(84,144,242)');
        $("#" + id).prop('checked', false);

    }
}


$(document).ready(function () {
    $(".valid").click(validateUsers);
});