import $ from "jquery";
import "slick-carousel";
import { newCardColorLogic } from "./new-card";

class Search {
  /* 1. describe and create/initiate our object */
  constructor() {
    this.addSearchHtml();
    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.searchBottom = $("#search-results-bottom");
    this.events();
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
    this.initializeCarousel();
  }
  /*  2. events */
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    /* $(document).on("keyup", this.keyPressDispatcher.bind(this)); */
    this.searchField.on("keyup", this.TypingLogic.bind(this));
  }
  /* 3. methods */
  TypingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);
      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.searchOverlay.addClass("active-bottom ");
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchField.val();
  }

  getResults() {
    $.getJSON(
      WKodeData.root_url +
        "/wp-json/wk/v1/search?term=" +
        this.searchField.val(),
      (results) => {
        this.resultsDiv.html(`
        <div class="" >
              ${
                results.newBikes.length
                  ? '<div class="container"> <h3 class="title-3 mt-5 mb-3 text-black font-montserrat"> NEW </h3> <div class="wkode-search-carousel"> '
                  : '<h3 class="title-4 text-black mt-12 mb-3 text-center font-montserrat">nenhum produto corresponde a sua pesquisa NEW</h3>'
              }
                ${results.newBikes
                  .map(
                    (item) =>
                      `
                      <div class="wkode-new-bikes__card">
                      <h3 class="wkode-new-bikes__card-title">
                          <a href="${item.permalink}">
                              ${item.title}
                          </a>
                      </h3>
                      <a href="${item.permalink}">
                          ${item.images
                            .map(
                              (image, index) => `
                                      <img class="wkode-new-bikes__card-img${image.isActiveColor}" src="${image.src}" alt="" srcset="">
                                  `
                            )
                            .join("")}
                      </a>
                      <div class="wkode-new-bikes__card-colors text-black">
                          ${item.colors
                            .map(
                              (color, index) => `
                                      <span class="wkode-new-bikes__card-color${
                                        color.isActiveColor
                                      }">
                                          ${color.colorStyles
                                            .map(
                                              (style) => `
                                                      <span class="${color.colorClass}" style="${style}"></span>
                                                  `
                                            )
                                            .join("")}
                                      </span>
                                  `
                            )
                            .join("")}
                      </div>
                  </div>
                      `
                  )
                  .join("")}
									</div><div class='btn-wraper justify-center search my-5 px-9 py-6'> <a href="${
                    WKodeData.root_url
                  }/produtos" class='btn-input items-center justify-center py-12 px-12 text-center border-2 border-unitermi-primary-redDark text-black font-montserrat font-bold text-3xl'> ver todos os Produtos </a> </div>
              ${results.newBikes.length ? "</div>" : ""}
          </div>


      </div>
      <div class="" >
              ${
                results.usedBikes.length
                  ? '<div class="container"> <h3 class="title-3 mt-5 mb-3 text-black font-montserrat"> USED </h3> <div class="wkode-search-carousel"> '
                  : '<h3 class="title-4 text-black mt-12 mb-3 text-center font-montserrat">nenhum produto corresponde a sua pesquisa USED</h3>'
              }
                ${results.usedBikes
                  .map(
                    (item) =>
                      `
                      <div class="wkode-used-bikes__card mx-2">
                          <a href="${item.permalink}" class="wkode-used-bikes__card-link">
                              <img class="wkode-used-bikes__card-img" src="${item.image}" alt="imagem produto">
                          </a>
                          <div class="wkode-used-bikes__card-body">
                              <h3 class="wkode-used-bikes__card-title">
                                  <a href="${item.permalink}">
                                      ${item.title}
                                  </a>
                              </h3>
                              <div class="wkode-used-bikes__card-info">
                                <div class="wkode-used-bikes__card-info-date">
                                    <img class="wkode-used-bikes__card-img" src="${item.calendarSvg}" alt="" srcset=""> 
                                    ${item.year}
                                </div>
                                <div class="wkode-used-bikes__card-info-km">
                                    <img class="wkode-used-bikes__card-img" src="${item.kmSvg}" alt="" srcset=""> 
                                    ${item.km}
                                </div>
                              </div>
                          </div>
                          <div class="wkode-used-bikes__card-footer">
                              <div class="wkode-used-bikes__card-footer-price">
                                  ${item.price}
                              </div>
                              <div class="wkode-used-bikes__card-footer-btn">
                                  <a href="${item.permalink}" class="wkode-btn wkode-btn--outline-red">Ver Mais</a>
                              </div>
                          </div>
                      </div>
                      `
                  )
                  .join("")}
									</div><div class='btn-wraper justify-center search my-5 px-9 py-6'> <a href="${
                    WKodeData.root_url
                  }/produtos" class='btn-input items-center justify-center py-12 px-12 text-center border-2 border-unitermi-primary-redDark text-black font-montserrat font-bold text-3xl'> ver todos os Produtos </a> </div>
              ${results.usedBikes.length ? "</div>" : ""}
          </div>


      </div>
      <div class="" >
              ${
                results.products.length
                  ? '<div class="container"> <h3 class="title-3 mt-5 mb-3 text-black font-montserrat"> USED </h3> <div class="wkode-search-carousel"> '
                  : '<h3 class="title-4 text-black mt-12 mb-3 text-center font-montserrat">nenhum produto corresponde a sua pesquisa USED</h3>'
              }
                ${results.products
                  .map(
                    (item) =>
                      `
                      <div class="wkode-products__card">
                          <a href="${item.permalink}">
                              <img class="wkode-products__card-img active-color-image" src="${item.image}" alt="" srcset=""> 
                          </a>
                          <h3 class="wkode-products__card-title ">
                              <a href="${item.permalink}">
                                ${item.title}
                              </a>
                          </h3>
                      </div>
                      
                      `
                  )
                  .join("")}
									</div><div class='btn-wraper justify-center search my-5 px-9 py-6'> <a href="${
                    WKodeData.root_url
                  }/produtos" class='btn-input items-center justify-center py-12 px-12 text-center border-2 border-unitermi-primary-redDark text-black font-montserrat font-bold text-3xl'> ver todos os Produtos </a> </div>
              ${results.products.length ? "</div>" : ""}
          </div>


      </div>
      `);
        this.isSpinnerVisible = false;
        this.initializeCarousel();
        newCardColorLogic();
      }
    );
  }

  initializeCarousel() {
    $(".wkode-search-carousel").slick({
      autoplay: false,
      autoplaySpeed: 2000,
      dots: false,
      infinite: true,
      speed: 500,
      arrows: true,
      prevArrow: `<button class="arrow-button left-arrow" style="background-image: url('../../wp-content/themes/WKode-theme-LCW/assets/img/svg/new-carrousel-left.svg')"></button>`,
      nextArrow: `<button class="arrow-button right-arrow" style="background-image: url('../../wp-content/themes/WKode-theme-LCW/assets/img/svg/new-carrousel-right.svg')"></button>`,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1000,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          },
        },
        {
          breakpoint: 520,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    /* $("body").addClass("body-no-scroll"); */
    this.searchField.val("");
    setTimeout(() => this.searchField.focus(), 301);
    return false;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    this.searchOverlay.removeClass("active-bottom ");
    /* $("body").removeClass("body-no-scroll"); */
  }

  addSearchHtml() {
    $("#navbarNavAltMarkup").append(`
    <div class="search-overlay">
      <div class="search-overlay__top px-6">
        <div class="">
          <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
          <input autocomplete="off" type="text" class="search-term" placeholder="O QUE VOCÊ ESTÁ PROCURANDO?" id="search-term">
          <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
        </div>
      </div>
      <div class="px-9" id="search-results-bottom">
        <div id="search-overlay__results"></div>
      </div>
    </div>
    `);
  }
}

export default Search;
