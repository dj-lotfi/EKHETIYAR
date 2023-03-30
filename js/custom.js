const carouselContainer = document.querySelector('.carousel-container');
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

nextButton.addEventListener('click', handleNextButtonClick);