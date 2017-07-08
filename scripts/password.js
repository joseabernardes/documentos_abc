function change(eye, input) {

    if (input.attr('type') === "password") {
        input.attr('type', 'text');
        eye.attr('src', '../images/password/show.png');
    } else {
        input.attr('type', 'password');
        eye.attr('src', '../images/password/hide.png');
    }
}


function changeImgDOM(url) {
    $('img#avatar').attr('src', url).css('display', 'block');

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


    $("input#file").change(imgpreviewEVH);
    $('img#avatar').css('display', 'none');

    $('#pwdLogin').click(function () {
        change($('#pwdLogin'), $('#Pass'));
    });
    $('#pwd1').click(function () {
        change($('#pwd1'), $('#PassR'));
    });
    $('#pwd2').click(function () {
        change($('#pwd2'), $('#PassR2'));
    });

});

