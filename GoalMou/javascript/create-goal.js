const goalTitleInput = document.querySelector("#goal-title");
const completionDateInput = document.querySelector("#to-complete-date");
const firstAction = document.querySelector("#step-1");
const ERROR_COLOR = "rgb(249, 174, 174)";
const DEFAULT_COLOR = "rgb(255, 255, 255)";

// function submitForm(e) {
//   e.preventDefault();
//   // console.log("hehehe");
//   if (goalTitleInput.value === "") {
//     goalTitleInput.style.background = ERROR_COLOR;

//     goalTitleInput.placeholder = "This field should not be empty!";
//     return;
//   }
//   if (completionDateInput.value === "") {
//     completionDateInput.style.background = ERROR_COLOR;
//     return;
//   }

//   // router();
// }

// function router() {
//   window.location.href = "http://127.0.0.1:5500/goalList_2.html";
// }

function scrollToTopOfPage() {}

goalTitleInput.addEventListener("click", () => {
  if (goalTitleInput.style.background === ERROR_COLOR) {
    goalTitleInput.style.background = DEFAULT_COLOR;
    goalTitleInput.placeholder = "";
  }
});

completionDateInput.addEventListener("click", () => {
  if (completionDateInput.style.background === ERROR_COLOR) {
    completionDateInput.style.background = DEFAULT_COLOR;
  }
});

// firstAction.addEventListener("click", () => {
//   if(firstAction.style.background === ERROR_COLOR) {
//     firstAction.style.background = DEFAULT_COLOR;
//   }
// })

const actionList = document.querySelector(".action-plan-body ol");

function findIndex(e) {
  var li = e.target.parentElement.parentElement,
    i = 1;

  while (li.previousElementSibling) {
    li = li.previousElementSibling;
    i += 1;
  }
  // console.log(i);
  return i;
}

function findIndex2(e) {
  var li = e.target.parentElement.parentElement.parentElement.parentElement.parentElement,
    i = 1;

  while (li.previousElementSibling) {
    li = li.previousElementSibling;
    i += 1;
  }
  // console.log(i);
  return i;
}

function addActionPlan(e) {
  e.preventDefault();
  // console.log($('.action-plan-body ol li').length - $('.activity-list li').length);

  var index = $(".action-plan-body ol li").length - $(".activity-list li").length + 1;
  var newInput = document.createElement("li");
  newInput.className = `action-${index}`;

  newInput.innerHTML = `
  <div class="action-item mt-2">
  <input
    type="text"
    id="action-plan-input"
    name="action-${index}"
    class="action-plan-input form-control"
    placeholder="Action ${index}"
    required
    index="1"
  />
  <i
    class="fa fa-plus addStep"
    onclick="addActivity(event)"
    style="font-size: large"
  ></i>
</div>
<ol class="activity-list">
  <div class="action-list-${index}">
    <li class="newActivity activity-${index}-1">
      <div class="action-plan-activity mt-1">
        <input
          type="text"
          id="activity-input"
          name="activity-${index}-1"
          class="activity-input form-control"
          placeholder="Activity ${index} . 1"
          required
        />
        <i class="fa fa-trash-o delete-icon" onclick="deleteActivity(event)"></i>
      </div>
    </li>
  </div>
</ol>`;

  const newD = document.querySelector(".new-action");
  newD.appendChild(newInput);
}

function addActivity(e) {
  var a = findIndex(e);
  e.preventDefault();
  var newInput = document.createElement("li");
  newInput.setAttribute("class", "newActivity");
  newInput.classList.add(`activity-${a}-${$(`.action-list-${a} li`).length + 1}`);
  // console.log($(`.action-list-${a} li`).length);
  newInput.innerHTML = `
  <div class="action-plan-activity mt-1">
    <input type="text" id="activity-input" name="activity-${a}-${$(`.action-list-${a} li`).length + 1}" 
    class="activity-input form-control" placeholder="Activity ${a} . ${$(`.action-list-${a} li`).length + 1}" required/>
    <i class="fa fa-trash-o delete-icon" onclick="deleteActivity(event)"></i>
  </div>
`;

  var b = ".action-list-" + a;
  // console.log(b);
  const newD = document.querySelector(b);
  newD.appendChild(newInput);
}

function deleteActivity(e) {
  e.preventDefault();
  var nameToDelete = e.target.parentElement.children[0].getAttribute("name");
  var currentAction = nameToDelete.split("-")[1];
  var currentActivity = nameToDelete.split("-")[2];
  var totalActivity = e.target.parentElement.parentElement.parentElement.getElementsByTagName("li").length;
  
  // To calculate total action (Stored in var totalAction)
  let actionSelector = document.querySelector(`.action-${currentAction}`);
  var totalAction = 1;
  var tempAction = actionSelector;
  while (true) {
    if(tempAction.nextElementSibling) {
      totalAction += 1;
      tempAction = tempAction.nextElementSibling;
    } else break;
  }
  tempAction = actionSelector;
  while (true) {
    if(tempAction.previousElementSibling) {
      totalAction += 1;
      tempAction = tempAction.previousElementSibling;
    } else break;
  }

  if(totalActivity === 1) {
    let actionToDelete = document.querySelector(`.action-${currentAction}`);
    actionToDelete.remove();
    var currentActionIndex = parseInt(currentAction);

    while (currentActionIndex < totalAction) {
      
      let nextAction = document.querySelector(`.action-${currentActionIndex + 1}`);
      var newActionName = "action-" + currentActionIndex;
      nextAction.setAttribute("class", newActionName);
      nextAction.firstElementChild.firstElementChild.setAttribute("name", newActionName);
      nextAction.firstElementChild.firstElementChild.setAttribute("placeholder", `Action ${currentActionIndex}`);
      currentActionIndex++;
      
      var currentIndex = 1;
      let currentOrderedList = document.querySelector(`.action-list-${currentActionIndex}`);
      var numberOfActivities = currentOrderedList.getElementsByTagName("li").length;
      currentOrderedList.setAttribute("class", `action-list-${currentActionIndex - 1}`);
    
      while (currentIndex <= numberOfActivities) {
        let currentLi = document.querySelector(`.activity-${currentActionIndex}-${currentIndex}`);
        var newName = "activity-" + (currentActionIndex - 1) + "-" + currentIndex;
        currentLi.setAttribute("class", newName);
        currentLi.firstElementChild.firstElementChild.setAttribute("name", newName);
        currentLi.firstElementChild.firstElementChild.setAttribute("placeholder", `Activity ${currentActionIndex - 1} . ${currentIndex}`);
        currentIndex++;
      }
    }
    
  } else {
    let currentLi = document.querySelector("." + e.target.parentElement.children[0].getAttribute("name"));
    currentLi.remove();
    var currentIndex = currentActivity;

    while (currentIndex < totalActivity) {
      let nextLi = document.querySelector(`.activity-${currentAction}-${parseInt(currentIndex) + 1}`);
      var newName = "activity-" + currentAction + "-" + currentIndex;
      nextLi.setAttribute("class", newName);
      nextLi.firstElementChild.firstElementChild.setAttribute("name", newName);
      nextLi.firstElementChild.firstElementChild.setAttribute("placeholder", `Activity ${currentAction} . ${currentIndex}`);
      currentIndex++;
    }
  }
}