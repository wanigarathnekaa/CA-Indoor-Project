let popup = document.getElementById("popup");
let popupcontainer = document.getElementById("popupcontainer");
let reschedulePopupContainer = document.getElementById(
  "reschedulePopupContainer"
);
let numberOfDays = 0;
let timeSlot = "";
let bookingID = 0;

function openPopup(reservation) {
  popup.classList.add("open-popup");
  popupcontainer.classList.add("open-popupcontainer");

  const r_id = document.querySelector(".r_id");
  r_id.textContent = reservation.id;

  const r_name = document.querySelector(".r_name");
  r_name.textContent = reservation.name;

  const r_date = document.querySelector(".r_date");
  r_date.textContent = reservation.date;

  const r_net = document.querySelector(".r_net");
  r_net.textContent = reservation.netType;

  const r_timeSlot = document.querySelector(".r_timeSlot");
  r_timeSlot.textContent = reservation.timeSlot;

  timeSlot = reservation.timeSlot;
  bookingID = reservation.booking_id;

  // Calculate the number of days
  const reservationDate = new Date(reservation.date);
  const currentDate = new Date();
  const timeDifference = reservationDate.getTime() - currentDate.getTime();
  numberOfDays = Math.ceil(timeDifference / (1000 * 3600 * 24)); // Convert milliseconds to days
  console.log(numberOfDays);

  const r_payment = document.querySelector(".r_payment");
  r_payment.textContent = reservation.paymentStatus;
}

function closePopup() {
  popup.classList.remove("open-popup");
  popupcontainer.classList.remove("open-popupcontainer");
}

function openReschedulePopup() {
  // Hide the original popup and show the reschedulePopup
  console.log("Reschedule button clicked");
  reschedulePopup.classList.add("open-popup");
  reschedulePopupContainer.classList.add("open-popupcontainer");

  popupcontainer.style.display = "none";
  reschedulePopupContainer.style.display = "block";
  const r_timeSlot_r = document.querySelector(".r_timeSlot_r");
  r_timeSlot_r.textContent = timeSlot;
}

function closeReschedulePopup() {
  reschedulePopup.classList.remove("open-popup");
  reschedulePopupContainer.classList.remove("open-popupcontainer");
  popupcontainer.style.display = "block";
  reschedulePopupContainer.style.display = "none";
}

function confirmReschedule() {
  // Add your redirection URL
  var redirectURL =
    "http://localhost/C&A_Indoor_Project/Pages/Calendar/manager?bookingID=" +
    bookingID;
  window.location.href = redirectURL;
}

function openCancelPopup() {
  // Hide the original popup and show the reschedulePopup
  console.log("Cancel button clicked");
  cancelPopup.classList.add("open-popup");
  cancelPopupContainer.classList.add("open-popupcontainer");

  popupcontainer.style.display = "none";
  cancelPopupContainer.style.display = "block";
  const cancel_bookingId = document.querySelector(".cancel_bookingId");
  cancel_bookingId.textContent = bookingID;
}

function closeCancelPopup() {
  cancelPopup.classList.remove("open-popup");
  cancelPopupContainer.classList.remove("open-popupcontainer");
  popupcontainer.style.display = "block";
  cancelPopupContainer.style.display = "none";
}
