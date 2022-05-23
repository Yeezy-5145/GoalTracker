const openSideBar = document.querySelector("#openSideBar");
const closeSideBar = document.querySelector("#closeSideBar");
const userProfileOuterButton = document.querySelector("#userProfileOuter");
const userProfileButton = document.querySelector("#userProfile");
const invisBackdrop = document.querySelector("#invis-background");
const goalsNavButton = document.querySelector("#goalsNav");
const goalsNavigationButton = document.querySelector("#goalsNavigation");
const closeButton = document.querySelector(".btn-close");

function myFunction() {
  document.getElementById("listofNotification").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.notificationButton')) {
    var dropdowns = document.getElementsByClassName("goalContent");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
document.getElementById("mySidenav").style.width = "0";
}

function wait(ms){
  var start = new Date().getTime();
  var end = start;
  while(end < start + ms) {
    end = new Date().getTime();
 }
}

openSideBar.addEventListener("click", () => {
  setTimeout(() => {
    if(userProfileOuterButton.classList.contains("collapsed")){
      document.getElementById("userProfileOuter").click();
    }
  }, 200) 
  setTimeout(() => {
    if(goalsNavigationButton.classList.contains("collapsed")){
      document.getElementById("goalsNavigation").click();
    }
  }, 400) 
  invisBackdrop.classList = "active";
})

invisBackdrop.addEventListener("click", () => {
  collapseSideBar();
})

function collapseSideBar() {
  if(!userProfileOuterButton.classList.contains("collapsed")){
    document.getElementById("userProfileOuter").click();
  }
  if(!goalsNavigationButton.classList.contains("collapsed")){
    document.getElementById("goalsNavigation").click();
  }
  closeSideBar.click();
  invisBackdrop.classList = "";
}

closeButton.addEventListener("click", () => {
  collapseSideBar();
})