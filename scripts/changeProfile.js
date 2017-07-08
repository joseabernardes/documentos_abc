
/*
 * --------------------------------- DOM ACCESS/CREATE ---------------------------------
 */

function showPassDOM() {
    $("input#PassR").parent().css('display', 'flex');
    $("input#PassRNOVA").parent().css('display', 'flex');
    $("input#PassRNOVA2").parent().css('display', 'flex');
}

function hidePassDOM() {
    $("input#PassR").parent().css('display', 'none');
    $("input#PassRNOVA").parent().css('display', 'none');
    $("input#PassRNOVA2").parent().css('display', 'none');
}

function changeImgDOM(url) {
    $('img#avatar').attr('src', url);

}




/*
 * --------------------------------- Event Handlers ---------------------------------
 */

function changePassEVH() {
    if (this.checked) {
        showPassDOM();
    } else {
        hidePassDOM();
    }
}
function imgpreviewEVH(event) {
    if (event.target.files && event.target.files[0]) {
        var reader = new FileReader();

        reader.onload = function (event) {
            changeImgDOM(event.target.result);
        };

        reader.readAsDataURL(event.target.files[0]);
    }

}


$(document).ready(function () {
    hidePassDOM();
    $("input#alpwd").change(changePassEVH);
    $("input#file").change(imgpreviewEVH);

});
