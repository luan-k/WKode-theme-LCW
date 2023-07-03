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

let termsArray = [];
console.log(termsArray);
$(".cat-list_item").on("change", function () {
  let currentClickedCheckbox = $(this);
  let slug = currentClickedCheckbox.data("slug");

  if (currentClickedCheckbox.is(":checked")) {
    console.log("chekc");
    termsArray.push(currentClickedCheckbox.data("slug"));
  } else {
    console.log("nah");
    let index = termsArray.indexOf(slug);
    if (index !== -1) {
      termsArray.splice(index, 1);
    }
  }

  console.log(termsArray);

  $.ajax({
    type: "POST",
    url: "/wp-admin/admin-ajax.php",
    dataType: "json",
    data: {
      action: "filter_projects",
      category: termsArray,
    },
    success: function (res) {
      console.log(res);
      console.log(res.html);
      $(".project-tiles").html(res.html);
    },
    complete: newCardColorLogic,
  });
});
