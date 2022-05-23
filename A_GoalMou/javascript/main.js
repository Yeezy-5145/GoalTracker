// Due date
const dueDateText = document.querySelector(".due-date-text");
const dueDateChoice = document.querySelector(".due-date-choice");

dueDateText.addEventListener("click", () => {
  const oldDate = dueDateText.innerHTML;
  dueDateText.style.display = "none";
  dueDateChoice.style.display = "block";
  dueDateChoice.value = oldDate;
});

function changeDate(e) {
  const newDate = e.target.value;
  dueDateChoice.style.display = "none";
  dueDateText.style.display = "block";
  dueDateText.innerHTML = newDate;
}

// Add description
const addDescriptionIcon = document.querySelector(".addDescription");
let addDescriptionOpen = false;
addDescriptionIcon.addEventListener("click", () => {
  if (addDescriptionOpen === false) {
    addDescriptionIcon.classList.add("open");
    addDescriptionOpen = true;
  } else {
    addDescriptionIcon.classList.remove("open");
    addDescriptionOpen = false;
    removeDescriptionInput();
  }
});

function addDescription() {
  if (addDescriptionOpen === true) return;

  var newInput = document.createElement("input");
  newInput.setAttribute("class", "newDescription");
  newInput.setAttribute("placeholder", "What is it about?");

  const newD = document.querySelector(".newDescriptionArea");
  newD.appendChild(newInput);
  newInput.focus();
  newInput.setAttribute("onchange", "descriptionChangeFunction(this.value)");
}

function descriptionChangeFunction(val) {
  const descriptionUL = document.querySelector(".description-ul");
  const newLI = document.createElement("li");
  newLI.setAttribute("contenteditable", "true");
  const newVal = document.createTextNode(val);

  newLI.appendChild(newVal);
  descriptionUL.appendChild(newLI);

  removeDescriptionInput();
  addDescriptionOpen = false;
  addDescriptionIcon.classList.remove("open");
}

function removeDescriptionInput() {
  const newD = document.querySelector(".newDescriptionArea");
  const newInput = document.querySelector(".newDescription");

  newD.removeChild(newInput);
}

// Add step
const addStepIcon = document.querySelector(".addStep");
let addStepOpen = false;
addStepIcon.addEventListener("click", () => {
  if (addStepOpen === false) {
    addStepIcon.classList.add("open");
    addStepOpen = true;
  } else {
    addStepIcon.classList.remove("open");
    addStepOpen = false;
    removeStepInput();
  }
});

function addStep() {
  if (addStepOpen === true) return;

  var newInput = document.createElement("input");
  newInput.setAttribute("class", "newStep");
  newInput.setAttribute("placeholder", "What do you think?");

  const newD = document.querySelector(".newStepArea");
  newD.appendChild(newInput);
  newInput.focus();
  newInput.setAttribute("onchange", "stepChangeFunction(this.value)");
}

