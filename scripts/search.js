
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
    removeSugestionDOM(false);
    removeSearchDOM();
    if (json !== false) {
        $("div#search ul").css('display', 'block');
        addSearchUserDOM(json);
    } else {
        $("div#search ul").css('display', 'none');
    }
}

function searchDocAJAXproce(data) {
    try {
        var json = JSON.parse(data);
    } catch (err) {
        window.console.log(err);
        json = false;
    }
    removeSearchDOM();
    if (json !== false) {
        addSearchResultsDOM(json);
    }
}




function searchAJAX(string) {
    $.get('../Application/Services/searchDocs.php', {type: getSearchTypeDOM(), input: string}, function (data) {
        searchDocAJAXproce(data);
    }).fail(function () {
        alert("erro");
    });
}

function searchUserAJAX(string) {
    $.post('../Application/Services/getUsers.php', {type: 'searchAll', input: string}, function (data) {
        searchUserAJAXproce(data);
    }).fail(function () {
        alert("erro");
    });
}

/*
 * --------------------------------- DOM ACCESS/CREATE ---------------------------------
 */

function addSearchUserDOM(data) {
    for (var i = 0; i < data.length; i++) {
        var li = $("<li></li>");
        li.addClass('.noselect');
        li.click(searchEVH);
        li.html(data[i]);
        $("div#search ul").append(li);
    }
}


//                     'DocumentID' => $value->getDocumentID(),
//                        'DocumentTITLE' => $value->getDocumentTITLE(),
//                        'DocumentUserID' => $value->getDocumentUserId(),
//                        'DocumentUserNAME' => $user->getUserNAME(),
//                        'DocumentSUMMARY' => $value->getDocumentSUMMARY(),
//                        'DocumentDATE' => $value->getDocumentDATE(),
//                        'DocumentTags' => $tag

function addSearchResultsDOM(data) {
    $("main#index h3 > span").html(data.length);
    for (var i = 0; i < data.length; i++) {
        var li = $("<li></li>");
        var aTitle = $("<a></a>");
        aTitle.attr('href', '../v_private/view-document.php?id=' + data[i].DocumentID);
        var h3 = $("<h3></h3>");
        h3.html(data[i].DocumentTITLE);
        aTitle.append(h3);
        var aUser = $("<a></a>");
        aUser.attr('href', '../v_private/profile-page.php?id=' + data[i].DocumentUserID);
        aUser.html(data[i].DocumentUserNAME);
        aUser.addClass('user');
        var spanDate = $("<span></span>");
        spanDate.html(data[i].DocumentDATE);
        spanDate.addClass('date');
        var h4 = $("<h4></h4>");
        h4.html('Resumo:');
        var spanSum = $("<span></span>");
        spanSum.addClass('sum');
        spanSum.html(data[i].DocumentSUMMARY);
        var h4Tag = $("<h4></h4>");
        h4Tag.html('Tags:');
        h4Tag.addClass('tagsTitle');
        li.append(aTitle).append(' por ').append(aUser).append(spanDate).append(h4).append(spanSum).append(h4Tag);

        for (var j = 0; j < data[i].DocumentTags.length; j++) {
            var tempA = $("<a></a>");
            tempA.attr('href','view-docs.php?type=tag&id=' +  data[i].DocumentTags[j]);
            tempA.html(data[i].DocumentTags[j]);
            tempA.addClass('user');
            if (j === 0) {
                li.append(tempA);
            } else {
                li.append(', ').append(tempA);
            }
        }

        $("main#index ul#searchResults").append(li);
    }
}


function getSearchDOM() {
    return $("#inputS").val();
}


function getSearchTypeDOM() {
    if ($("input#radioUser").is(':checked')) {
        return 'user';
    } else if ($("input#radioTitle").is(':checked')) {
        return 'title';
    } else {
        return null;
    }
}

function removeSearchDOM() {
    $("ul#searchResults li").remove();
    $("main#index h3 > span").html('0');


}


function removeSugestionDOM(bool) {
    $("div#search ul li").remove();
    $("div#search ul").css('display', 'none');
    if (bool) {
        addUserInputDOM('');
    }

}

function addUserInputDOM(value) {
    $("#inputS").val(value);
}

/*
 * --------------------------------- Event Handlers ---------------------------------
 */

function searchEVH(event) {
    var value = $(event.target).html();
    addUserInputDOM(value);
    removeSugestionDOM(false);
    searchAJAX(getSearchDOM());


}

function liveSearchEVH() {
    if (getSearchDOM().length > 0) {
        if (getSearchTypeDOM() === 'user') {
            searchUserAJAX(getSearchDOM());
        } else if (getSearchTypeDOM() === 'title') {
            searchAJAX(getSearchDOM());
        } else {
            removeSugestionDOM(true);
            removeSearchDOM();
        }
    } else {
        removeSugestionDOM(true);
        removeSearchDOM();
    }
}

$(document).ready(function () {

    $("#inputS").keyup(liveSearchEVH);
    $("input#addButton").click(liveSearchEVH);
}
);


