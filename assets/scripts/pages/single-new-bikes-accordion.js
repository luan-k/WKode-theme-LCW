document.addEventListener("DOMContentLoaded", function () {
  const accordionTitles = document.querySelectorAll(".accordion-title");

  accordionTitles.forEach(function (title) {
    title.addEventListener("click", function () {
      let accordionItem = this.closest(".accordion-item");

      // Check if the clicked item is already active
      let isActive = accordionItem.classList.contains("active");

      // Remove "active" class from all accordion items
      let allAccordionItems = document.querySelectorAll(".accordion-item");
      allAccordionItems.forEach(function (item) {
        item.classList.remove("active");
      });

      // Add "active" class only if the clicked item was not already active
      if (!isActive) {
        accordionItem.classList.add("active");
      }
    });
  });
});
