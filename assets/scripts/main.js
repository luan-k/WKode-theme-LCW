import "../styles/main.scss";

import "./base/scroll-entrance";

import "./blocks/slider";

import "./header/navbar-line";
import "./header/add-btn-and-divider";
import "./header/megamenu-logic";

import Search from "./components/Search";

var search = new Search();
window.addEventListener("load", () => {
  let bruh = document.querySelector("#wkode-header__megamenu-btn");
  let menu = document.querySelector(".wkode-header__nav--bottom");

  console.log(menu);

  console.log(bruh);
  bruh.addEventListener("click", (event) => {
    event.preventDefault();
    menu.classList.add("wkode-header__nav--active");
    menu.classList.add("class1", "class2", "class3");
    console.log("click!!");
    console.log(menu);
  });
});
