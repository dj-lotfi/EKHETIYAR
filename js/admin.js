window.onload = function () {
    console.log('Load ' + localStorage.getItem("lastvisitedelement"));
    var lastelem = localStorage.getItem("lastvisitedelement");
    if (lastelem == null) localStorage.setItem("lastvisitedelement", "bank1");
    document.getElementById(lastelem).click();
}

var navItems = document.querySelectorAll('.nav-item');

navItems.forEach(navItem => {
    var expnaderButton = navItem.querySelector('p');
    var expander = navItem.querySelector('.item-list__container');

    expnaderButton.onclick = () => {
        // Remove the "expanded" class from all "item-list__container" elements
        navItems.forEach(item => {
            var container = item.querySelector('.item-list__container');
            if (container && container !== expander) {
                container.classList.remove('expanded');
            }
        });

        // Toggle the "expanded" class only on the clicked "item-list__container" element
        if (expander) {
            expander.classList.toggle('expanded');
        }
    };
});

function Upload() {
    var fd = new FormData();
    var path = 'app/logos/';

    var files = $('#file')[0].files;

    // Check file selected or not
    if (files.length > 0) {

        fd.append('file', files[0]);
        fd.append('path', path);

        $.ajax({
            url: 'j2sJDpUgQQmLF5EF/Upload',
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
};

function ModifApropos() {
    var loadingScreen = document.getElementById('loader');
    var content = document.getElementById('modification');
    var modifSpace = document.querySelector('.modifying-window');

    modifSpace.style.display = "grid";
    content.style.display = "none";
    loadingScreen.style.display = "block";
    var xhttp = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/ModifApropos";
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
}

function AjoutBanque() {
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

}

function SupprimBanque(bankId) {
    const confirmed = confirm("Are you sure you want to delete this bank?");
    if (confirmed) {
        var xhttp = new XMLHttpRequest();
        var url = "j2sJDpUgQQmLF5EF/DeleteBank/" + bankId;
        console.log(url);
        xhttp.open("GET", url, true);
        xhttp.onload = function () {
            if (this.status == 200) {
                console.log('Banque ' + bankId + ' supprime');
            }
        };
        xhttp.send();
        location.reload();
    }
};

function closeWarning() {
    var err = document.getElementById("warning");
    err.style.display = "none";
};

function closeUpload() {
    var err = document.getElementById("upload-image");
    err.style.display = "none";
};


function ajoutSubmitted() {
    UploadnewbqLogo();
    console.log('uploaded');
    sendData_newbank();
    addbanque(); // show the pop-up
    //location.reload();
    //return false;
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
        location.reload();
    }
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
function affichage() {
    var popup = document.getElementById("popup");
    popup.style.display = "block";
    body.style.overflowY = 'hidden';
}

function deletepres(id) {
    const confirmed = confirm("Vous etes sur de supprimer cette prestation?");
    if (confirmed) {
        var xhttp = new XMLHttpRequest();
        // Construct the URL for the PHP function with the form values as parameters
        var url = "j2sJDpUgQQmLF5EF/Deleteprestation/" + id;
        xhttp.open("GET", url, true);
        xhttp.send();
        location.reload();
    }

}
function updateprestation(data) {
    var xhttp = new XMLHttpRequest();
    //  ($id,$nom,$categorie,$prix,$date,$description)
    var url = "j2sJDpUgQQmLF5EF/updateprestation/" + data + "/" + encodeURIComponent(document.getElementById("upnompres" + data).value) + "/" + encodeURIComponent(document.getElementById("upcategoriepres" + data).value) + "/" + encodeURIComponent(document.getElementById("upprixpres" + data).value) + "/" + encodeURIComponent(document.getElementById("updatevaleur" + data).value) + "/" + encodeURIComponent(document.getElementById("updescription" + data).value);
    console.log(url);
    xhttp.open("GET", url, true);
    var error = document.getElementById("error");
    xhttp.onload = function () {
        if (this.status == 200) {
            error.innerHTML = this.responseText;
        }
    }
    xhttp.send();
    closePopup();
    location.reload();
}
function closePopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
}
function NewInfoPres() {
    document.getElementById('ajprestation').style.display = 'block';
}
function addpres() {
    var xhttp = new XMLHttpRequest();
    // Construct the URL for the PHP function with the form values as parameters
    var url = "j2sJDpUgQQmLF5EF/addprestation/" + encodeURIComponent(document.getElementById("idbank").value) + "/" + encodeURIComponent(document.getElementById("nompres").value) + "/" + encodeURIComponent(document.getElementById("categoriepres").value) + "/" + encodeURIComponent(document.getElementById("prixpres").value) + "/" + encodeURIComponent(document.getElementById("datevaleur").value) + "/" + encodeURIComponent(document.getElementById("description").value); xhttp.open("GET", url, true);
    xhttp.send();
    closeAjPres();
    location.reload();
}
function closeAjPres() {
    document.getElementById('ajprestation').style.display = 'none';
}

function ModifPub() {
    var loadingScreen = document.getElementById('loader');
    var content = document.getElementById('modification');
    var modifSpace = document.querySelector('.modifying-window');

    modifSpace.style.display = "grid";
    content.style.display = "none";
    loadingScreen.style.display = "block";
    var xhttp = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/ModifPub";
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
}

function AjouterSiteLogo() {
    var fd = new FormData();
    var path = 'img/';

    var files = $('#sitelogo')[0].files;

    // Check file selected or not
    if (files.length > 0) {

        fd.append('file', files[0]);
        fd.append('path', path);
        $.ajax({
            url: 'j2sJDpUgQQmLF5EF/Upload',
            type: 'post',
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 1) {
                    console.log(response.name);
                    location.reload();
                } else {
                    alert('File not uploaded');
                }
            }
        });
    }

}

