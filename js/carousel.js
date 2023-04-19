const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const slider = document.querySelector('.slider');
const sliderContainer = document.querySelector('.slider-container');
const dotsContainer = document.getElementById('dots');
let currentPosition = 0;

let slideShow = setInterval(goToNextSlide, 3000); // Interval in milliseconds (3 seconds)

// Create dots based on number of images
const images = slider.querySelectorAll('img');
const maxIndex = images.length;
for (let i = 0; i < images.length; i++) {
    const dot = document.createElement('div');
    dot.className = 'slider-dot';
    dot.addEventListener('click', () => {
        clearInterval(slideShow);
        currentPosition = -i * sliderContainer.offsetWidth;
        slider.style.transform = `translateX(${currentPosition}px)`;
        activateDot(i);
        slideShow = setInterval(goToNextSlide, 3000);
    });
    dotsContainer.appendChild(dot);
}
activateDot(0); // Set the first dot as active

// Function to go to the next slide
function goToNextSlide() {
    currentPosition -= sliderContainer.offsetWidth;
    if (currentPosition < -sliderContainer.offsetWidth * (slider.children.length - 1)) {
        currentPosition = 0;
    }
    slider.style.transform = `translateX(${currentPosition}px)`;
    updateActiveDot();

}

// Function to activate the dot for the currently displayed image
function activateDot(index) {
    const dots = document.querySelectorAll('.slider-dot');
    dots.forEach((dot, i) => {
        if (i === index) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

// Function to update the active dot based on the current position of the slider
function updateActiveDot() {
    const dots = document.querySelectorAll('.slider-dot');
    const index = Math.abs(currentPosition / sliderContainer.offsetWidth);
    activateDot(index);
}

// Event listener for previous button
prevBtn.addEventListener('click', () => {
    clearInterval(slideShow);
    currentPosition += sliderContainer.offsetWidth;
    if (currentPosition > 0) {
        currentPosition = -sliderContainer.offsetWidth * (slider.children.length - 1);
    }
    slider.style.transform = `translateX(${currentPosition}px)`;
    updateActiveDot();
    slideShow = setInterval(goToNextSlide, 3000);
});

// Event listener for next button
nextBtn.addEventListener('click', () => {
    clearInterval(slideShow);
    goToNextSlide();
    slideShow = setInterval(goToNextSlide, 3000);
});
