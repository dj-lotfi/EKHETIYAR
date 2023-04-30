function ModifBanque(bankId) {
    document.querySelector('.show-at-first').style.display = 'none';
    console.log('Modifier banque ' + bankId);
    var loadingScreen = document.getElementById('loader');
    var content = document.getElementById('modification');
    var modifSpace = document.querySelector('.modifying-window');

    modifSpace.style.display = "block";
    content.style.display = "none";
    loadingScreen.style.display = "block";
    /*
        var xhttp = new XMLHttpRequest();
        var url = "admin/affichageBanque/" + bankId;
        xhttp.open("GET", url, true);
        xhttp.onload = function () {
            if (this.status == 200) {
                loadingScreen.style.display = "none";
                content.style.display = "block";
                popup.style.display = "block";
                content.innerHTML = this.responseText;
            }
        };
        xhttp.send();*/
};

function SupprimBanque(bankId) {
    var popup = document.getElementById('warning');
    popup.style.display = 'block';
    var confirmer = document.getElementById('confirm');

    confirmer.addEventListener('click', () => {
        /*
        var xhttp = new XMLHttpRequest();
        var url = "admin/DeleteBank/" + bankId;
        xhttp.open("POST", url, true);
        xhttp.onload = function () {
            if (this.status == 200) {
                console.log('Banque '+bankId+' supprime');
            }
        };*/
        location.reload();
    });
};

function closeUpload() {
    var err = document.getElementById("upload-image");
    err.style.display = "none";
};
document.getElementById('up').addEventListener('click', function () {
    var popup = document.getElementById('upload-image');
    popup.style.display = 'block';
});

document.getElementById('upload-logo').addEventListener('submit', function (event) {
    event.preventDefault();
    var xhttp = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/UploadLogo" ;
    var content = document.getElementById('upload-feedback');
    xhttp.open("POST", url, true);
    xhttp.onload = function () {
        if (this.status == 200) {
            console.log('Uploaded successfully');
            content.innerHTML = this.responseText;
        }
    };
    xhttp.send();
    //document.getElementById("choix").reset();
    return false;

});