function UploadnewbqLogo() {
    var fd = new FormData();
    var path = 'app/logos/';

    var files = $('#newbanklogo')[0].files;

    // Check file selected or not
    if (files.length > 0) {

        fd.append('file', files[0]);
        fd.append('path', path);
        $.ajax({
            url: 'j2sJDpUgQQmLF5EF/Upload',
            type: 'post',
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 1) {
                    console.log(response.name);
                    location.reload();
                } else {
                    alert('File not uploaded');
                }
            }
        });
    }

}

function AjouterPub() {
    var fd = new FormData();
    var path = 'img/carousel_images/';

    var files = $('#image')[0].files;

    // Check file selected or not
    if (files.length > 0) {

        fd.append('file', files[0]);
        fd.append('path', path);
        $.ajax({
            url: 'j2sJDpUgQQmLF5EF/Upload',
            type: 'post',
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 1) {
                    console.log(response.name);
                    location.reload();
                } else {
                    alert('File not uploaded');
                }
            }
        });
    }

}

function SupprimerPub() {
    SuppPub();
    getDelresp();
    location.reload();
}

function SuppPub() {
    var xhttp = new XMLHttpRequest();
    // Construct the URL for the PHP function with the form values as parameters
    var url = "j2sJDpUgQQmLF5EF/deleteImage";
    var data = new FormData(document.getElementById("suppub"));
    xhttp.open("POST", url, true);
    xhttp.send(data);
}

function SendApropos() {
    send_info();
    updateApropo();
    return false;
}

function send_info() {
    var xhr = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/updateApropos";
    var formData = new FormData(document.getElementById("updateProposhh"));
    xhr.open("POST", url, true);
    xhr.send(formData);
}
function updateApropo() {
    var xhttp = new XMLHttpRequest();
    // Construct the URL for the PHP function with the form values as parameters
    var url = "j2sJDpUgQQmLF5EF/updateApropos";
    xhttp.open("GET", url, true);
    xhttp.send();
}

function Logout() {
    var xhttp = new XMLHttpRequest();
    // Construct the URL for the PHP function with the form values as parameters
    var url = "j2sJDpUgQQmLF5EF/Logout";
    xhttp.open("GET", url, true);
    xhttp.onload = function () {
        if (this.status == 200) {
            window.location.href = "Accueil";
        }
    }
    xhttp.send();
}

