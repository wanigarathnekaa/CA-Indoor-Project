let popup = document.getElementById('popup');
let popupcontainer = document.getElementById('popupcontainer');
let deletePopup = document.getElementById('deletepopup');


// details popup
function openPopup() {
      popup.classList.add("open-popup");
      popupcontainer.classList.add("open-popupcontainer");
}

function closePopup() {
      popup.classList.remove("open-popup");
      popupcontainer.classList.remove("open-popupcontainer");
}


// delete popup
function openDeletePopup(){
      deletePopup.classList.add("open-deletepopup");
      popupcontainer.classList.add("open-popupcontainer");
}

function closeDeletePopup(){
      deletePopup.classList.remove("open-deletepopup");
      popupcontainer.classList.remove("open-popupcontainer");
}