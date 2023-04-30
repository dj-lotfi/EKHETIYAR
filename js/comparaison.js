var body = document.body;
var cached = 0;

function afficheCategorie(checkbox){
    if (checkbox.checked) {
        checkbox.nextElementSibling.style.height = '400px';
        checkbox.nextElementSibling.style.overflow = 'hidden';
    }
    else {
        checkbox.nextElementSibling.style.height = '0px';
    }
} 




document.getElementById("choix").addEventListener("submit", function (event) {
    event.preventDefault();
    openPopup(); // show the pop-up
    //document.getElementById("choix").reset();
    return false;
    

});


function openPopup() {
    console.log('checked');
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
        content.style.display = "none";
        loadingScreen.style.display = "block";

        // Load the PHP script into the popup
        var xhttp = new XMLHttpRequest();
        // Construct the URL for the PHP function with the form values as parameters
        var url = "Comparatif/displayComparaison/" + bank1 + "/" + bank2;
        xhttp.open("GET", url, true);
        xhttp.onload = function () {
            if (this.status == 200) {
                loadingScreen.style.display = "none";
                content.style.display = "block";
                popup.style.display = "block";
                content.innerHTML = this.responseText;

            }
        };

        xhttp.send();
        //document.getElementById("choix").reset();
        document.getElementById('SubmitBtn').removeAttribute("disabled");

    }
};

function closePopup() {
    var popup = document.getElementById("popup");
    var err = document.getElementById("error");
    err.style.display = "none";
    popup.style.display = "none";
};




