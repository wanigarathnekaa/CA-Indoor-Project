let popup = document.getElementById('popup');
let popupcontainer = document.getElementById('popupcontainer');



function openPopup() {
      popup.classList.add("open-popup");
      popupcontainer.classList.add("open-popupcontainer");
}

function closePopup() {
      popup.classList.remove("open-popup");
      popupcontainer.classList.remove("open-popupcontainer");
}