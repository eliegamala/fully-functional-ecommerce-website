document.querySelector(".menu-icon").onclick = () => {
  document.querySelector(".nav-list").classList.toggle("open");
  profile.classList.remove("active"); // removes the login pop up when the side bar is clicked
  searchForm.style.display = 'none'; // hides the search bar when the side bar is opened
};

// login pop-up
const profile = document.querySelector(".profile");
const searchForm = document.querySelector('.search-form');

document.querySelector("#user-btn").onclick = () => {
  profile.classList.toggle("active");
  document.querySelector(".nav-list").classList.remove("open"); // removes the side bar when the account btn is pressed
  searchForm.style.display = 'none'; // hides the search bar when the profile is clicked
};

window.onscroll = () => {
  document.querySelector(".nav-list").classList.remove("open");
  profile.classList.remove("active");
  searchForm.style.display = 'none'; // hides the search bar when scrolling
};

const searchIcon = document.querySelector('.search-icon');

searchIcon.addEventListener('click', () => {
  searchForm.style.display = searchForm.style.display === 'block' ? 'none' : 'block';
  profile.classList.remove("active"); // removes the login pop up when the side bar is clicked
  document.querySelector(".nav-list").classList.remove("open"); // removes the side bar when the account btn is pressed


});

document.querySelectorAll('input[type="number"]').forEach(input => {
  input.oninput = () => {
    if (input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
  };
});
