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

  // Get all color span elements
  var colorSpans = document.getElementsByClassName(
    "wkode-new-bikes__card-color"
  );

  // Get all image elements
  var imageElements = document.getElementsByClassName(
    "wkode-new-bikes__card-img"
  );

  // Add click event listener to each color span
  for (var i = 0; i < colorSpans.length; i++) {
    colorSpans[i].addEventListener("click", function () {
      // Remove the active class from all color spans
      for (var j = 0; j < colorSpans.length; j++) {
        colorSpans[j].classList.remove("active-color");
      }

      // Add the active class to the clicked color span
      this.classList.add("active-color");

      // Get the index of the clicked color span
      var colorIndex = Array.prototype.indexOf.call(colorSpans, this);

      // Show the corresponding image based on the color index
      for (var k = 0; k < imageElements.length; k++) {
        if (k === colorIndex) {
          imageElements[k].classList.add("active-color-image");
        } else {
          imageElements[k].classList.remove("active-color-image");
        }
      }
    });
  }
});
