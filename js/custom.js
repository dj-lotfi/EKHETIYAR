var body = document.body;
var bankCards = document.querySelectorAll('.bank-card');

bankCards.forEach(bankCard => {

  var viewButton = bankCard.querySelector('.view-button');
  var moreInfo = bankCard.querySelector('.more-info');


  bankCard.addEventListener('click', function () {
    if (moreInfo.style.display === 'none' || moreInfo.style.display === "") {
      moreInfo.style.display = 'block';
      moreInfo.style.animation = 'fade-in 1s';
      viewButton.innerHTML = 'Voir Moins';
    } else {
      moreInfo.style.animation = 'fade-out 1s';
      setTimeout(function () { moreInfo.style.display = 'none'; viewButton.innerHTML = 'Voir Plus'; }, 800);
    }

  });
});

var banksPrestations = document.querySelectorAll('.bank-card__container');


banksPrestations.forEach(bankPrestations => {
  var prestationsButton = bankPrestations.querySelector('.prestations-button__handler');
  var modal = bankPrestations.querySelector('.modal');
  var closeButton = bankPrestations.querySelector('.close');
  var prestationsContent = bankPrestations.querySelector('.prestations-content');
  var bankId = prestationsButton.getAttribute('data-id');
  var loadingScreen = bankPrestations.querySelector('.loader');
  var xhr;

  var cached = 0;

  prestationsButton.addEventListener('click', () => {
    modal.style.display = "block";
    body.style.overflowY = 'hidden';
    if (cached == 0) {
      loadingScreen.style.display = "block"; // show the loading screen
      cached = 1;

      // Send AJAX request
      xhr = new XMLHttpRequest();
      xhr.open('GET', 'Prestations?id=' + bankId, true);
      xhr.onload = function () {
        if (this.status == 200) {
          loadingScreen.style.display = "none";
          prestationsContent.innerHTML = this.responseText;
          modal.style.display = "block";
          body.style.overflowY = 'hidden'; /* Hide scrollbar and remove scrolling functionality*/
        }
      };
      xhr.send();
    }


  });

  closeButton.addEventListener('click', () => {
    if (xhr) {
      xhr.abort(); // abort the AJAX request
    }
    modal.style.display = "none";
    body.style.overflowY = 'overlay'; /* Show scrollbar*/
  });

  modal.addEventListener('click', (click) => {
    if (click.target == modal) {
      modal.style.display = "none";
      body.style.overflowY = 'overlay'; /* Show scrollbar*/
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const filterSubcategories = document.querySelectorAll('.filters-subcategory');

  const firstOccurence = filterSubcategories[0].querySelector('dd');
  firstOccurence.style.display = 'block';

  filterSubcategories.forEach(function (filterSubcategory) {
    const Subcategory = filterSubcategory.querySelector('dt');
    Subcategory.addEventListener('click', function () {
      const dd = filterSubcategory.querySelector('dd');
      if (dd.style.display === 'block') {
        dd.style.display = 'none';
        dd.style.opacity = 0;
      } else {
        dd.style.display = 'block';
        dd.style.opacity = 1;
      }
    });
  });
});

// Get all the scrollable-checkboxes UL elements
const scrollableCheckboxes = document.querySelectorAll('.scrollable-checkboxes');

// Loop through each UL element
scrollableCheckboxes.forEach(function(checkboxList) {
  // Get all the checkboxes in this UL element
  const checkboxes = checkboxList.querySelectorAll('input[type="checkbox"]');

  // Get the first checkbox in this UL element
  const firstCheckbox = checkboxList.querySelector('input[type="checkbox"]:first-child');

  // Add an event listener to each checkbox
  checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
      if (this.checked) {
        if (this === firstCheckbox) {
          checkboxes.forEach(function(otherCheckbox) {
            if (otherCheckbox !== checkbox) {
              otherCheckbox.checked = false;
            }
          });
        } else {
          firstCheckbox.checked = false;
        }
      }
    });
  });
});

const minMaxContainers = document.querySelectorAll('.temp');

minMaxContainers.forEach(function(minMaxContainer) {
  const inputedText = minMaxContainer.querySelectorAll('input[type="text"]');
  
  inputedText.forEach(function(text) {
    text.addEventListener('input', function() {
      this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');
    });
  });
});