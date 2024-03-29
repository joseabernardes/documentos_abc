
/*
 * -------------------------------------- AJAX --------------------------------------
 */

function addCommentAJAXproce(data) {
    try {
        var json = JSON.parse(data);
    } catch (err) {
        window.console.log(err);
        json = false;
    }
    if (json === false) {
        $("#send").css("box-shadow", "0px 0px 5px 1px red");
        $("#send").css("color", "red");
        setTimeout(function () {
            $("#send").css("box-shadow", "none");
            $("#send").css("color", "white");

        }, 300);


    } else {
        var newComment = {
            CommentID: parseInt(json.CommentID),
            CommentCONTENT: json.CommentCONTENT,
            CommentDATE: json.CommentDATE,
            CommentDocumentID: parseInt(json.CommentDocumentID),
            CommentNAME: json.CommentNAME,
            CommentEMAIL: json.CommentEMAIL,
            CommentUserID: json.CommentUserID};
        addCommentDOM(newComment);

    }
}


function addCommentAJAX(obj) {
    $.post('../Application/Services/addComment.php', {CommentCONTENT: obj.CommentCONTENT, CommentDocumentID: obj.CommentDocumentID, CommentNAME: obj.CommentNAME, CommentEMAIL: obj.CommentEMAIL}, function (data) {
        addCommentAJAXproce(data);
    }).fail(function () {
        alert("erro");
    });
}


/*
 * --------------------------------- DOM ACCESS/CREATE ---------------------------------
 */

function getCommentObjectDOM() {
    if ($("#name").length) { //não existe
        var name = $("input#name").val();
        var email = $("input#email").val();
    } else {
        var name = null;
        var email = null;
    }

    var obj = {
        CommentCONTENT: $("textarea#commentArea").val(),
        CommentDocumentID: $("#docid").val(),
        CommentNAME: name,
        CommentEMAIL: email
    };

    return obj;
}

function addCommentDOM(obj) {

    var li = $("<li></li>");
    li.addClass("comment").attr('id', 'c-' + obj.CommentID);
    var h3 = $("<h3></h3>");
    h3.html(obj.CommentNAME);
    var a = $("<a></a>");
    if (obj.CommentUserID === null) {
        a.attr('href', 'mailto:' + obj.CommentEMAIL);
    } else {
        a.attr('href', '../v_private/profile-page.php?id=' + obj.CommentUserID);
    }
    var time = $("<a></a>");
    time.html('◷ ' + obj.CommentDATE).attr('href', '#c-' + obj.CommentID).addClass('time');
    var p = $("<p></p>");
    p.html(obj.CommentCONTENT);
    a.append(h3);
    li.append(a).append(time).append(p);
    $("#commentsBox ol").append(li);
    $("textarea#commentArea").val('');
    $("input#name").val('');
    $("input#email").val('');
    var element = $("div#commentsBox > h2 > span");
    element.html(parseInt(element.html()) + 1);

}

/*
 * --------------------------------- Event Handlers ---------------------------------
 */

function addCommentEVH() {
    addCommentAJAX(getCommentObjectDOM());
}

$(document).ready(function () {
    $("#send").click(addCommentEVH);

});



