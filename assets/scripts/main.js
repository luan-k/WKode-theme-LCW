import "../styles/main.scss";

/* import "./base/scroll-entrance"; */
import "../slick/slick.min.js";
import "./slick-config/product-slider";

import "./blocks/slider";
//import "./blocks/new-bikes-block";

import "./header/navbar-line";
import "./header/add-btn-and-divider";
import "./header/megamenu-logic";

import "./pages/single-new-bikes";

import Search from "./components/Search";
import "./components/new-card";

import jQuery from "jquery";

const search = new Search();

document.addEventListener("DOMContentLoaded", function () {
  let titlesWrapper = document.getElementsByClassName(
    "wkode-single-new-bikes-template-block__title-wrapper"
  );
  let titles = document.getElementsByClassName(
    "wkode-single-new-bikes-template-block__title"
  );
  let descriptions = document.getElementsByClassName(
    "wkode-single-new-bikes-template-block__text"
  );
  let images = document.getElementsByClassName(
    "wkode-single-new-bikes-template-block__img"
  );

  for (let i = 0; i < titles.length; i++) {
    titles[i].addEventListener("click", function () {
      // Remove the 'active' classes from all titles, descriptions, and images
      for (let j = 0; j < titles.length; j++) {
        titles[j].classList.remove("active-title");
        descriptions[j].classList.remove("active-description");
        images[j].classList.remove("active-image");
      }

      // Add the 'active' classes to the clicked title, description, and image
      this.classList.add("active-title");
      let index = Array.prototype.indexOf.call(titles, this);
      descriptions[index].classList.add("active-description");
      images[index].classList.add("active-image");
    });
  }
});
