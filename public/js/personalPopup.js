let popup = document.getElementById("popup");
let popupcontainer = document.getElementById("popupcontainer");
let reschedulePopupContainer = document.getElementById("reschedulePopupContainer");
let cancelReschedule = document.getElementById("cancelReschedule");
let cancelReschedulePopup = document.getElementById("cancelReschedulePopup");

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

  const r_price = document.querySelector(".r_price");
  r_price.textContent = reservation.bookingPrice;

  const r_paid = document.querySelector(".r_paid");
  r_paid.textContent = reservation.paidPrice;
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
  const button = document.querySelector("#rescheduleButtons");

  if (numberOfDays == 1 || numberOfDays == 2) {
    const rescheduleDetails = document.querySelector(".rescheduleDetails");
    button.classList.add("center-btns");
    rescheduleDetails.innerHTML =
      "<h4>You <span style='font-weight: 700; font-style: italic;'>Cannot</span> Reschedule the Time Slot</h4><h4>" +
      numberOfDays +
      " Day before Your Reservation</h4>";
    yesButton.style.display = "none";
    noButton.textContent = "Okay";
  } else if (numberOfDays == 0) {
    const rescheduleDetails = document.querySelector(".rescheduleDetails");
    button.classList.add("center-btns");
    rescheduleDetails.innerHTML =
      "<h4>You <span style='font-weight: 700; font-style: italic;'>Cannot</span> Reschedule the Time Slot</h4><h4>Today Is Your Reservation</h4>";
    yesButton.style.display = "none";
    noButton.textContent = "Okay";
  }
}

function closeReschedulePopup() {
  reschedulePopup.classList.remove("open-popup");
  reschedulePopupContainer.classList.remove("open-popupcontainer");
  popupcontainer.style.display = "block";
  reschedulePopupContainer.style.display = "none";
}

function openCancelReschedulePopup() {
  // Hide the original popup and show the reschedulePopup
  console.log("Reschedule button clicked");
  cancelReschedulePopup.classList.add("open-popup");
  cancelReschedule.classList.add("open-popupcontainer");

  popupcontainer.style.display = "none";
  cancelReschedule.style.display = "block";
  const r_timeSlot_cancel = document.querySelector(".r_timeSlot_cancel");
  r_timeSlot_cancel.textContent = numberOfDays + " days";

  console.log(numberOfDays);
  const yesButton = document.querySelector(".yesButtonCancel");
  const noButton = document.querySelector(".noButtonCancel");
  const button = document.querySelector("#cancelRescheduleButtons");

  if (numberOfDays == 1 || numberOfDays == 2) {
    const rescheduleDetails = document.querySelector(".cancelRescheduleDetails");
    button.classList.add("center-btns");
    rescheduleDetails.innerHTML =
      "<h4>You <span style='font-weight: 700; font-style: italic;'>Cannot</span> Cancel the Time Slot</h4><h4>" +
      numberOfDays +
      " Day before Your Reservation</h4>";
    yesButton.style.display = "none";
    noButton.textContent = "Okay";
  } else if (numberOfDays == 0) {
    const rescheduleDetails = document.querySelector(".cancelRescheduleDetails");
    button.classList.add("center-btns");
    rescheduleDetails.innerHTML =
      "<h4>You <span style='font-weight: 700; font-style: italic;'>Cannot</span> Cancel the Time Slot</h4><h4>Today Is Your Reservation</h4>";
    yesButton.style.display = "none";
    noButton.textContent = "Okay";
  }
}

function closeCancelReschedulePopup() {
  cancelReschedulePopup.classList.remove("open-popup");
  cancelReschedule.classList.remove("open-popupcontainer");
  popupcontainer.style.display = "block";
  cancelReschedule.style.display = "none";
}

function confirmReschedule() {
  // Add your redirection URL
  var redirectURL =
    "http://localhost/C&A_Indoor_Project/Pages/Calendar/manager?bookingID=" +
    bookingID;
  window.location.href = redirectURL;
}



