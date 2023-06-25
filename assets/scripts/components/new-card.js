// Get all card elements
let cards = document.getElementsByClassName("wkode-new-bikes__card");

if (!cards.length > 0) {
  cards = document.getElementsByClassName(
    "wkode-single-new-bikes-template__bikes-colors"
  );
}

// Iterate over each card
for (let i = 0; i < cards.length; i++) {
  let card = cards[i];

  // Get color span elements within the current card
  let colorSpans = card.getElementsByClassName("wkode-new-bikes__card-color");

  // Get image elements within the current card
  let imageElements = card.getElementsByClassName("wkode-new-bikes__card-img");

  // Add click event listener to each color span within the current card
  for (let j = 0; j < colorSpans.length; j++) {
    colorSpans[j].addEventListener(
      "click",
      createColorClickListener(colorSpans, imageElements, j)
    );
  }
}

// Function to create a click event listener for a specific color span
function createColorClickListener(colorSpans, imageElements, index) {
  return function () {
    // Remove the active class from all color spans
    for (let k = 0; k < colorSpans.length; k++) {
      colorSpans[k].classList.remove("active-color");
    }

    // Add the active class to the clicked color span
    colorSpans[index].classList.add("active-color");

    // Show the corresponding image based on the color index
    for (let l = 0; l < imageElements.length; l++) {
      if (l === index) {
        imageElements[l].classList.add("active-color-image");
      } else {
        imageElements[l].classList.remove("active-color-image");
      }
    }
  };
}
