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

// define variables and get all categories
let termsArray = [];
let listOfCategories = $(".cat-list_item");
let typeOfElement = {};

Array.from(listOfCategories).forEach((category) => {
  if (category.tagName === "INPUT") {
    typeOfElement = {
      isAnArray: true,
      typeOfClick: "change",
      complete: "",
    };
  }
  if (category.tagName === "DIV") {
    typeOfElement = {
      isAnArray: false,
      typeOfClick: "click",
      complete: newCardColorLogic,
    };
  }
});

listOfCategories.on(typeOfElement.typeOfClick, function () {
  let currentClickedCheckbox = $(this);
  termsArray = currentClickedCheckbox.data("slug");

  function newBikesCurrentSelection() {
    $(".category--current").removeClass("category--current");
    currentClickedCheckbox.addClass("category--current");
  }

  if (currentClickedCheckbox.hasClass("remove-filters")) {
    termsArray = [];
    newBikesCurrentSelection();
  } else {
    if (typeOfElement.isAnArray) {
      if (currentClickedCheckbox.is(":checked")) {
        termsArray.push(currentClickedCheckbox.data("slug"));
      } else {
        let index = termsArray.indexOf(slug);
        if (index !== -1) {
          termsArray.splice(index, 1);
        }
      }
    } else {
      newBikesCurrentSelection();
    }
  }

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
