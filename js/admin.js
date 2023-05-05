var modif_sec_loaded = 0;
function Upload() {
    console.log('test2');

    var fd = new FormData();
    var bank = $('#bank_id').val();
    console.log(bank);

    var files = $('#file')[0].files;

    // Check file selected or not
    if (files.length > 0) {

        fd.append('file', files[0]);

        $.ajax({
            url: 'j2sJDpUgQQmLF5EF/UploadLogo/' + bank,
            type: 'post',
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 1) {
                    var extension = response.extension;
                    var path = response.path;
                    console.log(response.name);

                    $('.prevel').hide();
                    if (extension == 'pdf' || extension == 'docx') {
                        $("#fileprev").attr("href", path);
                        $("#fileprev").show();
                    } else {
                        $("#imgprev").attr("src", path);
                        $("#imgprev").show();
                    }

                } else {
                    alert('File not uploaded');
                }
            }
        });
    }
}
function ModifBanque(bankId) {
    document.querySelector('.show-at-first').style.display = 'none';
    console.log('Modifier banque ' + bankId);
    var loadingScreen = document.getElementById('loader');
    var content = document.getElementById('modification');
    var modifSpace = document.querySelector('.modifying-window');

    modifSpace.style.display = "grid";
    content.style.display = "none";
    loadingScreen.style.display = "block";
    var xhttp = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/Affichagebanque/" + bankId;
    xhttp.open("GET", url, true);
    xhttp.onload = function () {
        if (this.status == 200) {
            loadingScreen.style.display = "none";
            content.style.display = "block";
            modifSpace.style.display = "grid";
            content.innerHTML = this.responseText;
        }
    };
    xhttp.send();
    modif_sec_loaded = 1;
};

function AjoutBanque() {
    document.querySelector('.show-at-first').style.display = 'none';
    var loadingScreen = document.getElementById('loader');
    var content = document.getElementById('modification');
    var modifSpace = document.querySelector('.modifying-window');

    modifSpace.style.display = "block";
    content.style.display = "none";
    loadingScreen.style.display = "block";
    var xhttp = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/AjBanque";
    xhttp.open("GET", url, true);
    xhttp.onload = function () {
        if (this.status == 200) {
            loadingScreen.style.display = "none";
            content.style.display = "block";
            modifSpace.style.display = "block";
            content.innerHTML = this.responseText;
        }
    };
    xhttp.send();
    modif_sec_loaded = 1;
}

function SupprimBanque(bankId) {
    var popup = document.getElementById('warning');
    popup.style.display = 'block';
    var confirmer = document.getElementById('confirm');

    confirmer.addEventListener('click', () => {
        var xhttp = new XMLHttpRequest();
        var url = "j2sJDpUgQQmLF5EF/DeleteBank/" + bankId;
        xhttp.open("GET", url, true);
        xhttp.onload = function () {
            if (this.status == 200) {
                console.log('Banque ' + bankId + ' supprime');
            }
        };
        //location.reload();
    });
};

function closeWarning() {
    var err = document.getElementById("warning");
    err.style.display = "none";
};

function closeUpload() {
    var err = document.getElementById("upload-image");
    err.style.display = "none";
};
/*
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

function UploadLogo(event){
    event.preventDefault();
    var xhttp = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/UploadLogo";
    var content = document.getElementById('upload-feedback');
    xhttp.open("GET", url, true);
    xhttp.onload = function () {
        if (this.status == 200) {
            console.log('Uploaded successfully');
            content.innerHTML = this.responseText;
        }
    };
    xhttp.send();
    //document.getElementById("choix").reset();

}*/


function ajoutSubmitted() {
    sendData_newbank();
    addbanque(); // show the pop-up
    return false;
};
function sendData_newbank() {
    var xhr = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/addbanque";
    var formData = new FormData(document.getElementById("addbanque"));
    xhr.open("POST", url, true);
    xhr.send(formData);
}
function addbanque() {
    var xhttp = new XMLHttpRequest();
    // Construct the URL for the PHP function with the form values as parameters
    var url = "j2sJDpUgQQmLF5EF/addbanque";
    xhttp.open("GET", url, true);
    xhttp.send();
}

