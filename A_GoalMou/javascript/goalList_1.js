function toManageGoal() {
  var manageGoal = document.querySelector(".manageGoal");
  manageGoal.classList.add("active");
  console.log("123");

  var fadeBg = document.querySelector(".fade-bg");
  fadeBg.classList.add("active");
}

function closeGoal() {
  var manageGoal = document.querySelector(".manageGoal");
  manageGoal.classList.remove("active");

  var fadeBg = document.querySelector(".fade-bg");
  fadeBg.classList.remove("active");
}
