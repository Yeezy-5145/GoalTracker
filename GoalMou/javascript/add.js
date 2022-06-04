const goalTitleInput = document.querySelector("#goal-title");
const completionDateInput = document.querySelector("#to-complete-date");
const firstAction = document.querySelector("#step-1");

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
  <!-- <i class="fa fa-trash-o delete-icon" onclick="deleteAction(e, name)"></i> -->
</div>
<ol class="activity-list">
  <div class="action-list-${index}">
    <li class="newActivity">
      <div class="action-plan-activity mt-1">
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
  <div class="action-plan-activity mt-1">
    <input type="text" id="activity-input" name="activity-${a}-${$(`.action-list-${a} li`).length + 1}" 
    class="activity-input form-control" placeholder="Activity ${a} . ${$(`.action-list-${a} li`).length + 1}" required/>
    <!-- <i class="fa fa-trash-o delete-icon" onclick="deleteAction(e, name)"></i> -->
  </div>
`;

  var b = ".action-list-" + a;
  // console.log(b);
  const newD = document.querySelector(b);
  newD.appendChild(newInput);
}