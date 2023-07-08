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

import "./filter/filter";
import "./filter/filter-multiple";

const search = new Search();

import $ from "jquery";

$(document).ready(function () {
  // Accordion for Marcas filter
  $(".title-taxonomy").each(function () {
    var $title = $(this);
    var $catList = $title.siblings(".cat-list");
    var $arrow = $title.find(".title-taxonomy-arrow");
    if ($catList.find("input:checked").length > 0) {
      $title.addClass("active");
      $catList.show();
      $arrow.addClass("down");
    } else {
      $catList.hide();
    }
    $title.click(function () {
      $title.toggleClass("active");
      $catList.slideToggle();
      $arrow.toggleClass("down");
    });
  });
});

if (window.innerWidth < 1000) {
  if ($("#open-filters")) {
    $("#open-filters").click(function (event) {
      event.preventDefault();
      event.stopPropagation();
      if (!$("body").hasClass("modal-open")) {
        $("#cats-wrapper").css("transform", "translateY(0%)");
        $("body").addClass("modal-open");
      } else {
        $("#cats-wrapper").css("transform", "translateY(100%)");
        $("body").removeClass("modal-open");
      }
    });

    // Hide the modal when the user clicks outside of it
    $(document).click(function (event) {
      let target = $(event.target);
      if (!target.closest("#cats-wrapper").length) {
        $("#cats-wrapper").css("transform", "translateY(100%)");
        $("body").removeClass("modal-open");
      }
    });
    $(".close-mobile-filters, .title-filters").click(function (event) {
      event.preventDefault();
      let target = $(event.target);
      $("#cats-wrapper").css("transform", "translateY(100%)");
      $("body").removeClass("modal-open");
    });
  }
}
