window.addEventListener("load", () => {
  let h_menu = document.querySelector("#wkode-header__megamenu-btn");
  let menu = document.querySelector(
    ".wkode-header--mobile .wkode-header__nav--bottom"
  );
  let body = document.querySelector("body");

  h_menu.addEventListener("click", (event) => {
    event.preventDefault();

    menu.classList.toggle("wkode-header__nav--active");
    body.classList.toggle("body-megamenu-active");
  });

  let mobile_menu_ul = document.querySelectorAll(
    ".wkode-header--mobile .wkode-header__nav--bottom .wkode-header__menu-container .nav .menu-item-has-children"
  );

  for (let i = 0; i < mobile_menu_ul.length; i++) {
    let item = mobile_menu_ul[i];

    item.children[0].addEventListener("click", (e) => {
      e.preventDefault();
      openItem(item);
    });
  }

  function openItem(item) {
    item.classList.toggle("opened");
    verifyIfOpened(menu)
      ? menuOpenedAddClass(menu)
      : menuOpenedRemoveClass(menu);
  }

  function verifyIfOpened(menu) {
    //- If menu is opened & is on first level
    return menu.getElementsByClassName("opened").length > 0;
  }

  function menuOpenedAddClass(menu) {
    if (!menu.classList.contains("full")) menu.classList.add("full");
  }

  function menuOpenedRemoveClass(menu) {
    if (menu.classList.contains("full")) menu.classList.remove("full");
  }
});
