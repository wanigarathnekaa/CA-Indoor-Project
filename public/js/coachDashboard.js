// const coachContainers = [...document.querySelectorAll('.coaches-container')];
// const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
// const preBtn = [...document.querySelectorAll('.pre-btn')];

// coachContainers.forEach((item, i) => {
//     let containerDimenstions = item.getBoundingClientRect();
//     let containerWidth = containerDimenstions.width;

//     nxtBtn[i].addEventListener('click', () => {
//         item.scrollLeft += containerWidth;
//     })

//     preBtn[i].addEventListener('click', () => {
//         item.scrollLeft -= containerWidth;
//     })
// })


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