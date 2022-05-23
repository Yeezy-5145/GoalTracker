// Comment
const usernameArea = document.querySelector(".usernameArea");
const commentArea = document.querySelector(".commentArea");
const commentButton = document.querySelector(".commentButton");
const ratingStars = document.querySelector(".rating-stars");

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
