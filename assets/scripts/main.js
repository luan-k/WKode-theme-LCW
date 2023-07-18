import "../styles/main.scss";
import "../../node_modules/@fancyapps/ui/dist/fancybox/fancybox.css";

import "./base/for-admin";

/* import "./base/scroll-entrance"; */
import "../slick/slick.min.js";
import "./config/product-slider";
import "./config/fancybox";

import "./blocks/slides-single-new-bikes";
import "./blocks/slider";
//import "./blocks/new-bikes-block";

import "./header/navbar-line";
import "./header/add-btn-and-divider";
import "./header/megamenu-logic";
import "./header/header-scroll-logic";

import "./pages/single-new-bikes";
import "./pages/single-new-bikes-accordion";
import "./pages/single-modal-logic";
import "./pages/archive-filter-accordion-and-mobile-logic";

import Search from "./components/Search";
import "./components/new-card";
import "./components/input-numbers-formatter";

import "./filter/filter";
import "./filter/filter-multiple";
import "./filter/filter-product";

const search = new Search();

jQuery(document).ready(function ($) {
  // Get all the title elements and content containers
  const titles = $(".wkode-single-new-bikes-template__bikes-colors-main-title");
  const contentContainers = $(
    ".wkode-single-new-bikes-template__bikes-colors-wrapper"
  );

  // Add click event listener to each title
  titles.on("click", function () {
    const clickedIndex = $(this).index();

    // Hide all content containers
    contentContainers.removeClass("model-wrapper-container--active");

    // Show the corresponding content container
    contentContainers
      .eq(clickedIndex)
      .addClass("model-wrapper-container--active");

    // Remove active class from all titles
    titles.removeClass("colors-title-active");

    // Add active class to the clicked title
    $(this).addClass("colors-title-active");
  });
});
