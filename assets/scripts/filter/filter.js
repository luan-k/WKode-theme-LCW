import $ from "jquery";
import { newCardColorLogic } from "../components/new-card";

// this code works with a div filter, and a filter with only one
// taxonomy with checkboxes. unfortunately the complexity grew while the time is short

// Define variables and get all categories
let filterTiles = $(".filter-tiles");
const uniqueFilterTiles = document.getElementById("filter-tiles");

if (uniqueFilterTiles) {
  if (filterTiles) {
    let clickableElements = $(".taxonomies-list_item, #load-more");
    let templatePath = filterTiles.attr("template-path");
    let postType = filterTiles.attr("post-type");
    let taxonomy = filterTiles.attr("taxonomy");
    let minimumPriceInput = $(".taxonomy-number-field--min-value");
    let maximumPriceInput = $(".taxonomy-number-field--max-value");
    let childClass;
    let termsArray = [];
    let modelsArray = [];
    let stylesArray = [];
    let minimumPriceValue = "";
    let maximumPriceValue = "";
    let typeOfElement = {};
    let currentPage = 1;
    const currentPath = window.location.pathname;
    const parts = currentPath.split("/");
    const currentUrl = `/${parts[1]}/`; // Retrieves the "/motos-novas/" part

    const currentHref = window.location.href;
    let filterValue = null;
    let arrayToSubstitute = [];

    $(document).ready(function () {
      minimumPriceInput.on({
        input: function () {
          minimumPriceValue = $(this)
            .val()
            .replace(/[^0-9]/g, ""); // Remove non-numeric characters
        },
      });
      maximumPriceInput.on({
        input: function () {
          maximumPriceValue = $(this)
            .val()
            .replace(/[^0-9]/g, ""); // Remove non-numeric characters
        },
      });
    });

    if (currentHref.includes("?filtro=")) {
      const queryString = currentHref.split("?");
      queryString.forEach((element) => {
        if (element.includes("filtro=")) {
          const replaced = element.replace("filtro=", "");
          arrayToSubstitute.push(replaced);
        }
        if (element.includes("arg=")) {
          const replaced = element.replace("arg=", "");
          arrayToSubstitute.push(replaced);
        }
        if (element.includes("taxbrand=")) {
          const replaced = element.replace("taxbrand=", "");
          arrayToSubstitute.push(replaced);
        }
        if (element.includes("taxmodel=")) {
          const replaced = element.replace("taxmodel=", "");
          arrayToSubstitute.push(replaced);
        }
        if (element.includes("taxstyle=")) {
          const replaced = element.replace("taxstyle=", "");
          arrayToSubstitute.push(replaced);
        }
        if (element.includes("minprice=")) {
          const replaced = element.replace("minprice=", "");
          minimumPriceValue = replaced;
        }
        if (element.includes("maxprice=")) {
          const replaced = element.replace("maxprice=", "");
          maximumPriceValue = replaced;
        }
      });
      // Normalize legacy short form like ?filtro=adventure to the new format ?filtro=?taxbrand=adventure
      const hasKnownKeys =
        currentHref.includes("taxbrand=") ||
        currentHref.includes("taxmodel=") ||
        currentHref.includes("taxstyle=") ||
        currentHref.includes("minprice=") ||
        currentHref.includes("maxprice=");
      if (!hasKnownKeys) {
        const match = currentHref.match(/\?filtro=([^&]+)/);
        if (match && match[1]) {
          const legacyVal = decodeURIComponent(match[1]);
          const newUrl = `${currentUrl}?filtro=?taxbrand=${legacyVal}`;
          updateURL(newUrl);
        }
      }
    }

    // Iterate over the categories to determine the type of element and the type of click event
    clickableElements.each(function () {
      let category = $(this);
      if (category.hasClass("taxonomies-list_item") && category.is("input")) {
        // Pre-select arrays based on URL when inputs are rendered as checked
        if (category.attr("checked")) {
          if (category.hasClass("taxonomies-list_item--brand")) {
            arrayToSubstitute.forEach(function (currentSub) {
              if (category.data("slug") === currentSub) {
                termsArray.push(currentSub);
              }
            });
          }
          if (category.hasClass("taxonomies-list_item--models")) {
            arrayToSubstitute.forEach(function (currentSub) {
              if (category.data("slug") === currentSub) {
                modelsArray.push(currentSub);
              }
            });
          }
          if (category.hasClass("taxonomies-list_item--styles")) {
            arrayToSubstitute.forEach(function (currentSub) {
              if (category.data("slug") === currentSub) {
                stylesArray.push(currentSub);
              }
            });
          }
        }
      }
    });

    let inputTimer;
    minimumPriceInput.on("input", (event) => {
      clearTimeout(inputTimer); // Clear previous timer if it exists

      // Set a new timer to make the AJAX request after 1 second
      inputTimer = setTimeout(() => {
        let theUrl = window.location.href;
        $.ajax(
          ajaxObj(
            termsArray,
            modelsArray,
            stylesArray,
            currentPage,
            null,
            minimumPriceValue,
            maximumPriceValue
          )
        );
        updateUrlArr(
          currentUrl + "?filtro=",
          termsArray,
          modelsArray,
          stylesArray,
          minimumPriceValue,
          maximumPriceValue
        );
      }, 1500);
    });
    maximumPriceInput.on("input", (event) => {
      clearTimeout(inputTimer); // Clear previous timer if it exists

      // Set a new timer to make the AJAX request after 1 second
      inputTimer = setTimeout(() => {
        let theUrl = window.location.href;
        $.ajax(
          ajaxObj(
            termsArray,
            modelsArray,
            stylesArray,
            currentPage,
            null,
            minimumPriceValue,
            maximumPriceValue
          )
        );
        updateUrlArr(
          currentUrl + "?filtro=",
          termsArray,
          modelsArray,
          stylesArray,
          minimumPriceValue,
          maximumPriceValue
        );
      }, 1500);
    });

    // Dedicated change handler for checkbox inputs
    $("input.taxonomies-list_item").on("change", function (event) {
      let currentClick = $(this);
      let slug = currentClick.data("slug");
      currentPage = 1;

      if (currentClick.is(":checked")) {
        if (currentClick.hasClass("taxonomies-list_item--brand")) {
          if (!termsArray.includes(slug)) termsArray.push(slug);
        }
        if (currentClick.hasClass("taxonomies-list_item--models")) {
          if (!modelsArray.includes(slug)) modelsArray.push(slug);
        }
        if (currentClick.hasClass("taxonomies-list_item--styles")) {
          if (!stylesArray.includes(slug)) stylesArray.push(slug);
        }
      } else {
        if (currentClick.hasClass("taxonomies-list_item--brand")) {
          let index = termsArray.indexOf(slug);
          if (index !== -1) termsArray.splice(index, 1);
        }
        if (currentClick.hasClass("taxonomies-list_item--models")) {
          let index = modelsArray.indexOf(slug);
          if (index !== -1) modelsArray.splice(index, 1);
        }
        if (currentClick.hasClass("taxonomies-list_item--styles")) {
          let index = stylesArray.indexOf(slug);
          if (index !== -1) stylesArray.splice(index, 1);
        }
      }

      // Update URL and fetch results
      updateUrlArr(
        currentUrl + "?filtro=",
        termsArray,
        modelsArray,
        stylesArray,
        minimumPriceValue,
        maximumPriceValue
      );

      $.ajax(
        ajaxObj(
          termsArray,
          modelsArray,
          stylesArray,
          currentPage,
          currentClick,
          minimumPriceValue,
          maximumPriceValue
        )
      );
    });

    // Event handler for clicks on non-input elements (e.g., remove filters, load more)
    clickableElements.on("click", function (event) {
      let currentClick = $(this);
      let slug = currentClick.data("slug");

      if (currentClick.hasClass("load-more-unique")) {
        currentPage++;
        event.preventDefault();
        $.ajax(
          ajaxObj(
            termsArray,
            modelsArray,
            stylesArray,
            currentPage,
            currentClick,
            minimumPriceValue,
            maximumPriceValue
          )
        );
        return;
      }

      if (currentClick.hasClass("taxonomies-list_item")) {
        currentPage = 1;
        if (currentClick.hasClass("remove-filters")) {
          // Check if the "remove-filters" category is clicked
          termsArray = []; // Clear the termsArray
          modelsArray = [];
          stylesArray = [];
          minimumPriceValue = "";
          maximumPriceValue = "";
          newBikesCurrentSelection(currentClick); // Update the current selection UI
          updateURL(currentUrl); // Clear the filter URL
          // Uncheck all taxonomy inputs
          $("input.taxonomies-list_item").prop("checked", false);
        } else if (!currentClick.is("input")) {
          // Handle non-checkbox-type categories (tiles)
          newBikesCurrentSelection(currentClick); // Update the current selection UI
          termsArray = [currentClick.data("slug")];
          modelsArray = [];
          stylesArray = [];
          updateUrlArr(
            currentUrl + "?filtro=",
            termsArray,
            modelsArray,
            stylesArray,
            minimumPriceValue,
            maximumPriceValue
          );
        }

        // Perform an AJAX request to update the project tiles
        if (!$(event.target).is("input.taxonomies-list_item")) {
          $.ajax(
            ajaxObj(
              termsArray,
              modelsArray,
              stylesArray,
              currentPage,
              currentClick,
              minimumPriceValue,
              maximumPriceValue
            )
          );
        }
      }
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
    function updateUrlArr(
      url,
      arrayOfElements,
      modelsElements,
      stylesElements,
      minPrice,
      maxPrice
    ) {
      if (arrayOfElements.length > 0) {
        arrayOfElements = "?taxbrand=" + arrayOfElements.join("?arg=");
      }
      if (modelsElements.length > 0) {
        modelsElements = "?taxmodel=" + modelsElements.join("?arg=");
      }
      if (stylesElements.length > 0) {
        stylesElements = "?taxstyle=" + stylesElements.join("?arg=");
      }
      if (minPrice) {
        minPrice = "?minprice=" + minPrice;
      } else {
        minPrice = "";
      }
      if (maxPrice) {
        maxPrice = "?maxprice=" + maxPrice;
      } else {
        maxPrice = "";
      }

      // Check if we have any filters at all
      let hasAnyFilters =
        arrayOfElements.length > 0 ||
        modelsElements.length > 0 ||
        stylesElements.length > 0 ||
        minPrice ||
        maxPrice;

      if (hasAnyFilters) {
        url =
          url +
          arrayOfElements +
          modelsElements +
          stylesElements +
          minPrice +
          maxPrice;
      } else {
        url = currentUrl; // Reset to base URL if no filters
      }

      window.history.pushState(null, "", url);
    }

    function ajaxObj(
      categoryTerms,
      modelTerms,
      styleTerms,
      currentPageNumber,
      currentClick,
      minimumPrice,
      maximumPrice
    ) {
      return {
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        dataType: "json",
        data: {
          action: "filter_posts",
          templatePath,
          postType,
          taxonomy,
          category: categoryTerms,
          models: modelTerms,
          styles: styleTerms,
          currentPage: currentPageNumber,
          minimumPrice,
          maximumPrice,
        },
        beforeSend: loadingStartAnimation,
        success: function (res) {
          if (currentPageNumber >= res.max) {
            $("#load-more").hide();
          } else {
            $("#load-more").show();
          }
          renderType(currentClick, res);
        },
        complete: loadingEndAnimation,
      };
    }

    function isThisClickLoadMore(click, page) {
      if (click.hasClass("wkode-btn")) {
        return page + 1;
      }
      return page;
    }

    function renderType(typeOfClick, render) {
      if (typeOfClick) {
        if (typeOfClick.hasClass("taxonomies-list_item")) {
          filterTiles.html(render.html);
        }
        if (typeOfClick.hasClass("wkode-btn")) {
          filterTiles.append(render.html);
        }
      } else {
        filterTiles.html(render.html);
      }
    }

    function loadingStartAnimation() {
      filterTiles.each(function () {
        childClass = $(this).children().attr("class");
        $(this).children().addClass("skeleton-box");
      });
    }
    function loadingEndAnimation() {
      filterTiles.each(function () {
        childClass = $(this).children().attr("class");
        $(this).children().removeClass("skeleton-box");
      });
    }
  }
}
