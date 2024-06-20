const mobileNav = document.querySelector(".hamburger");
const navbar = document.querySelector(".menubar");

const toggleNav = () => {
  navbar.classList.toggle("active");
  mobileNav.classList.toggle("hamburger-active");
};
mobileNav.addEventListener("click", () => toggleNav());




const adsContainers = [...document.querySelectorAll('.ads-container')];
const adsnxtBtn = [...document.querySelectorAll('.adsnxt-btn')];
const adspreBtn = [...document.querySelectorAll('.adspre-btn')];

adsContainers.forEach((item, i) => {
    let containerDimenstions = item.getBoundingClientRect();
    let containerWidth = containerDimenstions.width;

    adsnxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    })

    adspreBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    })
})