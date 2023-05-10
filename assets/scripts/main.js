import "../styles/main.scss";
import "./base/scroll-entrance";
import "./blocks/slider";
import "./components/header";

import Search from "./components/Search";

var search = new Search();

window.addEventListener("load", () => {
  let allParents = document.getElementsByClassName("menu-item-has-children");

  console.log(allParents);

  let aTag;
  let correctUrl;
  let ulTag;

  for (let i = 0; i < allParents.length; i++) {
    console.log(i);
    aTag = allParents[i].querySelector("a");
    console.log(aTag);
    correctUrl = aTag.getAttribute("href");
    console.log(correctUrl);

    ulTag = allParents[i].querySelector(".sub-menu > ul");
    console.log(ulTag);

    ulTag.innerHTML += `<div class="wkode-megamenu-separator"> </div><li class="menu-item"><a href="${correctUrl}">Ver Todas</a></li>`;
  }
});
