import $ from "jquery";

// this is the new super configured

// Define variables and get all categories
let filterTiles = $(".filter-product-tiles");
const uniqueFilterTiles = document.getElementById("product-filter-tiles");
console.log("hiiiiii");
if (uniqueFilterTiles) {
  if (filterTiles) {
    console.log("yep");
    let clickableElements = $(".taxonomies-list_item, #load-more");
    let templatePath = filterTiles.attr("template-path");
    let postType = filterTiles.attr("post-type");
    let taxonomy = filterTiles.attr("taxonomy");
    let childClass;
    let termsArray = [];
    let modelsArray = [];
    let stylesArray = [];
    let typeOfElement = {};
    let currentPage = 1;
    const currentUrl = window.location.pathname;

    const currentHref = window.location.href;
    let filterValue = null;
    let arrayToSubstitute = [];

    if (currentHref.includes("?filtro=")) {
      const queryString = currentHref.split("?");
      console.log(queryString);
      queryString.forEach((element) => {
        if (element.includes("filtro=")) {
          const replaced = element.replace("filtro=", "");
          arrayToSubstitute.push(replaced);
        }
        if (element.includes("arg=")) {
          const replaced = element.replace("arg=", "");
          arrayToSubstitute.push(replaced);
        }
        if (element.includes("taxaccess=")) {
          const replaced = element.replace("taxaccess=", "");
          arrayToSubstitute.push(replaced);
        }
        if (element.includes("taxequip=")) {
          const replaced = element.replace("taxequip=", "");
          arrayToSubstitute.push(replaced);
        }
        if (element.includes("taxhelmet=")) {
          const replaced = element.replace("taxhelmet=", "");
          arrayToSubstitute.push(replaced);
        }
      });
    }
    console.log(arrayToSubstitute);

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
      }
    });

    console.log(termsArray);
    console.log(modelsArray);
    console.log(stylesArray);

    // Event handler for the click/change event on the categories
    clickableElements.on("click", function (event) {
      let currentClick = $(this);
      let slug = currentClick.data("slug");

      if (currentClick.hasClass("load-more-unique")) {
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
          // Handle checkbox-type categories
          if (currentClick.is(":checked")) {
            if (currentClick.hasClass("taxonomies-list_item--brand")) {
              termsArray.push(currentClick.data("slug")); // Add the slug to the termsArray
            }
            if (currentClick.hasClass("taxonomies-list_item--models")) {
              modelsArray.push(currentClick.data("slug"));
            }
            if (currentClick.hasClass("taxonomies-list_item--styles")) {
              stylesArray.push(currentClick.data("slug"));
            }

            updateUrlArr(
              currentUrl + "?filtro=",
              termsArray,
              modelsArray,
              stylesArray
            );
          } else {
            // this is if unchecking the checkbox, super long due to href conditionals. see a way to shorten it later.
            let clickHref = window.location.href;
            let currentQueryString = clickHref.split("?");
            console.log(slug);

            if (clickHref.includes(slug)) {
              console.log(termsArray);
              console.log(modelsArray);
              console.log(stylesArray);
              let removedUrlClick;
              if (clickHref.includes("?arg=" + slug)) {
                removedUrlClick = clickHref.replace("?arg=" + slug, "");
                updateURL(removedUrlClick);
              } else if (clickHref.includes("?filtro=" + slug)) {
                if (clickHref.includes(slug + "?arg=")) {
                  removedUrlClick = clickHref.replace(slug + "?arg=", "");
                  updateURL(removedUrlClick);
                } else {
                  removedUrlClick = clickHref.replace("?filtro=" + slug, "");
                  updateURL(removedUrlClick);
                }
              } else {
                removedUrlClick = clickHref.replace(slug, "");
                updateURL(removedUrlClick);
              }
            }

            if (currentClick.hasClass("taxonomies-list_item--brand")) {
              let index = termsArray.indexOf(slug);
              if (index !== -1) {
                termsArray.splice(index, 1); // Remove the slug from the termsArray
              }
            }
            if (currentClick.hasClass("taxonomies-list_item--models")) {
              let index = modelsArray.indexOf(slug);
              if (index !== -1) {
                modelsArray.splice(index, 1); // Remove the slug from the termsArray
              }
            }
            if (currentClick.hasClass("taxonomies-list_item--styles")) {
              let index = stylesArray.indexOf(slug);
              if (index !== -1) {
                stylesArray.splice(index, 1); // Remove the slug from the termsArray
              }
            }
            if (termsArray.length < 1) {
              let newClickHref = window.location.href;
              let replaceUrl = newClickHref.replace("?taxaccess=", "");
              updateURL(replaceUrl);
            }
            if (modelsArray.length < 1) {
              let newClickHref = window.location.href;
              let replaceUrl = newClickHref.replace("?taxequip=", "");
              updateURL(replaceUrl);
            }
            if (stylesArray.length < 1) {
              let newClickHref = window.location.href;
              let replaceUrl = newClickHref.replace("?taxhelmet=", "");
              updateURL(replaceUrl);
            }
            if (
              termsArray.length < 1 &&
              modelsArray.length < 1 &&
              stylesArray.length < 1
            ) {
              let newClickHref = window.location.href;
              let replaceUrl = newClickHref.replace("?filtro=", "");
              updateURL(replaceUrl);
            }
          }
        }
      }
      // Perform an AJAX request to update the project tiles
      $.ajax(
        ajaxObj(termsArray, modelsArray, stylesArray, currentPage, currentClick)
      );
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
      stylesElements
    ) {
      if (arrayOfElements.length > 0) {
        arrayOfElements = "?taxaccess=" + arrayOfElements.join("?arg=");
      }
      if (modelsElements.length > 0) {
        modelsElements = "?taxequip=" + modelsElements.join("?arg=");
      }
      if (stylesElements.length > 0) {
        stylesElements = "?taxhelmet=" + stylesElements.join("?arg=");
      }
      url = url + arrayOfElements + modelsElements + stylesElements;
      window.history.pushState(null, "", url);
    }

    function ajaxObj(
      categoryTerms,
      modelTerms,
      styleTerms,
      currentPageNumber,
      currentClick
    ) {
      return {
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        dataType: "json",
        data: {
          action: "product_filter_posts",
          templatePath,
          postType,
          taxonomy,
          category: categoryTerms,
          models: modelTerms,
          styles: styleTerms,
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
