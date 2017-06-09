var sharedUsers = [
    {userID: 1, userNAME: "José Bernardes"},
    {userID: 2, userNAME: "Joel Pereira"},
    {userID: 3, userNAME: "Sir Alberto Chia"},
    {userID: 4, userNAME: "Don Carlos Covas"}

];


function details(title,desc,user,mail,date,opin,photo) {
     $("#title").text(title);
     $("#desc").text(desc);
     $("#user").text(user);
     $("#mail").text(mail).attr("href","mailto:" + title);
     $("#date").text(date);
     $("#opin").text(opin);
     $("#photo").attr("src",photo);
}

var users = [
    {userID: 5, userNAME: "jose"},
    {userID: 6, userNAME: "João Alfredo"}
];//AJAX

Array.prototype.containsNAME = function (element, array) {
    for (var i = 0; i < array.length; i++) {
        if (array[i].userNAME === element) {
            return array[i];
        }
    }
    return -1;
};
Array.prototype.containsID = function (element, array) {
    for (var i = 0; i < array.length; i++) {
        if (array[i].userID === element) {
            return array[i];
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
    button.addClass("removeButton").attr("type", "button").attr("value", "x").click(removeUser);
    var span = $("<span></span>");
    span.text(user.userNAME);
    var checkbox = $("<input></input>");
    var commentid = "comment_" + user.userID;
    checkbox.addClass("commentBox").prop('checked', true).attr("type", "checkbox").attr("id", commentid);
    var label = $("<label></label>");
    label.addClass("commentLabel").attr("for", commentid).text("Comentar");
    p.append(button).append(span).append(checkbox).append(label);
    $("#sharedBox").append(p);
//    addListener();


   var h3 = $("<h3></h3>");
   h3.text("sfsdg");
   var img = $("<img>");
   img.attr("src", "link");
   img.attr("sad","af");
   var div = $("<div></div>");
   div.append(h3).append(img);
   div.html();
}

function removeUserfromArray(user, array) {
    var i = array.indexOf(user);
    if (i !== -1) {
        array.splice(i, 1);
    }
}

function addUser() {

    var user = users.containsNAME(getUserDOM(), users);
    if (user !== -1) {
        var newUser = {userID: user.userID, userNAME: user.userNAME, allowComments: '1'};
        sharedUsers.push(newUser);
        addUserDOM(newUser);
        removeUserfromArray(user, users);
    } else {
        $("#addButton").css("box-shadow", "0px 0px 5px 1px red");
        $("#addButton").css("color", "red");
        setTimeout(function () {
            $("#addButton").css("box-shadow", "none");
            $("#addButton").css("color", "black");

        }, 300);
    }
}

function removeUserDOM(id) {
    window.console.log($("p#" + id));
    $("p#" + id).remove();
}

function removeUser(event) {
    var id = $(event.target).parent().attr("id");
    var user = sharedUsers.containsID(parseInt(id), sharedUsers);
    if (user !== -1) {
        var newUser = {userID: user.userID, userNAME: user.userNAME};
        removeUser(user, sharedUsers);
        users.push(newUser);
        removeUserDOM(user.userID);
    }
}
$(document).ready(function () {
    $("#addButton").click(addUser);
    $(".removeButton").click(removeUser);
});

