import "../styles/main.scss";
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
import "./header/header-scroll-logic";

import "./pages/single-new-bikes";
import "./pages/single-new-bikes-accordion";
import "./pages/single-modal-logic";

import Search from "./components/Search";
import "./components/new-card";
import { newCardColorLogic } from "./components/new-card";

const search = new Search();

import $ from "jquery";

// Define variables and get all categories
let termsArray = [];
let listOfCategories = $(".cat-list_item");
let typeOfElement = {};

// Iterate over the categories to determine the type of element and the type of click event
listOfCategories.each(function () {
  let category = $(this);
  if (category.is("input")) {
    typeOfElement = {
      isAnArray: true,
      typeOfClick: "change",
      complete: "",
    };
  }
  if (category.is("div")) {
    typeOfElement = {
      isAnArray: false,
      typeOfClick: "click",
      complete: newCardColorLogic,
    };
  }
});

// Helper function to handle adding the "category--current" class
function newBikesCurrentSelection(currentClickedItem) {
  $(".category--current").removeClass("category--current");
  currentClickedItem.addClass("category--current");
}

// Event handler for the click/change event on the categories
listOfCategories.on(typeOfElement.typeOfClick, function () {
  let currentClickedCheckbox = $(this);
  termsArray = currentClickedCheckbox.data("slug");

  // Check if the "remove-filters" category is clicked
  if (currentClickedCheckbox.hasClass("remove-filters")) {
    termsArray = []; // Clear the termsArray
    newBikesCurrentSelection(currentClickedCheckbox); // Update the current selection UI
  } else {
    if (typeOfElement.isAnArray) {
      // Handle checkbox-type categories
      if (currentClickedCheckbox.is(":checked")) {
        termsArray.push(currentClickedCheckbox.data("slug")); // Add the slug to the termsArray
      } else {
        let index = termsArray.indexOf(slug);
        if (index !== -1) {
          termsArray.splice(index, 1); // Remove the slug from the termsArray
        }
      }
    } else {
      // Handle non-checkbox-type categories
      newBikesCurrentSelection(currentClickedCheckbox); // Update the current selection UI
    }
  }

  // Perform an AJAX request to update the project tiles
  $.ajax({
    type: "POST",
    url: "/wp-admin/admin-ajax.php",
    dataType: "json",
    data: {
      action: "filter_projects",
      category: termsArray,
    },
    success: function (res) {
      $(".project-tiles").html(res.html);
    },
    complete: typeOfElement.complete,
  });
});
