const body = document.querySelector("body"),
  sidebar = body.querySelector(".sidebar"),
  toggle = body.querySelector(".toggle"),
  image = body.querySelector(".image-text img");

toggle.addEventListener("click", () => {
  console.log("Toggle button clicked.");
  sidebar.classList.toggle("close");

  // Resize the image when the sidebar is toggled
  if (sidebar.classList.contains("close")) {
    image.style.width = "70px"; // Set the width to your desired size (e.g., 100px)
    image.style.height = "auto"; // Adjust height accordingly or maintain aspect ratio
  } else {
    // Reset the image size if sidebar is open
    image.style.width = "120px";
    image.style.height = "auto";
  }
});


const mobileNav = document.querySelector(".hamburger");
const navbar = document.querySelector(".menubar2");

const toggleNav = () => {
  console.log("Toggle function called.");
  navbar.classList.toggle("active");
  mobileNav.classList.toggle("hamburger-active");
  console.log("Mobile nav toggled.");
};
mobileNav.addEventListener("click", () => toggleNav());



