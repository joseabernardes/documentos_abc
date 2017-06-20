
/*
 * -------------------------------------- AJAX --------------------------------------
 */
function addCategories() {
    var name = $("#inputS").val();
    $.post('../Application/Services/manageCategories.php', {name: name, type: 'add'}, function (data) {
        checkadd(data, name);
    }).fail(function () {
        alert("erro");
    });
}


function removeCategories(event) {
    var id = $(event.target).attr("id");
    if (parseInt(id) !== 1) {
        $.post('../Application/Services/manageCategories.php', {id: id, type: 'remove'}, function (data) {
            checkremove(data, event);
        }).fail(function () {
            alert("erro");
        });
    }else{
         checkremove('false', event);
    }
}

function checkadd(data, name) {
    if (data === 'false') {
        $("#addButton").css("box-shadow", "0px 0px 5px 1px red");
        $("#addButton").css("color", "red");
        setTimeout(function () {
            $("#addButton").css("box-shadow", "none");
            $("#addButton").css("color", "black");

        }, 300);
    } else {
        $("#inputS").val('');
        addCatDOM(data, name);

    }
}
function checkremove(data, event) {
    if (data === 'false') {
        $(event.target).css("box-shadow", "0px 0px 5px 1px red");
        setTimeout(function () {
             $(event.target).css("box-shadow", "none");

        }, 300);
    } else {
        removeCatDOM(event);
    }
}

/*
 * --------------------------------- DOM ACCESS/CREATE ---------------------------------
 */

function addCatDOM(data, name) {
    var button = $("<input></input>");
    button.addClass("delete").attr("type", "button").attr("value", "-").attr("id", data).click(removeCategories);
    var li = $("<li></li>");
    li.addClass("cate").text(name);
    li.prepend(button);
    $("ul#manageCat").append(li);
}
/*
 * --------------------------------- Event Handlers ---------------------------------
 */

function removeCatDOM(event) {
    $(event.target).parent().remove();
}


$(document).ready(function () {
    $("#addButton").click(addCategories);
    $(".delete").click(removeCategories);
});


