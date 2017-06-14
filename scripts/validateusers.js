/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validateUsers(event) {
    event.preventDefault();
    var id = $(event.target).attr("id");
    $.post('../Application/Services/validateUsers.php', {id: id}, function (data) {
        check(data, id);
    }).fail(function () {
        alert("erro");
    });
}

function check(data, id) {
    if (data === 'true') {
        $("#" + id).prop('checked', true);
    } else if (data === 'false') {
        $("#" + id).prop('checked', false);
    }
}


$(document).ready(function () {
    $(".check").change(validateUsers);
});