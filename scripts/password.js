

$(document).ready(function () {
    document.getElementById("pwd").addEventListener("click", function () {
        var pwd = document.getElementById("Pass");
        if (pwd.getAttribute("type") === "password") {
            pwd.setAttribute("type", "text");
            $('#pwd').attr('src','../images/password/show.png');
     
        } else {
            pwd.setAttribute("type", "password");
            $('#pwd').attr('src','../images/password/hide.png');
        }
    });
});

