const styleSwticher = document.querySelector(".style-switcher");
const styleSwticherToggle = document.querySelector(".style-switcher-toggler");

styleSwticherToggle.addEventListener("click", () => {
  styleSwticher.classList.toggle("open");
});

// Theme Color
const alternateStyle = document.querySelectorAll(".alternate-style");

function setActivityStyle(color) {
  alternateStyle.forEach((style) => {
    if (color === style.getAttribute("title")) {
      style.removeAttribute("disabled");
    } else {
      style.setAttribute("disabled", "true");
    }
  });
  styleSwticher.classList.remove("open");
}
