

function checkCategories() {
    var name = $("#addUser").val();
    $.post('../Application/Services/manageCategories.php', {name: name}, function (data) {
        check(data);
    }).fail(function () {
        alert("erro");
    });
}

function check(data) {
    if (data === 'true') {
        $("#addUser").val('');
    } else if (data === 'false') {
        $("#addUser").val('merda');
    }
}

$(document).ready(function () {
    $("#addButton").click(checkCategories);
});


