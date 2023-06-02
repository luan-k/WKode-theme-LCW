import "../styles/main.scss";

/* import "./base/scroll-entrance"; */

import "./blocks/slider";

import "./header/navbar-line";
import "./header/add-btn-and-divider";
import "./header/megamenu-logic";

import Search from "./components/Search";

var search = new Search();
window.addEventListener("load", () => {
  let bruh = document.querySelector("#wkode-header__megamenu-btn");
  let menu = document.querySelector(
    ".wkode-header--mobile .wkode-header__nav--bottom"
  );
  let body = document.querySelector("body");

  console.log(body);

  console.log(bruh);
  bruh.addEventListener("click", (event) => {
    event.preventDefault();

    menu.classList.toggle("wkode-header__nav--active");
    body.classList.toggle("body-megamenu-active");
    console.log("click!!");
    console.log(menu);
  });

  // Get all card elements
  var cards = document.getElementsByClassName("wkode-new-bikes__card");

  // Iterate over each card
  for (var i = 0; i < cards.length; i++) {
    var card = cards[i];

    // Get color span elements within the current card
    var colorSpans = card.getElementsByClassName("wkode-new-bikes__card-color");

    // Get image elements within the current card
    var imageElements = card.getElementsByClassName(
      "wkode-new-bikes__card-img"
    );

    // Add click event listener to each color span within the current card
    for (var j = 0; j < colorSpans.length; j++) {
      colorSpans[j].addEventListener(
        "click",
        createColorClickListener(colorSpans, imageElements, j)
      );
    }
  }

  // Function to create a click event listener for a specific color span
  function createColorClickListener(colorSpans, imageElements, index) {
    return function () {
      // Remove the active class from all color spans
      for (var k = 0; k < colorSpans.length; k++) {
        colorSpans[k].classList.remove("active-color");
      }

      // Add the active class to the clicked color span
      colorSpans[index].classList.add("active-color");

      // Show the corresponding image based on the color index
      for (var l = 0; l < imageElements.length; l++) {
        if (l === index) {
          imageElements[l].classList.add("active-color-image");
        } else {
          imageElements[l].classList.remove("active-color-image");
        }
      }
    };
  }
});

const state = {};
const carouselItems = document.querySelectorAll(".wkode-carousel__item");
const elems = Array.from(carouselItems);
const prevBtn = document.querySelector(".wkode-carousel__arrow_prev");
const nextBtn = document.querySelector(".wkode-carousel__arrow_next");

prevBtn.addEventListener("click", function () {
  const current = elems.find((elem) => elem.dataset.pos == 0);
  const prev = elems.find((elem) => elem.dataset.pos == -1);

  if (!prev) {
    return;
  }

  update(prev);
});

nextBtn.addEventListener("click", function () {
  const current = elems.find((elem) => elem.dataset.pos == 0);
  const next = elems.find((elem) => elem.dataset.pos == 1);

  if (!next) {
    return;
  }

  update(next);
});

carouselItems.forEach((item) => {
  item.addEventListener("click", function (event) {
    const newActive = this;
    const isItem = newActive.classList.contains("wkode-carousel__item");

    if (
      !isItem ||
      newActive.classList.contains("wkode-carousel__item_active")
    ) {
      return;
    }

    update(newActive);
  });
});

const update = function (newActive) {
  const newActivePos = parseInt(newActive.dataset.pos);

  elems.forEach((item) => {
    const itemPos = parseInt(item.dataset.pos);
    item.dataset.pos = getPos(itemPos, newActivePos);
  });

  newActive.classList.add("wkode-carousel__item_active");
};

const getPos = function (current, active) {
  const diff = current - active;

  if (Math.abs(diff) > 3) {
    return -current;
  }

  return diff;
};
