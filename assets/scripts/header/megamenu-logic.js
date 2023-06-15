window.addEventListener("load", () => {
  let bruh = document.querySelector("#wkode-header__megamenu-btn");
  let menu = document.querySelector(
    ".wkode-header--mobile .wkode-header__nav--bottom"
  );
  let body = document.querySelector("body");

  console.log(body);

  console.log(bruh);
  bruh.addEventListener("click", (event) => {
    event.preventDefault();

    menu.classList.toggle("wkode-header__nav--active");
    body.classList.toggle("body-megamenu-active");
    console.log("click!!");
    console.log(menu);
  });
});
