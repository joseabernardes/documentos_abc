


function deleteCategory(event) {
    event.preventDefault();
    var result = confirm("Tem a certeza que pretende eliminar?");
    if (result) {
        window.location = this.href;
    }

}


$(document).ready(function () {
    $("div#mydocs li a:last-child").click(deleteCategory);

});


