// // Get data from local storage
// const currentUser = JSON.parse(localStorage.getItem("currentUser"));
// console.log("current user:", currentUser.id);

// // Get username
// const username = document.querySelector(".username");
// const usernameProfile = document.querySelector(".usernameProfile");
// const userName = document.querySelector("#userName");
// console.log(currentUser.personalDetails.username);
// username.textContent = currentUser.personalDetails.username;
// if (usernameProfile) {
//   usernameProfile.innerHTML = currentUser.personalDetails.username;
// }
// if (userName) {
//   userName.value = currentUser.personalDetails.username;
// }

// // Get email
// const email = document.querySelector(".userEmail");
// const eMail = document.querySelector("#eMail");
// console.log(currentUser.personalDetails.email);
// if (email) {
//   email.textContent = currentUser.personalDetails.email;
// }
// if (eMail) {
//   eMail.value = currentUser.personalDetails.email;
// }

// // Get birthday
// const birthday = document.querySelector("#birthday");
// console.log(currentUser.personalDetails.birthday);
// if (birthday) {
//   birthday.value = currentUser.personalDetails.birthday;
// }

// // Get firstName
// const firstName = document.querySelector("#firstName");
// console.log(currentUser.personalDetails.firstName);
// if (firstName) {
//   firstName.value = currentUser.personalDetails.firstName;
// }

// // Get lastName
// const lastName = document.querySelector("#lastName");
// console.log(currentUser.personalDetails.lastName);
// if (lastName) {
//   lastName.value = currentUser.personalDetails.lastName;
// }

// // Get phoneNumber
// const phoneNumber = document.querySelector("#phone");
// console.log(currentUser.personalDetails.phoneNumber);
// if (phoneNumber) {
//   phoneNumber.value = currentUser.personalDetails.phoneNumber;
// }

// // Get profile pic
// const profilePhoto = document.querySelector(".profilePhoto");
// const imagePreview = document.querySelector(".imagePreview");
// profilePhoto.setAttribute("src", currentUser.personalDetails.profilePhoto);
// if (imagePreview) {
//   imagePreview.setAttribute("src", currentUser.personalDetails.profilePhoto);
// }

// // Address
// // Get street
// const street = document.querySelector("#Street");
// if (street) {
//   street.value = currentUser.address.street;
// }

// // Get city
// const city = document.querySelector("#City");
// if (city) {
//   city.value = currentUser.address.city;
// }

// // Get state
// const state = document.querySelector("#State");
// if (state) {
//   strestateet.value = currentUser.address.state;
// }

// // Get zipCode
// const zipCode = document.querySelector("#Zip");
// if (zipCode) {
//   zipCode.value = currentUser.address.zipCode;
// }

// const goalNumber = document.querySelector(".goalNumber");
// console.log(goalNumber);
// goalNumber.textContent = currentUser.goals.length;
// console.log("Number:", goalNumber);

// const goalList = document.querySelector(".goal-list-wrapper");
// for (let i = 0; i < currentUser.goals.length; i++) {
//   const goal = currentUser.goals[i];
//   console.log("Goal length", goal);

//   const eachGoal = document.createElement("div");
//   eachGoal.setAttribute("class", "each-goal");
//   console.log(goal.title);
//   //   const edit = document.createElement("i");
//   //   edit.setAttribute("class", "fa fa-edit");
//   eachGoal.innerHTML = `<div class='goal-title-part'><div class='goal-text'><h3>${
//     goal.title
//   }</h3><p>${goal.dueDate.replace(
//     "T",
//     " "
//   )}</p></div></div><i class="fa fa-edit" onclick="toManageGoal()"></i>`;
//   // const edit = document.querySelector(".each-goal");

//   goalList.append(eachGoal);

//   const goalTitle = document.querySelector(".goalTitle");
//   goalTitle.textContent = goal.title;

//   const dueDateText = document.querySelector(".due-date-text");
//   dueDateText.textContent = goal.dueDate.replace("T", " ");

//   const category = document.querySelector(".category-menu");
//   for (let j = 0; j < category.length; j++) {
//     console.log(category[j]);
//     if (category[j].value === goal.category) {
//       category[j].setAttribute("selected", "true");
//     }

//     const description = document.querySelector(".description");
//     description.textContent = goal.description;
//   }

//   for (let x = 0; x < goal.actionPlans.length; x++) {
//     const step = goal.actionPlans[x];

//     const li = document.createElement("li");
//     li.innerHTML = `<div class="step"><p contenteditable="true" class="step-text">${step}</p><div><input type="checkbox" name="checkdone" class="checkDone" /><i class="fa fa-trash"></i></div></div>`;

//     const stepUL = document.querySelector(".step-ul");
//     stepUL.append(li);
//   }

//   for (let y = 0; y < goal.comments.length; y++) {
//     const eachComment = goal.comments[y];
//     // console.log("goal length", goal);
//     console.log("comment length", goal.comments.length);

//     const comment = document.createElement("div");
//     comment.setAttribute("class", "comment");
//     // const star = document.createElement("i");
//     // star.setAttribute("class", "fa fa-star");
//     // star.setAttribute("style", "color: gold");
//     let totalStars = "";
//     for (let a = 0; a < eachComment.stars; a++) {
//       totalStars += `<i class="fa fa-star" style="color: gold"></i>`;
//     }
//     comment.innerHTML = `<div class="comment-photo-name"> <img src=${eachComment.profilePhoto} alt="user-photo" /><p>${eachComment.mentorName}</p></div><p class="text">${eachComment.comment}</p><div class="rating-part">${totalStars}</div></div> <hr />`;

//     const commentList = document.querySelector(".comments-list");
//     commentList.append(comment);
//   }
// }
