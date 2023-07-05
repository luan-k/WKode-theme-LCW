import $ from "jquery";
import { newCardColorLogic } from "../components/new-card";

// Define variables and get all categories
let filterTiles = $(".filter-tiles");

if (filterTiles) {
  let clickableElements = $(".taxonomies-list_item, #load-more");
  let templatePath = filterTiles.attr("template-path");
  let postType = filterTiles.attr("post-type");
  let taxonomy = filterTiles.attr("taxonomy");
  let childClass;
  let termsArray = [];
  let typeOfElement = {};
  let currentPage = 1;
  const currentPath = window.location.pathname;
  const parts = currentPath.split("/");
  const currentUrl = `/${parts[1]}/`; // Retrieves the "/motos-novas/" part

  const currentHref = window.location.href;
  let filterValue = null;
  let arrayToSubstitute = [];

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
    });
  }

  // Iterate over the categories to determine the type of element and the type of click event
  clickableElements.each(function () {
    let category = $(this);
    if (category.hasClass("taxonomies-list_item")) {
      if (category.is("input")) {
        typeOfElement = {
          isAnArray: true,
          complete: "",
        };
        if (category.attr("checked")) {
          arrayToSubstitute.forEach(function (currentSub) {
            if (category.data("slug") === currentSub) {
              termsArray.push(currentSub);
            }
          });
        }
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
    let slug = currentClick.data("slug");

    if (currentClick.hasClass("wkode-btn")) {
      currentPage++;
      event.preventDefault();
    }

    if (currentClick.hasClass("taxonomies-list_item")) {
      currentPage = 1;
      if (currentClick.hasClass("remove-filters")) {
        // Check if the "remove-filters" category is clicked
        termsArray = []; // Clear the termsArray
        newBikesCurrentSelection(currentClick); // Update the current selection UI
        updateURL(currentUrl); // Clear the filter URL
        if (typeOfElement.isAnArray) {
          clickableElements.each(function () {
            let category = $(this);
            category.prop("checked", false);
          });
        }
      } else {
        if (typeOfElement.isAnArray) {
          // Handle checkbox-type categories
          if (currentClick.is(":checked")) {
            termsArray.push(currentClick.data("slug")); // Add the slug to the termsArray
            updateUrlArr(currentUrl + "?filtro=", termsArray);
          } else {
            // this is if unchecking the checkbox, super long due to href conditionals. see a way to shorten it later.
            let clickHref = window.location.href;
            let currentQueryString = clickHref.split("?");
            console.log(currentQueryString);
            console.log(
              "this is the one !!!!!!!!!!!!!! ============= " + clickHref
            );

            if (clickHref.includes(slug)) {
              let removedUrlClick;
              if (clickHref.includes("?arg=" + slug)) {
                removedUrlClick = clickHref.replace("?arg=" + slug, "");
                console.log(
                  "this is the one !!!!!!!!!!!!!! ============= " +
                    removedUrlClick
                );
                updateURL(removedUrlClick);
              } else if (clickHref.includes("?filtro=" + slug)) {
                if (clickHref.includes(slug + "?arg=")) {
                  removedUrlClick = clickHref.replace(slug + "?arg=", "");
                  console.log(
                    "this is the one !!!!!!!!!!!!!! ============= " +
                      removedUrlClick
                  );
                  updateURL(removedUrlClick);
                } else {
                  removedUrlClick = clickHref.replace("?filtro=" + slug, "");
                  console.log(
                    "this is the one !!!!!!!!!!!!!! ============= " +
                      removedUrlClick
                  );
                  updateURL(removedUrlClick);
                }
              } else {
                removedUrlClick = clickHref.replace(slug, "");
                console.log(
                  "this is the one !!!!!!!!!!!!!! ============= " +
                    removedUrlClick
                );
                updateURL(removedUrlClick);
              }

              /* if (clickHref.includes("?arg=")) {
                removedUrlClick = clickHref.replace("?arg=", "");
                console.log(
                  "this is the one !!!!!!!!!!!!!! ============= " +
                    removedUrlClick
                );
              } */
            }

            let index = termsArray.indexOf(slug);
            if (index !== -1) {
              termsArray.splice(index, 1); // Remove the slug from the termsArray
            }
          }
        } else {
          // Handle non-checkbox-type categories
          newBikesCurrentSelection(currentClick); // Update the current selection UI
          termsArray = currentClick.data("slug");
          updateURL(currentUrl + "?filtro=" + termsArray); // Update the filter URL
        }
      }
    }
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
  function updateUrlArr(url, arrayOfElements) {
    url = url + arrayOfElements.join("?arg=");
    window.history.pushState(null, "", url);
  }

  function ajaxObj(categoryTerms, currentPageNumber, currentClick) {
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
        currentPage: currentPageNumber,
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

  function loadingStartAnimation() {
    filterTiles.each(function () {
      childClass = $(this).children().attr("class");
      $(this).children().addClass("skeleton-box");
    });
  }
}
