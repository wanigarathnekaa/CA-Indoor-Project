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

  // Calculate the difference in days, rounding up to the nearest whole number
  numberOfDays = Math.ceil(
    (reservationDate - currentDate) / (1000 * 3600 * 24)
  );

  // If the reservation date is the same as the current date, set numberOfDays to 0
  if (reservationDate.toDateString() === currentDate.toDateString()) {
    numberOfDays = 0;
  }

  const r_payment = document.querySelector(".r_payment");
  r_payment.textContent = reservation.paymentStatus;
}

function closePopup() {
  location.reload();
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
  r_timeSlot_r.textContent = numberOfDays + " days";

  console.log(numberOfDays);
  const yesButton = document.querySelector(".yesButton");
  const noButton = document.querySelector(".noButton");


  if (numberOfDays == 1 || numberOfDays == 2) {
    const rescheduleDetails = document.querySelector(".rescheduleDetails");
    rescheduleDetails.innerHTML =
      "<h4>You Cannot Reschedule the Time Slot</h4><h4>" +
      numberOfDays +
      " Day before Your Reservation</h4>";
    yesButton.style.display = "none";
    noButton.textContent = "Okay";
    document.querySelector(".noButton").classList.add("center-btns");
  } else if (numberOfDays == 0) {
    const rescheduleDetails = document.querySelector(".rescheduleDetails");
    rescheduleDetails.innerHTML =
      "<h4>You Cannot Reschedule the Time Slot</h4><h4>Today Is Your Reservation</h4>";
    yesButton.style.display = "none";
    noButton.textContent = "Okay";
    document.querySelector(".noButton").classList.add("center-btns");
  }

  document.querySelector(".noButton").classList.remove("center-btns");
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
