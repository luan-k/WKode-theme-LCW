const carousel = document.querySelector(".carousel");
const carouselWrapper = document.querySelector(".carousel-wrapper");

const leftArrow = document.querySelector(".left-arrow");
const rightArrow = document.querySelector(".right-arrow");

let currentIndex = 0;
let prevIndex;
const images = document.querySelectorAll(".carousel-image");

const totalImages = Object.keys(images).length;

// Use this in your project, if you're doing it locally
const imageWidth = images[1].getBoundingClientRect().x;
let fuckimage;
fuckimage = imageWidth - 10;
carouselWrapper.style.transform = `translateX(-${fuckimage}px)`;

// Detect screen size
const screenWidth = window.innerWidth;

// Check if screen width is greater than or equal to 1024 pixels
if (screenWidth <= 340) {
  // Do something for screens larger than or equal to 1024 pixels

  fuckimage = imageWidth;
  carouselWrapper.style.transform = `translateX(-${fuckimage}px)`;
} else if (screenWidth <= 1200) {
  // Do something for screens smaller than 1024 pixels
  fuckimage = imageWidth - 40;
  carouselWrapper.style.transform = `translateX(-${fuckimage}px)`;
} else if (screenWidth <= 1600) {
  // Do something for screens smaller than 1024 pixels
  fuckimage = imageWidth + 40;
  carouselWrapper.style.transform = `translateX(-${fuckimage}px)`;
}

//const imageWidth = 333;
console.log("getbounding1", images[1].getBoundingClientRect());
/* carousel.insertBefore(images[6], carousel.firstChild); */

leftArrow.addEventListener("click", () => {
  prevIndex = currentIndex;
  currentIndex = (currentIndex - 1 + totalImages) % totalImages;
  carousel.style.transform = `translateX(-${imageWidth}px)`;
  carousel.insertBefore(images[currentIndex], carousel.firstChild);

  setTimeout(() => {
    carousel.style.transform = "";
    carousel.classList.add("sliding-transition");
  }, 10);

  setTimeout(() => {
    carousel.classList.remove("sliding-transition");
  }, 490);
});

rightArrow.addEventListener("click", () => {
  prevIndex = currentIndex;
  currentIndex = (currentIndex + 1) % totalImages;
  carousel.style.transform = `translateX(${imageWidth}px)`;
  carousel.appendChild(images[prevIndex]);

  setTimeout(() => {
    carousel.style.transform = "";
    carousel.classList.add("sliding-transition");
  }, 10);

  setTimeout(() => {
    carousel.classList.remove("sliding-transition");
  }, 490);
});
