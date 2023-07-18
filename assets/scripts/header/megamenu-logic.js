window.addEventListener("load", () => {
  let h_menu = document.querySelector("#wkode-header__megamenu-btn");
  let menu = document.querySelector(
    ".wkode-header--mobile .wkode-header__nav--bottom"
  );
  let mobile_header = document.querySelector("header.wkode-header--mobile");
  let body = document.querySelector("body");

  h_menu.addEventListener("click", (event) => {
    event.preventDefault();

    menu.classList.toggle("wkode-header__nav--active");
    body.classList.toggle("body-megamenu-active");
  });

  document.addEventListener("click", (event) => {
    if (
      !mobile_header.contains(event.target) &&
      body.classList.contains("body-megamenu-active")
    ) {
      menu.classList.toggle("wkode-header__nav--active");
      body.classList.toggle("body-megamenu-active");
    }
  });

  let mobile_menu_ul = document.querySelectorAll(
    ".wkode-header--mobile .wkode-header__nav--bottom .wkode-header__menu-container .nav .menu-item-has-children"
  );

  let mobile_mega_opener = document.querySelectorAll(
    ".wkode-header--mobile .wkode-header__nav--bottom > .wkode-header__menu-container > .nav > .menu-item-has-children"
  );

  for (let i = 0; i < mobile_menu_ul.length; i++) {
    let item = mobile_menu_ul[i];

    item.children[0].addEventListener("click", (e) => {
      e.preventDefault();
      openItem(item);
    });
  }

  for (let i = 0; i < mobile_mega_opener.length; i++) {
    let item = mobile_menu_ul[i];

    item.children[0].addEventListener("click", (e) => {
      e.preventDefault();
      openItem(item, true);
    });
  }

  function openItem(item, isFirstLevel = false) {
    if (isFirstLevel) {
      megamenuHasOpened()
        ? menu.classList.add("full")
        : menu.classList.remove("full");
    } else {
      item.classList.toggle("opened");
    }
  }
  //- Checks if the mobile megamenu has any first level navs opened
  function megamenuHasOpened() {
    let hasOpened = false;

    mobile_mega_opener.forEach((listItem) => {
      if (listItem.classList.contains("opened")) hasOpened = true;
    });

    return hasOpened;
  }
});