function uploadDisplay() {
    var popup = document.getElementById('upload-image');
    popup.style.display = 'grid';
};

//===============================================================================================================================

function MAJBanque() {
    Upload();
    sendData_bank();
    updatebanque(); // show the pop-up
    return false;
};
function updatebanque() {
    const confirmed = confirm("Are you sure you want to save data?");
    if (confirmed) {
        var xhttp = new XMLHttpRequest();
        // Construct the URL for the PHP function with the form values as parameters
        var url = "j2sJDpUgQQmLF5EF/update";
        var content = document.getElementById('feedback_place');
        // var url ="j2sJDpUgQQmLF5EF/update/1/Banque%20Ext%C3%A9rieure%20d'Alg%C3%A9rie/BEA/C%3A%5Cfakepath%5Cleft.svg/48%2C%20Rue%20des%20Fr%C3%A8res%20Bouadou%2C%20Bir%20Mourad%20Ra%C3%AFs%20-%20Alger/021%2056%2025%2070%20/021%2056%2030%2050%20%2F%2056%2051%2054/https%3A%2F%2Fwww.google.com%2Fmaps%2Fd%2Fu%2F0%2Fembed%3Fmid%3D1SVoCi0deGeTdAOY9SvH8TAHijD4iZo8%26ehbc%3D2E312F%26z%3D12/https%3A%2F%2Fwww.bea.dz%2F" ;
        console.log(url);
        xhttp.open("GET", url, true);
        xhttp.onload = function () {
            if (this.status == 200) {
                console.log('Uploaded successfully');
                content.innerHTML = this.responseText;
            }
        };
        xhttp.send();
    }
}
function sendData_pres() {
    var xhr = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/updateprestation";
    var formData = new FormData(document.getElementById("updateprestation"));
    xhr.open("POST", url, true);
    xhr.send(formData);
}
function sendData_bank() {
    var xhr = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/update";
    var formData = new FormData(document.getElementById("update"));
    for (var pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }
    xhr.open("POST", url, true);
    xhr.send(formData);
    console.log('data sent');
}
function affichage(data) {
    var popup = document.getElementById("popup");
    popup.style.display = "block";
    body.style.overflowY = 'hidden';
    document.getElementById("updatepres").addEventListener("submit", function (event) {
        event.preventDefault();
        var xhttp = new XMLHttpRequest();
        //  ($id,$nom,$categorie,$prix,$date,$description)
        var url = "j2sJDpUgQQmLF5EF/updateprestation/" + data + "/" + encodeURIComponent(document.getElementById("nompres").value) + "/" + encodeURIComponent(document.getElementById("categoriepres").value) + "/" + encodeURIComponent(document.getElementById("prixpres").value) + "/" + encodeURIComponent(document.getElementById("datevaleur").value) + "/" + encodeURIComponent(document.getElementById("description").value);
        console.log(url);
        xhttp.open("GET", url, true);
        var error = document.getElementById("error");
        xhttp.onload = function () {
            if (this.status == 200) {
                error.innerHTML = this.responseText;
            }
        }
        xhttp.send();
        //closePopup() ;
        return false;
    });
}
function updateprestation(data) {
    var xhttp = new XMLHttpRequest();
    // Construct the URL for the PHP function with the form values as parameters
    var url = "j2sJDpUgQQmLF5EF/updateprestation/" + data;
    console.log(url);
    xhttp.open("GET", url, true);
    var error = document.getElementById("error");
    xhttp.onload = function () {
        if (this.status == 200) {
            error.innerHTML = this.responseText;
        }
    }
    xhttp.send();
}
function closePopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
}

