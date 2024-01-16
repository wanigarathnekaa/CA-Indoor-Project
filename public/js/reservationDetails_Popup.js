let popup = document.getElementById('popup');
let popupcontainer = document.getElementById('popupcontainer');
let deletePopup = document.getElementById('deletepopup');


// details popup
function openPopup(reservation) {
      popup.classList.add("open-popup");
      popupcontainer.classList.add("open-popupcontainer");

      const r_id = document.querySelector(".r_id");
      r_id.textContent = reservation.reservation_Id;

      const r_name = document.querySelector(".r_name");
      r_name.textContent = reservation.name;

      const r_email = document.querySelector(".r_email");
      r_email.textContent = reservation.email;

      const r_number = document.querySelector(".r_number");
      r_number.textContent = reservation.phoneNumber;

      const r_date = document.querySelector(".r_date");
      r_date.textContent = reservation.date;

      const r_time = document.querySelector(".r_time");
      r_time.textContent = reservation.timeSlot;

      const r_net = document.querySelector(".r_net");
      r_net.textContent = reservation.net;
}

function closePopup() {
      popup.classList.remove("open-popup");
      popupcontainer.classList.remove("open-popupcontainer");
}


// delete popup
function openDeletePopup(reservation){
      deletePopup.classList.add("open-deletepopup");
      popupcontainer.classList.add("open-popupcontainer");

    //   var input = document.getElementById("hid_input");
    //   input.value = player.email;
}

function closeDeletePopup(){
      deletePopup.classList.remove("open-deletepopup");
      popupcontainer.classList.remove("open-popupcontainer");
}