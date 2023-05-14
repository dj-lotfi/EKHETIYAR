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

const categoryCheckboxes = document.querySelectorAll('.checkboxes');

// Loop through each UL element
categoryCheckboxes.forEach(function (checkboxList) {
  // Get all the checkboxes in this UL element
  const checkboxes = checkboxList.querySelectorAll('input[type="checkbox"]');

  // Get the first checkbox in this UL element
  const firstCheckbox = checkboxList.querySelector('input[type="checkbox"]:first-child');

  // Add an event listener to each checkbox
  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      if (this.checked) {
        if (this === firstCheckbox) {
          checkboxes.forEach(function (otherCheckbox) {
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

const minMaxContainers = document.querySelectorAll('.tarifs-interval');

minMaxContainers.forEach(function(minMaxContainer) {
  const inputedText = minMaxContainer.querySelectorAll('input[type="text"]');
  
  inputedText.forEach(function(text) {
    text.addEventListener('input', function() {
      this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
    });
  });
});

