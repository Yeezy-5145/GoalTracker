//upload profile image

function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#profilePicturePreview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}
// Prepare the preview for profile picture
$("#profilePic").change(function(){
  readURL(this);
});

//hide show password
$(document).ready(function () {
$(".pass_show").append('<span class="ptxt">Show</span>');
});
$(document).on("click", ".pass_show .ptxt", function () {
$(this).text($(this).text() == "Show" ? "Hide" : "Show");
$(this)
.prev()
.attr("type", function (index, attr) {
  return attr == "password" ? "text" : "password";
});
});

function myFunction() {
document.getElementById("listofNotification").classList.toggle("show");
}

//notification button
// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
if (!event.target.matches(".notificationButton")) {
var dropdowns = document.getElementsByClassName("goalContent");
var i;
for (i = 0; i < dropdowns.length; i++) {
  var openDropdown = dropdowns[i];
  if (openDropdown.classList.contains("show")) {
    openDropdown.classList.remove("show");
  }
}
}
};
/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
document.getElementById("mySidenav").style.width = "0";
}

//Delete account JS
// $(document).ready(function(){
//   $("#myBtn").click(function(){
//       $("#myModal").modal("show");
//   });
// });