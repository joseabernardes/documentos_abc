function change(eye, input) {

    if (input.attr('type') === "password") {
        input.attr('type', 'text');
        eye.attr('src', '../images/password/show.png');
    } else {
        input.attr('type', 'password');
        eye.attr('src', '../images/password/hide.png');
    }
}

$(document).ready(function () {

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

