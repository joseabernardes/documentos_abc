
function setMargin(element, value) {
    $(".visibility[for=" + element + "]").css("margin-bottom", value);
}

function openShared() {
    if ($("#sharedBox").css("display") === "none") {
        closePublic();
        $("#sharedBox").css("display", "block");
        setMargin("publico", "10px");
        setMargin("privado", "10px");
    }
}
function openPublic() {
    if ($("#publicBox").css("display") === "none") {
        closeShared();
        $("#publicBox").css("display", "block");
        setMargin("partilhado", "10px");
        setMargin("privado", "10px");
    }
}

function closeShared() {
    if ($("#sharedBox").css("display") !== "none") {
        $("#sharedBox").css("display", "none");
        setMargin("publico", "0px");
        setMargin("privado", "0px");
    }
}
function closePublic() {
    if ($("#publicBox").css("display") !== "none") {
        $("#publicBox").css("display", "none");
        setMargin("partilhado", "0px");
        setMargin("privado", "0px");
    }
}
function closeAll() {
    closeShared();
    closePublic();
}
$(document).ready(function () {
    $("#partilhado").click(openShared);
    $("#publico").click(openPublic);
    $("#privado").click(closeAll);
});

