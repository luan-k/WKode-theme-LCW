/* let fatherMenu = document.querySelector("#navbarNavAltMarkup");
let hasChildrenMenus = document.querySelectorAll(".menu-item-has-children");
let childMegamenu;

console.log(hasChildrenMenus);

hasChildrenMenus.forEach((childMenu) => {
  console.log(childMenu);
  if (!childMenu.classList.contains("megamenu")) {
    childMenu.addEventListener("mouseover", () => {
      childMegamenu = childMenu.querySelector(".megamenu");
      console.log(childMegamenu);
      childMegamenu.classList.add("megamenu-active");
    });
    childMenu.addEventListener("mouseout", () => {
      childMegamenu.classList.remove("megamenu-active");
    });
  }
});
 */
