/*
 * --------------------------------- ARRAYS ---------------------------------
 */

var sharedUsers = [
//    {userID: 1, userEMAIL: "José Bernardes", allowComments: 1},
//    {userID: 2, userEMAIL: "Joel Pereira", allowComments: 1},
//    {userID: 3, userEMAIL: "Sir Alberto Chia", allowComments: 1},
//    {userID: 4, userEMAIL: "Don Carlos Covas", allowComments: 1}

];

function removeUserfromArray(user, array) {
    var i = array.indexOf(user);
    if (i !== -1) {
        array.splice(i, 1);
    }
}

function containsID(element, array) {
    for (var i = 0; i < array.length; i++) {
        if (array[i].userID === element) {
            return array[i];
        }
    }
    return false;
}

/*
 * --------------------------------- AJAX ---------------------------------
 */


function searchUserAJAXproce(data) {
    try {
        var json = JSON.parse(data);
    } catch (err) {
        window.console.log(err);
        json = false;
    }
    if (json !== false) {
        $("div#searchBar ul li").remove();
        $("div#searchBar ul").css('display', 'block');
        addSearchDOM(json);
    } else {
        $("div#searchBar ul li").remove();
        $("div#searchBar ul").css('display', 'none');
    }
}



function addUserAJAXproce(data) {
    try {
        var json = JSON.parse(data);
    } catch (err) {
        window.console.log(err);
        json = false;
    }
    if (json === false || containsID(parseInt(json.userID), sharedUsers) !== false) {
        $("#addButton").css("box-shadow", "0px 0px 5px 1px red");
        $("#addButton").css("color", "red");
        setTimeout(function () {
            $("#addButton").css("box-shadow", "none");
            $("#addButton").css("color", "black");

        }, 300);
    } else {
        var newUser = {userID: parseInt(json.userID), userEMAIL: json.userEMAIL, allowComments: true};
        sharedUsers.push(newUser);
        addUserDOM(newUser);

    }
}

function addUserAJAX(email) {
    $.post('../Application/Services/getUsers.php', {type: 'add', input: email}, function (data) {
        addUserAJAXproce(data);
    }).fail(function () {
        alert("erro");
    });
}


function searchUserAJAX(string) {
    $.post('../Application/Services/getUsers.php', {type: 'search', input: string}, function (data) {
        searchUserAJAXproce(data);
    }).fail(function () {
        alert("erro");
    });
}

/*
 * --------------------------------- DOM ACCESS/CREATE ---------------------------------
 */

function removeUserDOM(id) {
    $("p#" + id).remove();
}

function getUserDOM() {
    return $("#addUser").val();
}


function addUserInputDOM(value) {
    $("#addUser").val(value);
}

function addSearchDOM(data) {
    for (var i = 0; i < data.length; i++) {
        window.console.log(i);
        var li = $("<li></li>");
        li.addClass('.noselect');
        li.click(moveUserEVH);
        li.html(data[i]);
        $("div#searchBar ul").append(li);
    }
}

function addUserDOM(user) {
    var p = $("<p></p>");
    p.addClass("results").attr("id", user.userID);
    var button = $("<input></input>");
    button.addClass("removeButton").attr("type", "button").attr("value", "x").click(removeUserEVH);
    var span = $("<span></span>");
    span.text(user.userEMAIL);
    var checkbox = $("<input></input>");
    var commentid = "comment_" + user.userID;
    checkbox.addClass("commentBox").prop('checked', user.allowComments).attr("type", "checkbox").attr("id", commentid).change(allowCommentsSharedEVH);
    var label = $("<label></label>");
    label.addClass("commentLabel").attr("for", commentid).text("Comentar");
    p.append(button).append(span).append(checkbox).append(label);
    $("#sharedBox").append(p);
    removeSugestionDOM();
}

function hideSearchDOM() {
    $("div#searchBar ul").css('display', 'none');
}

function removeSugestionDOM() {
    $("div#searchBar ul li").remove();
    $("div#searchBar ul").css('display', 'none');
    addUserInputDOM('');
}


/*
 * --------------------------------- Event Handlers ---------------------------------
 */

function moveUserEVH() {
    var value = $(event.target).html();
    addUserInputDOM(value);
}

function addUserEVH() {
    addUserAJAX(getUserDOM());
}

function removeUserEVH(event) {
    var id = $(event.target).parent().attr("id");
    var user = containsID(parseInt(id), sharedUsers);
    if (user !== false) {
        var newUser = {userID: user.userID, userEMAIL: user.userEMAIL, allowComments: user.allowComments};
        removeUserfromArray(user, sharedUsers);
        removeUserDOM(user.userID);
    }
}

function liveSearchEVH(event) {
    if (getUserDOM().length > 0) {
        searchUserAJAX(getUserDOM());
    } else {
        removeSugestionDOM();
    }
}

function allowCommentsSharedEVH(event) {
    var id = $(event.target).parent().attr("id");
    var user = containsID(parseInt(id), sharedUsers);
    if (user !== false) {
        user.allowComments = this.checked;
    }
}

function preventEnterEVH(event) {
    if (event.keyCode === 13 || event.keyCode === 10) {
        if ($(event.target).is('input#addUser')) {
            event.preventDefault();
            addUserEVH();
        } else if (!$(event.target).is('textarea#summary')) {
            event.preventDefault();
        }
    }
}

function submitFormEVH() {
    try {
        var shared = JSON.stringify(sharedUsers);
    } catch (err) {
        window.console.log(err);
        shared = [];
    }
    $("input#sharedUsers").val(encodeURIComponent(shared));
    $("form#document").submit();
}

function restoreShared() {
    var hidenShare = $("input#sharedUsers");
    var val = decodeURIComponent(hidenShare.val());
    if (val !== '') {
        try {
            var json = JSON.parse(val);
        } catch (err) {
            window.console.log(err);
            json = [];
        }
        for (var i = 0; i < json.length; i++) {
            var newUser = {userID: parseInt(json[i].userID), userEMAIL: json[i].userEMAIL, allowComments:  parseInt(json[i].allowComments)};
            sharedUsers.push(newUser);
            addUserDOM(newUser);
        }
    }
}


$(document).ready(function () {

    $("#addButton").click(addUserEVH);
    $(".removeButton").click(removeUserEVH);
    $("#addUser").keyup(liveSearchEVH);
    $("form#document").keypress(preventEnterEVH);
    $("input#submit").click(submitFormEVH);
    restoreShared();
});



