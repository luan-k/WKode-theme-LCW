import $ from "jquery";

$(document).ready(function () {
  // Accordion for Marcas filter
  $(".title-taxonomy").each(function () {
    let title = $(this);
    let catList = title.siblings(".cat-list");
    let arrow = title.find(".title-taxonomy-arrow");
    let hasCheckedInputs = catList.find("input:checked").length > 0;
    let hasValueInputs =
      catList.find("input[type='text']").filter(function () {
        return this.value !== "";
      }).length > 0;

    if (hasCheckedInputs || hasValueInputs) {
      title.addClass("active");
      catList.show();
      arrow.addClass("down");
    } else {
      catList.hide();
    }

    title.click(function () {
      title.toggleClass("active");
      catList.slideToggle();
      arrow.toggleClass("down");
    });
  });
});

if (window.innerWidth < 1000) {
  if ($("#open-filters")) {
    $("#open-filters").click(function (event) {
      event.preventDefault();
      event.stopPropagation();
      if (!$("body").hasClass("modal-open")) {
        $("#cats-wrapper").css("transform", "translateY(0%)");
        $("body").addClass("modal-open");
      } else {
        $("#cats-wrapper").css("transform", "translateY(100%)");
        $("body").removeClass("modal-open");
      }
    });

    // Hide the modal when the user clicks outside of it
    $(document).click(function (event) {
      let target = $(event.target);
      if (!target.closest("#cats-wrapper").length) {
        $("#cats-wrapper").css("transform", "translateY(100%)");
        $("body").removeClass("modal-open");
      }
    });
    $(".close-mobile-filters, .title-filters").click(function (event) {
      event.preventDefault();
      let target = $(event.target);
      $("#cats-wrapper").css("transform", "translateY(100%)");
      $("body").removeClass("modal-open");
    });
  }
}
