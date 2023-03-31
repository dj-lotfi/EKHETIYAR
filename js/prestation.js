var modal = document.getElementById("' . $modalId . '");
var btn = document.getElementById("' . $buttonId . '");
var span = modal.getElementsByClassName("close")[0];
btn.onclick = function () {
    modal.style.display = "block";
};
span.onclick = function () {
    modal.style.display = "none";
};
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
