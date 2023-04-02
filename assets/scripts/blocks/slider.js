//checking if its mobile or not
const ThereIsMobile = document.querySelector(".there-is-mobile");
const sliderContainer = document.getElementById("wkode-slider-container");
const sliderContainerMobile = document.getElementById(
  "wkode-slider-container-mobile"
);
let screenWidth = window.innerWidth;

if (ThereIsMobile) {
  if (screenWidth <= 1080) {
    if (sliderContainer) {
      sliderContainer.remove();
    }
  } else {
    if (sliderContainerMobile) {
      sliderContainerMobile.remove();
    }
  }
}

window.addEventListener("load", () => {
  const slider = document.querySelector(".wkode-slider");
  const slides = document.querySelectorAll(".wkode-slider-slide");
  const prevBtn = document.querySelector(".wkode-slider-prev");
  const nextBtn = document.querySelector(".wkode-slider-next");
  const dots = document.querySelector(".wkode-slider-dots");

  let currentSlide = 0;
  let interval = setInterval(nextSlide, 5000);

  /* function createDots() {
    for (let i = 0; i < slides.length; i++) {
      const dot = document.createElement("div");
      const dotProgressBar = document.createElement("div");
      dotProgressBar.classList.add("wkode-slider-progress-bar");
      dot.classList.add("wkode-slider-dot");
      dots.appendChild(dot);
      dot.appendChild(dotProgressBar);
      if (i === 0) {
        dot.classList.add("active");
      }
      dot.addEventListener("click", () => {
        currentSlide = i;
        clearInterval(interval);
        setSlide();
        interval = setInterval(nextSlide, 5000);
        resetProgressBar();
        startProgressBar();
      });
    }
  } */
  function createDots() {
    for (let i = 0; i < slides.length; i++) {
      const dot = document.createElement("div");
      dot.classList.add("wkode-slider-dot");
      dots.appendChild(dot);
      const dotProgressBar = document.createElement("div");
      dotProgressBar.classList.add("wkode-slider-progress-bar");
      dot.appendChild(dotProgressBar);
      if (i === 0) {
        dot.classList.add("active");
      }
      dot.addEventListener("click", () => {
        currentSlide = i;
        clearInterval(interval);
        setSlide();
        interval = setInterval(nextSlide, 5000);
        resetProgressBar();
        startProgressBar();
      });
    }
  }

  let touchStartX = 0;
  let touchEndX = 0;

  // Add touch event listeners to the slider
  slider.addEventListener("touchstart", (event) => {
    touchStartX = event.touches[0].clientX;
  });

  slider.addEventListener("touchmove", (event) => {
    touchEndX = event.touches[0].clientX;
  });

  slider.addEventListener("touchend", (event) => {
    if (touchEndX < touchStartX) {
      // Swipe left
      currentSlide++;
      if (currentSlide >= slides.length) {
        currentSlide = 0;
      }
    } else if (touchEndX > touchStartX) {
      // Swipe right
      currentSlide--;
      if (currentSlide < 0) {
        currentSlide = slides.length - 1;
      }
    }

    // Update the slider position
    setSlide();

    // Reset touch start and end positions
    touchStartX = 0;
    touchEndX = 0;

    // Reset and start the progress bar
    resetProgressBar();
    startProgressBar();
  });

  let currentProgressBar;
  function setSlide() {
    slider.style.transform = `translateX(${-currentSlide * 100}%)`;
    slides.forEach((slide) => {
      slide.classList.remove("active");
    });
    slides[currentSlide].classList.add("active");
    dots.querySelectorAll(".wkode-slider-dot").forEach((dot) => {
      dot.classList.remove("active");
    });
    dots
      .querySelectorAll(".wkode-slider-dot")
      [currentSlide].classList.add("active");
    const newProgressBar = document.querySelectorAll(
      ".wkode-slider-progress-bar"
    );
    currentProgressBar = newProgressBar[currentSlide];
  }

  function nextSlide() {
    currentSlide++;
    if (currentSlide >= slides.length) {
      currentSlide = 0;
    }
    setSlide();
    resetProgressBar();
    startProgressBar();
  }

  function prevSlide() {
    currentSlide--;
    if (currentSlide < 0) {
      currentSlide = slides.length - 1;
    }
    setSlide();
    resetProgressBar();
    startProgressBar();
  }

  createDots();
  setSlide();
  const progressBar = document.querySelector(".wkode-slider-progress-bar");
  startProgressBar();

  prevBtn.addEventListener("click", () => {
    clearInterval(interval);
    prevSlide();
    interval = setInterval(nextSlide, 5000);
    resetProgressBar();
    startProgressBar();
  });

  nextBtn.addEventListener("click", () => {
    clearInterval(interval);
    nextSlide();
    interval = setInterval(nextSlide, 5000);
    resetProgressBar();
    startProgressBar();
  });

  function startProgressBar() {
    currentProgressBar.style.width = "100%";
    currentProgressBar.style.transition = "width 4.5s linear";
  }

  function resetProgressBar() {
    currentProgressBar.style.width = "0";
    currentProgressBar.style.transition = "none";
  }

  slider.addEventListener("mouseover", () => {
    clearInterval(interval);
    resetProgressBar();
  });

  slider.addEventListener("mouseleave", () => {
    interval = setInterval(nextSlide, 5000);
    startProgressBar();
  });

  slider.addEventListener("transitionstart", () => {
    progressBar.style.transition = "width 4.5s linear";
    resetProgressBar();
  });

  slider.addEventListener("transitionend", () => {
    progressBar.style.transition = "none";
    startProgressBar();
  });
});
