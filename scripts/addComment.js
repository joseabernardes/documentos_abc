
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
            CommentUserID: parseInt(json.CommentUserID)};
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

var ee = {
    CommentID: 1,
    CommentCONTENT: "José Bernardes",
    CommentDATE: 1,
    CommentDocumentID: 2,
    CommentNAME: 3,
    CommentEMAIL: 3,
    CommentUserID: 3};


function getCommentObjectDOM() {
    if ($("#name").length) { //não existe
        var name = $("#name").val();
        var email = $("#email").val();
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
    li.addClass("comment");
    var h3 = $("<h3></h3>");
    h3.html(obj.CommentNAME);
    var a = $("<a></a>");
    if (obj.CommentUserID === null) {
        a.attr('href', 'mailto:' + obj.CommentEMAIL);
    } else {
        a.attr('href', 'profile-page.php?id=' + obj.CommentUserID);
    }
    var span = $("<span></span>");
    span.html('◷ ' + obj.CommentDATE);
    var p = $("<p></p>");
    p.html(obj.CommentCONTENT);
    a.append(h3);
    li.append(a).append(span).append(p);
    $("#commentsBox ol").append(li);
    $("textarea#commentArea").val('');

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



