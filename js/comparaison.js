var body = document.body;
var cached = 0;

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
        var content = document.getElementById("comparaison");
        content.style.display = "none";
        loadingScreen.style.display = "block";

        // Load the PHP script into the popup
        var xhttp = new XMLHttpRequest();
        // Construct the URL for the PHP function with the form values as parameters
        var url = "Comparatif/displayComparaison/" + bank1 + "/" + bank2;
        xhttp.open("GET", url, true);
        xhttp.setRequestHeader("Cache-Control", "no-cache");
        xhttp.setRequestHeader("Pragma", "no-cache");
        xhttp.setRequestHeader("Expires", "0");
        xhttp.onload = function () {
            if (this.status == 200) {
                loadingScreen.style.display = "none";
                content.style.display = "grid";
                content.innerHTML = this.responseText;

            }
        };

        xhttp.send();
        //document.getElementById("choix").reset();
        document.getElementById('SubmitBtn').removeAttribute("disabled");

    }
};

function closePopup() {
    var err = document.getElementById("error");
    err.style.display = "none";
};

function changelogo() {
    
    var img1 = document.getElementById("b1");
    var img2 = document.getElementById("b2");
    

    var selectedValue1 = document.getElementById('bank1').options[document.getElementById('bank1').selectedIndex].id;
    var selectedValue2 = document.getElementById('bank2').options[document.getElementById('bank2').selectedIndex].id;

    img1.src = "/ProjectFileV5/app/logos/"  + selectedValue1 ;
    img2.src = "/ProjectFileV5/app/logos/"  +selectedValue2 ;

}




