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
        <div class="p-12" >
              ${
                results.newBikes.length
                  ? '<div class="container pt-32"> <h3 class="uppercase font-rubik font-extrabold text-5xl mb-28"> Motos Novas </h3> <div class="wkode-search-carousel"> '
                  : '<h3 class="font-rubik font-extrabold text-4xl mt-28 capitalize text-center">Nenhuma moto nova corresponde a sua pesquisa</h3>'
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
									</div><div class='flex justify-center search mt-28 px-9 py-6'> <a href="${
                    WKodeData.root_url
                  }/motos-novas" class='wkode-btn wkode-btn--outline-red'> ver todos as Motos Novas</a> </div>
              ${results.newBikes.length ? "</div>" : ""}
          </div>


      </div>
      <div class="p-12" >
              ${
                results.usedBikes.length
                  ? '<div class="container pt-32"> <h3 class="uppercase font-rubik font-extrabold text-5xl mb-28"> Motos Seminovas </h3> <div class="wkode-search-carousel"> '
                  : '<h3 class="font-rubik font-extrabold text-4xl mt-28 capitalize text-center">nenhuma moto seminova corresponde a sua pesquisa</h3>'
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
                  </div><div class='flex justify-center search mt-28 px-9 py-6'> <a href="${
                    WKodeData.root_url
                  }/motos-seminovas" class='wkode-btn wkode-btn--outline-red'> ver todos as Motos Seminovas</a> </div>
              ${results.usedBikes.length ? "</div>" : ""}
          </div>


      </div>
      <div class="p-12" >
              ${
                results.products.length
                  ? '<div class="container pt-32"> <h3 class="uppercase font-rubik font-extrabold text-5xl mb-28"> Produtos </h3> <div class="wkode-search-carousel"> '
                  : '<h3 class="font-rubik font-extrabold text-4xl mt-28 capitalize text-center">Nenhum produto corresponde a sua pesquisa</h3>'
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
                  </div><div class='flex justify-center search mt-28 px-9 py-6'> <a href="${
                    WKodeData.root_url
                  }/produtos" class='wkode-btn wkode-btn--outline-red'> ver todos os Produtos</a> </div>
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
    $("body").addClass("body-no-scroll");
    this.searchField.val("");
    setTimeout(() => this.searchField.focus(), 301);
    return false;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    this.searchOverlay.removeClass("active-bottom ");
    $("body").removeClass("body-no-scroll");
  }

  addSearchHtml() {
    let menuCurrent;
    if (window.innerWidth <= 1000) {
      menuCurrent = $(".wkode-header--mobile > #navbarNavAltMarkup");
    } else {
      menuCurrent = $(".wkode-header--desktop > #navbarNavAltMarkup");
    }
    menuCurrent.append(`
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
