let popup = document.getElementById('popup');
let popupcontainer = document.getElementById('popupcontainer');



function openPopup(reservation) {
      popup.classList.add("open-popup");
      popupcontainer.classList.add("open-popupcontainer");

      const r_id = document.querySelector(".r_id");
      r_id.textContent = reservation.reservation_Id;

      const r_name = document.querySelector(".r_name");
      r_name.textContent = reservation.name;

      const r_date = document.querySelector(".r_date");
      r_date.textContent = reservation.date;

      const r_net = document.querySelector(".r_net");
      r_net.textContent = reservation.net;

      const r_timeSlot = document.querySelector(".r_timeSlot");
      r_timeSlot.textContent = reservation.timeSlot;

      // const r_payment = document.querySelector(".r_payment");
      // r_payment.textContent = reservation.payment;

}

function closePopup() {
      popup.classList.remove("open-popup");
      popupcontainer.classList.remove("open-popupcontainer");
}

