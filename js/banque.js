function loadbanks() {
  var data = new FormData();

  var content = document.getElementById("banks");

  var loadingScreen = document.getElementById('loader');

  if (document.getElementById("Sortasc_desc").checked) {
    data.append("Sortasc_desc", document.getElementById("Sortasc_desc").value);
  } else {
    data.append("Sortasc_desc",'ASC');
  }
  data.append("Sort", document.getElementById("Sort").value);

  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach(function(checkbox) {
    if (checkbox.id != "Sortasc_desc" && checkbox.checked) {
      data.append(checkbox.name,checkbox.value);
      
    }
  });

  const texts = document.querySelectorAll('input[type="text"]');
  texts.forEach(function(text) {
    data.append(text.name,text.value);  
  
  });
  
  


  loadingScreen.style.display = "block";
  content.style.display = "none";


  var xhr = new XMLHttpRequest();
  xhr.open("POST", "Banque/displayAllBanques",true);
  xhr.onload = function() {
    if(this.status === 200) {
      loadingScreen.style.display = "none";
      content.style.display = "block";
      
      content.innerHTML = xhr.responseText;
      
    }
  }
  xhr.send(data);

  

  return false;

}

