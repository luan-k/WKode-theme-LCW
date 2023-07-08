import { Fancybox } from "@fancyapps/ui";
import "../../../node_modules/@fancyapps/ui/dist/fancybox/fancybox.css";
import { pt } from "@fancyapps/ui/dist/fancybox/l10n/pt.esm.js";

import { Thumbs } from "@fancyapps/ui/dist/carousel/carousel.thumbs.esm.js";
import "@fancyapps/ui/dist/carousel/carousel.thumbs.css";

import { Carousel } from "@fancyapps/ui/dist/carousel/carousel.esm.js";
import "@fancyapps/ui/dist/carousel/carousel.css";

import { Panzoom } from "@fancyapps/ui/dist/panzoom/panzoom.esm.js";
import "@fancyapps/ui/dist/panzoom/panzoom.css";

Fancybox.bind('[data-fancybox="gallery"]', {
  l10n: pt,
});

const container = document.getElementById("myCarousel");

if (container) {
  const options = {
    Dots: false,
    Thumbs: {
      type: "classic",
    },
    Navigation: {
      prevEl: ".custom-prev-button",
      nextEl: ".custom-next-button",
    },
  };

  new Carousel(container, options, { Thumbs });
}

document.addEventListener("DOMContentLoaded", function () {
  const panzoomReference = document.querySelector(
    ".wkode-single-panzoom-reference"
  );
  if (panzoomReference) {
    const pzContainer = panzoomReference.querySelectorAll(".f-carousel__slide");
    const middleIndex = Math.floor(pzContainer.length / 2);
    let navs = document.querySelectorAll(".f-thumbs__slide");
    let instance = [];
    let config = {
      panMode: "mousemove",
      mouseMoveFactor: 1.25,
      click: false,
      wheel: false,
      scaleFactor: 3,
    };

    async function firstChunk() {
      // Code of the first chunk
      // ...
      navs.forEach(function (item, i) {
        if (i === middleIndex) {
          item.click();
        }
      });
      // Return a resolved promise
      return Promise.resolve();
    }

    function secondChunk() {
      // Code of the second chunk
      // ...
      setTimeout(function () {
        pzContainer.forEach(function (item, i) {
          instance[i] = new Panzoom(item, config);
          item.addEventListener("mouseenter", (event) => {
            if (!event.buttons) {
              instance[i].zoomToMax(event);
            }
          });

          item.addEventListener("mouseleave", () => {
            instance[i].zoomToFit();
          });
        });

        navs.forEach(function (item, i) {
          if (i === 0) {
            item.click();
          }
        });
      }, 100);
    }

    // Usage
    (async function () {
      await firstChunk(); // Wait for the first chunk to complete
      // This code will run only after the first chunk has completed
      secondChunk();
    })();
  }
});

Fancybox.bind('[data-fancybox="galleryServices"]', {
  l10n: pt,
});

const servicesContainer = document.getElementById("myServicesCarousel");

if (servicesContainer) {
  const options = {
    Dots: false,
    Thumbs: {
      type: "classic",
    },
    Navigation: {
      prevEl: ".custom-prev-button",
      nextEl: ".custom-next-button",
    },
  };

  new Carousel(servicesContainer, options, { Thumbs });
}
