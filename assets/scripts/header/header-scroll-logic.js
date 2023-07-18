let prevScrollPos = window.scrollY;
const body = document.querySelector("body");
const threshold = 300; // Adjust this value as needed

const headerDesktop = document.querySelector("header.wkode-header--desktop");
const headerMobile = document.querySelector("header.wkode-header--mobile");
const singleNewBikesCheck = document.querySelector(
  ".wkode-single-new-bikes-template--check"
);
let header = headerDesktop;

if (window.innerWidth <= 1000) {
  header = headerMobile;
}

if (!singleNewBikesCheck) {
  body.style.paddingTop = `${header.offsetHeight}px`;
}
header.classList.add("fixed");

window.addEventListener("scroll", function () {
  const currentScrollPos = window.scrollY;

  if (prevScrollPos > currentScrollPos && currentScrollPos > threshold) {
    // Scrolling Up and below the threshold - show the header
    header.style.transform = `translateY(0)`;
  } else if (prevScrollPos < currentScrollPos && currentScrollPos > threshold) {
    // Scrolling Down and below the threshold - hide the header
    header.style.transform = `translateY(-${header.offsetHeight}px)`;
  }

  prevScrollPos = currentScrollPos;
});