function Modifadmins() {
    var loadingScreen = document.getElementById('loader');
    var content = document.getElementById('modification');
    var modifSpace = document.querySelector('.modifying-window');

    modifSpace.style.display = "grid";
    content.style.display = "none";
    loadingScreen.style.display = "block";
    var xhttp = new XMLHttpRequest();
    var url = "j2sJDpUgQQmLF5EF/Modifadmins";
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
}

function AffEditAdm() {
    var popup = document.getElementById("modifieradminpopup");
    popup.style.display = "block";
}
function closeMdfAdm() {
    var popup = document.getElementById("modifieradminpopup");
    popup.style.display = "none";
}

function EditAdm(id) {
    console.log('here');
    var password1 = document.getElementById("password").value;
    var password2 = document.getElementById("confirmpassword").value;
    var username = document.getElementById("username").value;

    var usernameval = /^[a-zA-Z0-9]+$/;
    var minNumberofChars = 6;
    var maxNumberofChars = 16;
    var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    if (!usernameval.test(username)) {
        alert("Username should not contain any special charecters");
        return false;
    }
    if (username.length < minNumberofChars || username.length > maxNumberofChars) {
        if (username.length < minNumberofChars) alert("username too short");
        else alert("username too long");
        return false;
    }

    if (password1 !== password2) {
        alert("Passwords do not match. Please re-enter.");
        return false;
    }



    if (password1.length < minNumberofChars || password1.length > maxNumberofChars) {
        if (password1.length < minNumberofChars) alert("password too short ");
        else alert("password too long");
        return false;
    }
    if (!regularExpression.test(password1)) {
        alert("password should contain atleast one number and one special character");
        return false;
    }

    var xhttp = new XMLHttpRequest();
    // Construct the URL for the PHP function with the form values as parameters
    var url = "j2sJDpUgQQmLF5EF/ModifAdm/" + id + "/" + username + "/" + password1;
    var content = document.getElementById('errorModifAdm' + id);
    xhttp.open("GET", url, true);
    xhttp.onload = function () {
        if (this.status == 200) {
            content.innerHTML = this.responseText;
            location.reload();
        }
    };
    xhttp.send();
}

function DelAdm(id) {
    const confirmed = confirm('Are you sure to delete this admin ?');
    if (confirmed) {
        var xhttp = new XMLHttpRequest();
        // Construct the URL for the PHP function with the form values as parameters
        var url = "j2sJDpUgQQmLF5EF/SuppAdmin/" + id;
        xhttp.open("GET", url, true);
        xhttp.send();
        location.reload();
    }
}

function AffAddAdmin() {
    var popup = document.getElementById("ajouteradminpopup");
    popup.style.display = "block";
}
function closeAddAdm() {
    var popup = document.getElementById("ajouteradminpopup");
    popup.style.display = "none";
}

function AddAdm() {
    var password1 = document.getElementById("adpassword").value;
    var password2 = document.getElementById("adconfirmpassword").value;
    var username = document.getElementById("adusername").value;

    var usernameval = /^[a-zA-Z0-9]+$/;
    var minNumberofChars = 6;
    var maxNumberofChars = 16;
    var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    if (!usernameval.test(username)) {
        alert("Username should not contain any special charecters");
        return false;
    }
    if (username.length < minNumberofChars || username.length > maxNumberofChars) {
        if (username.length < minNumberofChars) alert("username too short");
        else alert("username too long");
        return false;
    }

    if (password1 !== password2) {
        alert("Passwords do not match. Please re-enter.");
        return false;
    }



    if (password1.length < minNumberofChars || password1.length > maxNumberofChars) {
        if (password1.length < minNumberofChars) alert("password too short ");
        else alert("password too long");
        return false;
    }
    if (!regularExpression.test(password1)) {
        alert("password should contain atleast one number and one special character");
        return false;
    }

    var xhttp = new XMLHttpRequest();
    // Construct the URL for the PHP function with the form values as parameters
    var url = "j2sJDpUgQQmLF5EF/AjouterAdm/" + username + "/" + password1;
    var content = document.getElementById('errorAjoutAdm');
    xhttp.open("GET", url, true);
    xhttp.onload = function () {
        if (this.status == 200) {
            content.innerHTML = this.responseText;
            location.reload();
        }
    };
    xhttp.send();

}