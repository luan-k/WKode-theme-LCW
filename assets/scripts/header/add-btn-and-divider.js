window.addEventListener("load", () => {
  let allParents = document.getElementsByClassName("menu-item-has-children");

  let aTag;
  let correctUrl;
  let ulTag;

  for (let i = 0; i < allParents.length; i++) {
    aTag = allParents[i].querySelector("a");
    correctUrl = aTag.getAttribute("href");

    ulTag = allParents[i].querySelector(".sub-menu > ul");

    ulTag.innerHTML += `<div class="wkode-megamenu-separator"> </div><li class="menu-item"><a href="${correctUrl}">Ver Todas</a></li>`;
  }
});
