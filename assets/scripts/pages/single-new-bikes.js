if (window.innerWidth <= 1000) {
  let newTrigger = document.getElementById("wkode-header__single-new-trigger");

  if (newTrigger) {
    newTrigger.addEventListener("click", function () {
      const hiddenElement = document.getElementById(
        "wkode-single-new-bikes-template__form"
      );
      hiddenElement.classList.toggle(
        "wkode-single-new-bikes-template__form--hidden"
      );
      const arrow = document.querySelector(
        ".wkode-header__single-new-trigger__arrow"
      );
      arrow.classList.toggle(
        "wkode-header__single-new-trigger__arrow--inverted"
      );

      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });
  }
  window.addEventListener("load", function () {
    setTimeout(function () {
      const hiddenElement = document.getElementById(
        "wkode-single-new-bikes-template__form"
      );
      const titleHighlight = document.querySelector(
        ".wkode-header__single-new-trigger__title"
      );
      const arrow = document.querySelector(
        ".wkode-header__single-new-trigger__arrow"
      );
      if (arrow && titleHighlight && arrow) {
        titleHighlight.classList.add("text-lcw-primary-red");
        arrow.classList.add(
          "wkode-header__single-new-trigger__arrow--inverted"
        );
        setTimeout(function () {
          titleHighlight.classList.remove("text-lcw-primary-red");
          arrow.classList.remove(
            "wkode-header__single-new-trigger__arrow--inverted"
          );
        }, 1000);
        hiddenElement.classList.add(
          "wkode-single-new-bikes-template__form--hidden"
        );
      }
    }, 3000);
  });
}
