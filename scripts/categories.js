

function addCategories() {
    var name = $("#addUser").val();
    $.post('../Application/Services/manageCategories.php', {name: name, type: 'add'}, function (data) {
        checkadd(data, name);
    }).fail(function () {
        alert("erro");
    });
}

function checkadd(data, name) {
    if (data === 'false') {
        $("#addUser").val($("#addUser").val());
    } else {
        $("#addUser").val('');
        addCatDOM(data, name);

    }
}


function addCatDOM(data, name) {
    var button = $("<input></input>");
    button.addClass("delete").attr("type", "button").attr("value", "-").attr("id", data).click(removeCatDOM);
    var li = $("<li></li>");
    li.addClass("cate").text(name);
    li.prepend(button);
    $("#ul").append(li);
}

function checkremove(data, id) {
    if (data === 'true') {
        removeCatDOM(id);
    }
}

function removeCatDOM(event) {
    $(event.target).parent().remove();

}

function removeCategories(event) {
    var id = $(event.target).attr("id");
    $.post('../Application/Services/manageCategories.php', {id: id, type: 'remove'}, function (data) {
        checkremove(data, id);
    }).fail(function () {
        alert("erro");
    });
}


$(document).ready(function () {
    $("#addButton").click(addCategories);
    $(".delete").click(removeCategories);
});


