let popup = document.getElementById('popup');
let popupcontainer = document.getElementById('popupcontainer');
let deletePopup = document.getElementById('deletepopup');


// details popup
function openPopup(player) {
      popup.classList.add("open-popup");
      popupcontainer.classList.add("open-popupcontainer");

      const p_id = document.querySelector(".p_id");
      p_id.textContent = player.uid;

      const p_name = document.querySelector(".p_name");
      p_name.textContent = player.name;

      const p_email = document.querySelector(".p_email");
      p_email.textContent = player.email;

      const p_number = document.querySelector(".p_number");
      p_number.textContent = player.phoneNumber;
}

function closePopup() {
      popup.classList.remove("open-popup");
      popupcontainer.classList.remove("open-popupcontainer");
}


// delete popup
function openDeletePopup(player){
      deletePopup.classList.add("open-deletepopup");
      popupcontainer.classList.add("open-popupcontainer");

      var input = document.getElementById("hid_input");
      input.value = player.email;
}

function closeDeletePopup(){
      deletePopup.classList.remove("open-deletepopup");
      popupcontainer.classList.remove("open-popupcontainer");
}