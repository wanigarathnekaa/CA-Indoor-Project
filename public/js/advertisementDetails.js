let popupcontainer = document.getElementById('popupcontainer');
let deletePopup = document.getElementById('deletepopup');

// delete popup
function openDeletePopup(){
      deletePopup.classList.add("open-deletepopup");
      popupcontainer.classList.add("open-popupcontainer");
}

function closeDeletePopup(){
      deletePopup.classList.remove("open-deletepopup");
      popupcontainer.classList.remove("open-popupcontainer");
}