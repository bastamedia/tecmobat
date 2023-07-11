/**
 *START MOBILE MENU
 */
const mobileToggle = document.getElementById("mobile-toggle");
const mobileMenu = document.getElementById("mobile-menu");

mobileToggle.addEventListener("click", () => {
  if (mobileMenu.classList.contains("invisible")) {
    console.log("open");
    mobileMenu.classList.remove("invisible");
  } else {
    console.log("close");
    mobileMenu.classList.add("invisible");
  }
});
/**
 *END MOBILE MENU
 */

const navbar = document.getElementById("navbar");

window.addEventListener("scroll", () => {
  if (window.scrollY > 0) {
    navbar.classList.add("bg-white");
  } else {
    navbar.classList.remove("bg-white");
  }
});
