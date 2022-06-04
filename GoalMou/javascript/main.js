// // Due date
// const dueDateText = document.querySelector(".due-date-text");
// const dueDateChoice = document.querySelector(".due-date-choice");

// dueDateText.addEventListener("click", () => {
//   const oldDate = dueDateText.innerHTML;
//   dueDateText.style.display = "none";
//   dueDateChoice.style.display = "block";
//   dueDateChoice.value = oldDate;
// });

// function changeDate(e) {
//   const newDate = e.target.value;
//   dueDateChoice.style.display = "none";
//   dueDateText.style.display = "block";
//   dueDateText.innerHTML = newDate;
// }


// Calculate percentage
let checkboxDone = document.querySelectorAll(".checkDone");
console.log(checkboxDone.length);
const percentage = document.querySelector(".percentage");
const percentageText = document.querySelector(".percentage-text");
let totalActionPlans = checkboxDone.length;
let numberOfDone = 0;
let totalPercentage = 0;

const trashes = document.querySelectorAll(".fa-trash");
const eachLI = document.querySelectorAll(".each-li");

for (let i = 0; i < totalActionPlans; i++) {
  trashes[i].addEventListener("click", () => {
    trashes[i].parentElement.parentElement.style.display = "none";

    totalActionPlans = totalActionPlans - 1;

    if (checkboxDone[i].hasAttribute("checked")) {
      numberOfDone -= 1;
    }

    totalPercentage = (numberOfDone / totalActionPlans) * 100;
    totalPercentage = parseFloat(totalPercentage).toFixed(0);
    percentage.style.width = `${totalPercentage}%`;
    percentageText.innerHTML = `${totalPercentage}%`;
  });

  checkboxDone[i].addEventListener("click", () => {
    if (!checkboxDone[i].hasAttribute("checked")) {
      checkboxDone[i].setAttribute("checked", "true");
      numberOfDone++;
    } else {
      checkboxDone[i].removeAttribute("checked");
      numberOfDone--;
    }

    totalPercentage = (numberOfDone / totalActionPlans) * 100;
    totalPercentage = parseFloat(totalPercentage).toFixed(0);
    percentage.style.width = `${totalPercentage}%`;
    percentageText.innerHTML = `${totalPercentage}%`;

    if (totalPercentage >= 50) {
      percentageText.style.color = "#fff";
    } else {
      percentageText.style.color = "#000";
    }

    if (totalPercentage < 100) {
      percentage.style.borderBottomRightRadius = "0px";
    } else {
      percentage.style.borderBottomRightRadius = "20px";
    }
  });
}

// Copy link
function copyURI(e) {
  const linkCopied = document.querySelector(".linkCopied");

  // navigator.clipboard.writeText(window.location.href);
  navigator.clipboard.writeText("http://127.0.0.1:5500/viewGoalMentor.html");
  linkCopied.style.display = "block";
  setTimeout(() => {
    linkCopied.style.display = "none";
  }, 2000);
}

// search
function searchFunction() {
  console.log("123");
  // Declare variable
  var input, filter, allGoals, p, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  allGoals = document.querySelectorAll(".each-goal");
  console.log(allGoals.length);
  p = document.querySelectorAll(".goalT");
  console.log(p);

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < allGoals.length; i++) {
    txtValue = p[i].textContent || p[i].innerText;
    console.log(txtValue);
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      allGoals[i].style.display = "";
    } else {
      allGoals[i].style.display = "none";
    }
  }
}

// filter by category
function filterFunction() {
  // Declare variable
  var input, filter, allGoals, p, i, txtValue;
  input = document.getElementById("my-filter");
  filter = input.value.toUpperCase();
  console.log("inputSearch"+filter);
  allGoals = document.querySelectorAll(".each-goal");
  console.log(allGoals.length);
  p = document.querySelectorAll(".goalC");
  console.log(p);
  if (filter == "ALL") {
    for (i = 0; i < allGoals.length; i++) {
      allGoals[i].style.display = "";
    }
    return;
  }

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < allGoals.length; i++) {
    txtValue = p[i].textContent || p[i].innerText;
    console.log(txtValue);
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      allGoals[i].style.display = "";
    } else {
      allGoals[i].style.display = "none";
    }
  }
}