var sharedUsers = [];


var users = [
    {userID: 1, userNAME: "José Paulo"},
    {userID: 2, userNAME: "João Alfredo"}
];//AJAX

Array.prototype.containsNAME = function (element) {
    for (var i = 0; i < this.length; i++) {
        if (this[i].userNAME === element) {
            return this[i];
        }
    }
    return -1;
};
Array.prototype.containsID = function (element) {
    for (var i = 0; i < this.length; i++) {
        if (this[i].userID === element) {
            return this[i];
        }
    }
    return -1;
};

function getUserDOM() {
    return $("#addUser").val();
}

function addUserDOM(user) {
    var p = $("<p></p>");
    p.addClass("results").attr("id", user.userID);
    var button = $("<input></input>");
    button.addClass("removeButton").attr("type", "button").attr("value", "x");
    var span = $("<span></span>");
    span.text(user.userNAME);
    var checkbox = $("<input></input>");
    var commentid = "comment_" + user.userID;
    checkbox.addClass("commentBox").prop('checked', true).attr("type", "checkbox").attr("id", commentid);
    var label = $("<label></label>");
    label.addClass("commentLabel").attr("for", commentid).text("Comentar");
    p.append(button).append(span).append(checkbox).append(label);
    $("#sharedBox").append(p);
}

function removeUser(user, array) {
    var i = array.indexOf(user);
    if (i !== -1) {
        array.splice(i, 1);
    }
}

function addUser() {

    var user = users.containsNAME(getUserDOM());
    if (user !== -1) {
        var newUser = {userID: user.userID, userNAME: user.userNAME, allowComments: '1'};
        sharedUsers.push(newUser);
        addUserDOM(newUser);
        removeUser(user, users);
    }
}

function removeUserDOM(id) {
    $("p#" + id).remove();
}

function removeUser(id) {
    var user = sharedUsers.containsID(id);
    if (user !== -1) {
        var newUser = {userID: user.userID, userNAME: user.userNAME};
        removeUser(user, sharedUsers);
        users.push(newUser);
        removeUserDOM(user.userID);
    }

}
function aaa() {
    alert("aaa");
    
}

$(document).ready(function () {
    $("#addButton").click(addUser);
//    $(".removeButton").click(aaa);
    $( ".removeButton" ).click(function (event) {
         alert("aaa");
        var id = event.target.parent().attr("id");//MAAALLL
        removeUser(id);
    });
});