function stepChangeFunction(val) {
  const stepUL = document.querySelector(".step-ul");
  const newLI = document.createElement("li");
  const newDiv = document.createElement("div");
  newDiv.setAttribute("class", "step");
  const newP = document.createElement("p");
  newP.setAttribute("contenteditable", "true");
  const newVal = document.createTextNode(val);

  const insideDiv = document.createElement("div");
  const newCheckbox = document.createElement("input");
  newCheckbox.setAttribute("type", "checkbox");
  newCheckbox.setAttribute("name", "checkdone");
  newCheckbox.setAttribute("class", "checkDone");
  totalActionPlans++;
  totalPercentage = (numberOfDone / totalActionPlans) * 100;
  totalPercentage = parseFloat(totalPercentage).toFixed(0);
  percentage.style.width = `${totalPercentage}%`;
  percentageText.innerHTML = `${totalPercentage}%`;
  if (totalPercentage < 100) {
    percentage.style.borderBottomRightRadius = "0px";
  } else {
    percentage.style.borderBottomRightRadius = "20px";
  }
  newCheckbox.addEventListener("click", () => {
    if (!newCheckbox.hasAttribute("checked")) {
      newCheckbox.setAttribute("checked", "true");
      numberOfDone++;
    } else {
      newCheckbox.removeAttribute("checked");
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
  const newTrash = document.createElement("i");
  newTrash.setAttribute("class", "fa fa-trash");
  newTrash.addEventListener("click", () => {
    newTrash.parentElement.parentElement.parentElement.style.display = "none";
    totalActionPlans = totalActionPlans - 1;

    if (newCheckbox.hasAttribute("checked")) {
      numberOfDone -= 1;
    }

    totalPercentage = (numberOfDone / totalActionPlans) * 100;
    totalPercentage = parseFloat(totalPercentage).toFixed(0);
    percentage.style.width = `${totalPercentage}%`;
    percentageText.innerHTML = `${totalPercentage}%`;
  });

  insideDiv.appendChild(newCheckbox);
  insideDiv.appendChild(newTrash);

  newP.appendChild(newVal);
  newDiv.appendChild(newP);
  newDiv.appendChild(insideDiv);
  newLI.appendChild(newDiv);
  stepUL.appendChild(newLI);

  removeStepInput();
  addStepOpen = false;
  addStepIcon.classList.remove("open");

  const checkboxDone = document.querySelectorAll(".checkDone");
  console.log(checkboxDone.length);
  console.log(checkboxDone[5].checked);
}

function removeStepInput() {
  const newD = document.querySelector(".newStepArea");
  const newInput = document.querySelector(".newStep");

  newD.removeChild(newInput);
}

// Add activity
// const addActivityIcon = document.querySelector(".addActivityIcon");
// let addActivityOpen = false;
// addActivityIcon.addEventListener("click", () => {
//   if (addActivityOpen === false) {
//     addActivityIcon.classList.add("open");
//     addActivityOpen = true;
//   } else {
//     addActivityIcon.classList.remove("open");
//     addActivityOpen = false;
//     removeActivityInput();
//   }
// });

// function addActivityInput() {
//   if (addActivityOpen === true) return;

//   var newInput = document.createElement("input");
//   newInput.setAttribute("class", "newActivity");
//   newInput.setAttribute("placeholder", "What activity you wanna add?");

//   const newD = document.querySelector(".newActivityInput");
//   newD.appendChild(newInput);
//   newInput.focus();
//   newInput.setAttribute("onchange", "activityChange(this.value)");
// }

// function activityChange(val) {
//   const eachUL = document.querySelectorAll(".each-ul");

//   for (let i = 0; i < eachUL.length; i++) {
//     const theUL = eachUL[i];

//     const checkbox = document.createElement("input");
//     checkbox.setAttribute("type", "checkbox");
//     checkbox.setAttribute("class", "checkDone");
//     checkbox.addEventListener("click", () => {
//       console.log("!23");
//       if (!checkbox.hasAttribute("checked")) {
//         checkbox.setAttribute("checked", "true");
//         numberOfDone++;
//       } else {
//         checkbox.removeAttribute("checked");
//         numberOfDone--;
//       }

//       totalPercentage = (numberOfDone / totalActionPlans) * 100;
//       totalPercentage = parseFloat(totalPercentage).toFixed(0);
//       percentage.style.width = `${totalPercentage}%`;
//       percentageText.innerHTML = `${totalPercentage}%`;

//       if (totalPercentage >= 50) {
//         percentageText.style.color = "#fff";
//       } else {
//         percentageText.style.color = "#000";
//       }

//       if (totalPercentage < 100) {
//         percentage.style.borderBottomRightRadius = "0px";
//       } else {
//         percentage.style.borderBottomRightRadius = "20px";
//       }
//     });
//     const trash = document.createElement("i");
//     trash.setAttribute("class", "fa fa-trash");
//     trash.addEventListener("click", () => {
//       trash.parentElement.parentElement.style.display = "none";

//       totalActionPlans = totalActionPlans - 1;

//       if (checkbox.hasAttribute("checked")) {
//         numberOfDone -= 1;
//       }

//       totalPercentage = (numberOfDone / totalActionPlans) * 100;
//       totalPercentage = parseFloat(totalPercentage).toFixed(0);
//       percentage.style.width = `${totalPercentage}%`;
//       percentageText.innerHTML = `${totalPercentage}%`;
//     });
//     const theLI = document.createElement("li");
//     theLI.setAttribute("class", "each-li");
//     theLI.innerHTML = `${val}<div>${checkbox.outerHTML}${trash.outerHTML}</div>`;

//     theUL.append(theLI);

//     totalActionPlans++;
//     totalPercentage = (numberOfDone / totalActionPlans) * 100;
//     totalPercentage = parseFloat(totalPercentage).toFixed(0);
//     percentage.style.width = `${totalPercentage}%`;
//     percentageText.innerHTML = `${totalPercentage}%`;
//     if (totalPercentage < 100) {
//       percentage.style.borderBottomRightRadius = "0px";
//     } else {
//       percentage.style.borderBottomRightRadius = "20px";
//     }
//   }

//   removeActivityInput();
//   addActivityIcon.classList.remove("open");
// }

// function removeActivityInput() {
//   const newD = document.querySelector(".newActivityInput");
//   const newInput = document.querySelector(".newActivity");

//   newD.removeChild(newInput);
// }

// Checkbox and Progress percentage
// let checkboxDone = document.querySelectorAll(".checkDone");

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

// Comment
const usernameArea = document.querySelector(".usernameArea");
const commentArea = document.querySelector(".commentArea");
const ratingStars = document.querySelector(".rating-stars");

const commentButton = document.querySelector(".commentButton");
commentButton.addEventListener("click", (e) => {
  e.preventDefault();
  if (commentArea.value === "") {
    commentArea.focus();
    return;
  }

  const username =
    usernameArea.value === "" ? "Annonymous" : usernameArea.value;
  const comment = commentArea.value;
  const starsCount = ratingStars.value;

  // Stars
  const newRatingPart = document.createElement("div");
  newRatingPart.setAttribute("class", "rating-part");
  for (let i = 0; i < starsCount; i++) {
    newRatingPart.innerHTML += "<i class='fa fa-star' style='color: gold'></i>";
    newRatingPart.querySelectorAll("i")[i].style.fontSize = "18px";
    newRatingPart.querySelectorAll("i")[i].style.marginRight = "10px";
  }

  const newComment = document.createElement("div");
  newComment.setAttribute("class", "comment");
  newComment.innerHTML = `<div class='comment-photo-name'><img src='./images/bird3.gif' alt='user-photo' /> <p>${username}</p></div> <p class='text'>${comment}</p> ${newRatingPart.innerHTML} </div><hr />`;
  const commentsList = document.querySelector(".comments-list");
  commentsList.appendChild(newComment);

  usernameArea.value = "";
  commentArea.value = "";
  ratingStars.value = "1";
});

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
  var input, filter, allGoals, h3, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  allGoals = document.querySelectorAll(".each-goal");
  console.log(allGoals.length);
  h3 = document.querySelectorAll(".goalT");
  console.log(h3);

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < allGoals.length; i++) {
    txtValue = h3[i].textContent || h3[i].innerText;
    console.log(txtValue);
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      allGoals[i].style.display = "";
    } else {
      allGoals[i].style.display = "none";
    }
  }
}
