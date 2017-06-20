
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
        $("div#search ul li").remove();
        $("div#search ul").css('display', 'block');
        addSearchDOM(json);
    } else {
        $("div#search ul li").remove();
        $("div#search ul").css('display', 'none');
    }
}




function searchAJAX(string) {
    $.post('../Application/Services/searchDocs.php', {type: getSearchTypeDOM(), input: string}, function (data) {
        searchUserAJAXproce(data);
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

function addSearchDOM(data) {
    for (var i = 0; i < data.length; i++) {
        var li = $("<li></li>");
        li.addClass('.noselect');
        li.click(searchEVH);
        li.html(data[i]);
        $("div#search ul").append(li);
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

function searchEVH() {
    var value = $(event.target).html();
    addUserInputDOM(value);
    removeSugestionDOM(false);
    searchAJAX();


}

function liveSearchEVH() {
    if (getSearchDOM().length > 0) {
        if (getSearchTypeDOM() === 'user') {
            searchUserAJAX(getSearchDOM());
        } else if (getSearchTypeDOM() === 'title') {


        } else {
            removeSugestionDOM(true);
        }
    }
}

$(document).ready(function () {

    $("#inputS").keyup(liveSearchEVH);
}
);


