let popupcontainer = document.getElementById('popupcontainer');
let deletePopup = document.getElementById('deletepopup');

// delete popup
function openDeletePopup(){
      deletePopup.classList.add("open-deletepopup");
      popupcontainer.classList.add("open-popupcontainer");

      // var input = document.getElementById("hid_input");
      // input.value = player.email;
}

function closeDeletePopup(){
      deletePopup.classList.remove("open-deletepopup");
      popupcontainer.classList.remove("open-popupcontainer");
}