import "../styles/main.scss";
import { Fancybox } from "@fancyapps/ui";
import "../../node_modules/@fancyapps/ui/dist/fancybox/fancybox.css";

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

import "./pages/single-new-bikes";

import Search from "./components/Search";
import "./components/new-card";

import jQuery from "jquery";

const search = new Search();

document.addEventListener("DOMContentLoaded", function () {
  const accordionTitles = document.querySelectorAll(".accordion-title");

  accordionTitles.forEach(function (title) {
    title.addEventListener("click", function () {
      let accordionItem = this.closest(".accordion-item");

      // Check if the clicked item is already active
      let isActive = accordionItem.classList.contains("active");

      // Remove "active" class from all accordion items
      let allAccordionItems = document.querySelectorAll(".accordion-item");
      allAccordionItems.forEach(function (item) {
        item.classList.remove("active");
      });

      // Add "active" class only if the clicked item was not already active
      if (!isActive) {
        accordionItem.classList.add("active");
      }
    });
  });
});
