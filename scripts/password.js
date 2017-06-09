

$(document).ready(function () {
    document.getElementById("eye").addEventListener("click", function () {
        var pwd = document.getElementById("Pass");
        if (pwd.getAttribute("type") === "password") {
            pwd.setAttribute("type", "text");
            
        } else {
            pwd.setAttribute("type", "password");
        }
    });
});

