const menuLine = document.querySelector(".menu-hover-line");
const menuItems = document.querySelectorAll(".menu-item");
const lineWidth = 4;

// Get the initial position of the active menu item
let activeMenuItem = document.querySelector(".current-menu-item");
let activeMenuItemRect = activeMenuItem.getBoundingClientRect();
let initialX = activeMenuItemRect.left - menuLine.offsetLeft;
let initialWidth = activeMenuItem.offsetWidth;

// Set the initial position and width of the line
menuLine.style.transform = `translateX(${initialX}px)`;
menuLine.style.width = `${initialWidth}px`;

// Add transition to the line
menuLine.style.transition = "transform 0.2s ease-out";

function handleMenuItemMouseEnter(event) {
  // Get the position and width of the hovered menu item
  let menuItemRect = event.target.getBoundingClientRect();
  let x = menuItemRect.left - menuLine.offsetLeft;
  let width = menuItemRect.width;

  // Set the position and width of the line
  menuLine.style.transform = `translateX(${x}px)`;
  menuLine.style.width = `${width}px`;
}

// Add mouseenter event listener to each menu item
menuItems.forEach((item) => {
  item.addEventListener("mouseenter", handleMenuItemMouseEnter);
});

// Add mouseleave event listener to menu to move the line back to the active item
menuLine.parentNode.addEventListener("mouseleave", () => {
  menuLine.style.transform = `translateX(${initialX}px)`;
  menuLine.style.width = `${initialWidth}px`;
});
