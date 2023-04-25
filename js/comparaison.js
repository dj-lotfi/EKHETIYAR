var body = document.body;
var cached = 0;

document.getElementById("choix").addEventListener("submit", function (event) {
    event.preventDefault(); // prevent form submission
    openPopup(); // show the pop-up
    cached = 1;
    return false;
});


function openPopup() {
    // Get the values of the form fields
    var bank1 = document.getElementById("bank1").value;
    var bank2 = document.getElementById("bank2").value;

    var err = document.getElementById("error");
    if (bank1 == bank2) {
        err.style.display = "block";
    }
    else {
        err.style.display = "none";


        var loadingScreen = document.getElementById('loader');
        // Display the popup
        var popup = document.getElementById("popup");
        var content = document.getElementById("comparaison");
        popup.style.display = "block";
        body.style.overflowY = 'hidden';

        loadingScreen.style.display = "block";

        // Load the PHP script into the popup
        var xhttp = new XMLHttpRequest();
        // Construct the URL for the PHP function with the form values as parameters
        var url = "Comparatif/displayComparaison/" + bank1 + "/" + bank2;
        xhttp.open("GET", url, true);
        xhttp.onload = function () {
            if (this.status == 200) {
                loadingScreen.style.display = "none";

                content.innerHTML = this.responseText;
                popup.style.display = "block";
                body.style.overflowY = 'hidden';

            }
        };

        xhttp.send();

    }
}

function closePopup() {
    var popup = document.getElementById("popup");
    var err = document.getElementById("error");
    err.style.display = "none";
    popup.style.display = "none";
}