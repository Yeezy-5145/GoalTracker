const goalTitleInput = document.querySelector("#goal-title");
const completionDateInput = document.querySelector("#completion-date");
const firstAction = document.querySelector("#step-1");
const ERROR_COLOR = "rgb(249, 174, 174)";
const DEFAULT_COLOR = "rgb(255, 255, 255)";

function submitForm(e) {
  e.preventDefault();
  // console.log("hehehe");
  if (goalTitleInput.value === "") {
    goalTitleInput.style.background = ERROR_COLOR;

    goalTitleInput.placeholder = "This field should not be empty!";
    return;
  }
  if (completionDateInput.value === "") {
    completionDateInput.style.background = ERROR_COLOR;
    return;
  }
  // if(firstAction.value === "") {
  //   firstAction.style.background = ERROR_COLOR;
  //   return
  // }

  // Database Query

  router();
}

function router() {
  window.location.href = "http://127.0.0.1:5500/goalList_2.html";
}

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

function addActionPlan(e) {
  e.preventDefault();
  // console.log($('.action-plan-body ol li').length - $('.activity-list li').length);

  var newInput = document.createElement("li");
  var index =
    $(".action-plan-body ol li").length - $(".activity-list li").length + 1;

  newInput.innerHTML = `
  <div class="action-item">
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
  <!-- <i class="fa fa-trash-o delete-icon" onclick="deleteAction(e, name)"></i> -->
</div>
<ol class="activity-list">
  <div class="action-list-${index}">
    <li class="newActivity">
      <div class="action-plan-activity">
        <input
          type="text"
          id="activity-input"
          name="activity-${index}-1"
          class="activity-input form-control"
          placeholder="Activity ${index} . 1"
          required
        />
        <!-- <i class="fa fa-trash-o delete-icon" onclick="deleteAction(e, name)"></i> -->
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
  // console.log($(`.action-list-${a} li`).length);
  newInput.innerHTML = `
  <div class="action-plan-activity">
    <input type="text" id="activity-input" name="activity-${a}-1" class="activity-input form-control" placeholder="Activity ${a} . ${
    $(`.action-list-${a} li`).length + 1
  }" required/>
    <!-- <i class="fa fa-trash-o delete-icon" onclick="deleteAction(e, name)"></i> -->
  </div>
`;

  var b = ".action-list-" + a;
  // console.log(b);
  const newD = document.querySelector(b);
  newD.appendChild(newInput);
}
