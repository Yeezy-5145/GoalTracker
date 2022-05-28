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

  var newInput = document.createElement("li");
  var index =
    $(".action-plan-body ol li").length - $(".activity-list li").length + 1;

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
  <i class="fa fa-trash-o delete-icon" onclick="deleteAction(e, name)"></i>
</div>
<ol class="activity-list">
  <div class="action-list-${index}">
    <li class="newActivity activity-${index}-1">
      <div class="action-plan-activity mt-1">
        <input
          type="text"
          id="activity-input"
          name="activity-${index}-1"
          class="activity-input form-control activity-${index}-1"
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
  console.log(`activity-${currentAction}-${currentActivity}`);
  // console.log(e.target.parentElement.children[0].getAttribute("name"));
  // console.log("." + e.target.parentElement.children[0].getAttribute("name"));

  let currentLi = document.querySelector("." + e.target.parentElement.children[0].getAttribute("name"));
  currentLi.remove();
  var currentIndex = currentActivity;

  while (currentIndex < totalActivity) {
    currentIndex++;
    let nextLi = document.querySelector(`.activity-${currentAction}-${parseInt(currentActivity) + 1}`);
    nextLi.setAttribute("class", `activity-${num-1}`)
    nextLi.firstElementChild.firstElementChild.setAttribute("")
  }

  // while (num < ith) {
  //   num++;
  //   let li = document.querySelector(`.newActivity-${num}`);
  //   console.log("li", li);  
  //   li.setAttribute("class", `newActivity-${num-1}`);
  //   let input = li.firstElementChild.firstElementChild
  //   console.log("input", input);
  //   input.setAttribute("name", `activity-${num-1}`)
  // }
}