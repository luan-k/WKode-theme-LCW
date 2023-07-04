import $ from "jquery";
import { newCardColorLogic } from "../components/new-card";

// Define variables and get all categories
let filterTiles = $(".filter-tiles");

if (filterTiles) {
  let clickableElements = $(".taxonomies-list_item, #load-more");
  let termsArray = [];
  let typeOfElement = {};
  let currentPage = 1;

  // Iterate over the categories to determine the type of element and the type of click event
  clickableElements.each(function () {
    let category = $(this);
    if (category.hasClass("taxonomies-list_item")) {
      if (category.is("input")) {
        typeOfElement = {
          isAnArray: true,
          complete: "",
        };
      }
      if (category.is("div")) {
        typeOfElement = {
          isAnArray: false,
          complete: newCardColorLogic,
        };
      }
    }
  });

  // Event handler for the click/change event on the categories
  clickableElements.on("click", function (event) {
    let currentClick = $(this);
    event.preventDefault();

    if (currentClick.hasClass("wkode-btn")) {
      currentPage++;
    }

    if (currentClick.hasClass("taxonomies-list_item")) {
      currentPage = 1;
      if (currentClick.hasClass("remove-filters")) {
        // Check if the "remove-filters" category is clicked
        termsArray = []; // Clear the termsArray
        newBikesCurrentSelection(currentClick); // Update the current selection UI
        updateURL("/motos-novas/"); // Clear the filter URL
      } else {
        if (typeOfElement.isAnArray) {
          // Handle checkbox-type categories
          if (currentClick.is(":checked")) {
            termsArray.push(currentClick.data("slug")); // Add the slug to the termsArray
          } else {
            let index = termsArray.indexOf(slug);
            if (index !== -1) {
              termsArray.splice(index, 1); // Remove the slug from the termsArray
            }
          }
        } else {
          // Handle non-checkbox-type categories
          newBikesCurrentSelection(currentClick); // Update the current selection UI
          termsArray = currentClick.data("slug");
          updateURL("/motos-novas/?filtro=" + termsArray); // Update the filter URL
        }
      }
    }
    console.log(currentPage);
    // Perform an AJAX request to update the project tiles
    $.ajax(ajaxObj(termsArray, currentPage, currentClick));
  });

  // Helper function to handle adding the "category--current" class
  function newBikesCurrentSelection(currentClickedItem) {
    $(".category--current").removeClass("category--current");
    currentClickedItem.addClass("category--current");
  }
  // Function to update the URL using pushState
  function updateURL(url) {
    window.history.pushState(null, "", url);
  }

  function ajaxObj(categoryTerms, currentPageNumber, currentClick) {
    return {
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      dataType: "json",
      data: {
        action: "filter_posts",
        category: categoryTerms,
        currentPage: currentPageNumber,
      },
      success: function (res) {
        if (currentPageNumber >= res.max) {
          $("#load-more").hide();
        } else {
          $("#load-more").show();
        }
        renderType(currentClick, res);
      },
      complete: typeOfElement.complete,
    };
  }

  function isThisClickLoadMore(click, page) {
    if (click.hasClass("wkode-btn")) {
      return page + 1;
    }
    return page;
  }

  function renderType(typeOfClick, render) {
    if (typeOfClick.hasClass("taxonomies-list_item")) {
      filterTiles.html(render.html);
    }
    if (typeOfClick.hasClass("wkode-btn")) {
      filterTiles.append(render.html);
    }
  }
}
