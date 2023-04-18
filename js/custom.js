var body = document.body;
var bankCards = document.querySelectorAll('.bank-card');

bankCards.forEach(bankCard => {

  var viewButton = bankCard.querySelector('.view-button');
  var moreInfo = bankCard.querySelector('.more-info');
  var isPaused = false ;


  bankCard.addEventListener('click', function () {
    if (isPaused) return ;
    if (moreInfo.style.display === 'none' || moreInfo.style.display === "") {
      moreInfo.style.display = 'block';
      moreInfo.style.animation = 'fade-in 1s';
      viewButton.innerHTML = 'Voir Moins';
    } else {
      moreInfo.style.animation = 'fade-out 1s';
      setTimeout(function () { moreInfo.style.display = 'none'; viewButton.innerHTML = 'Voir Plus'; }, 800);
    }

  });
  viewButton.addEventListener('click', function () {
    if (moreInfo.style.display === 'none' || moreInfo.style.display === "") {
      moreInfo.style.display = 'block';
      moreInfo.style.animation = 'fade-in 1s';
      viewButton.innerHTML = 'Voir Moins';
    } else {
      moreInfo.style.animation = 'fade-out 1s';
      setTimeout(function () { moreInfo.style.display = 'none'; viewButton.innerHTML = 'Voir Plus'; }, 800);
    }

  });

  viewButton.addEventListener('mouseover', function () {
    isPaused = true;
    setTimeout(function () { isPaused = false; }, 1000);
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



/*const carouselContainer = document.querySelector('.carousel-container');
const prevButton = document.querySelector('.prev-button');
const nextButton = document.querySelector('.next-button');
const carouselItems = document.querySelectorAll('.carousel-item');
const dots = document.querySelectorAll('.dot');
const itemWidth = carouselItems[0].offsetWidth;

let currentIndex = 0;

function moveCarousel() {
  carouselContainer.style.transform = `translateX(-${itemWidth * currentIndex}px)`;
  updateDots();
}

function handlePrevButtonClick() {
  if (currentIndex === 0) {
    currentIndex = carouselItems.length - 1;
  } else {
    currentIndex--;
  }
  moveCarousel();
}

function handleNextButtonClick() {
  if (currentIndex === carouselItems.length - 1) {
    currentIndex = 0;
  } else {
    currentIndex++;
  }
  moveCarousel();
}

function handleDotClick(event) {
  const dotIndex = [...dots].indexOf(event.target);
  if (dotIndex !== currentIndex) {
    currentIndex = dotIndex;
    moveCarousel();
  }
}

function updateDots() {
  dots.forEach((dot, index) => {
    if (index === currentIndex) {
      dot.classList.add('active');
    } else {
      dot.classList.remove('active');
    }
  });
}

prevButton.addEventListener('click', handlePrevButtonClick);

nextButton.addEventListener('click', handleNextButtonClick);*/