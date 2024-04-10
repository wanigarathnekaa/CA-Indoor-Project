let popup = document.getElementById("popup");
let popupcontainer = document.getElementById("popupcontainer");
// let reschedulePopupContainer = document.getElementById("reschedulePopupContainer");
let reschedulePopup = document.getElementById("reschedulePopup");

let deletePopup = document.getElementById("deletepopup");
let numberOfDays = 0;
let timeSlot = "";
let cancelTimeSlot = "";
let bookingID = 0;


// details popup
function openPopup(reservation) {
  popup.classList.add("open-popup");
  popupcontainer.classList.add("open-popupcontainer");

  const r_id = document.querySelector(".r_id");
  r_id.textContent = reservation.id;

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
  r_net.textContent = reservation.netType;

  timeSlot = reservation.timeSlot;
  bookingID = reservation.booking_id;

  // Calculate the number of days
  const reservationDate = new Date(reservation.date);
  const currentDate = new Date();
  const timeDifference = reservationDate.getTime() - currentDate.getTime();
  numberOfDays = Math.ceil(timeDifference / (1000 * 3600 * 24)); // Convert milliseconds to days

  if (reservationDate.toDateString() === currentDate.toDateString()) {
    numberOfDays = 0;
  }

  console.log(numberOfDays);

  const r_payment = document.querySelector(".r_payment");
  r_payment.textContent = reservation.paymentStatus;
}

function closePopup() {
  popup.classList.remove("open-popup");
  popupcontainer.classList.remove("open-popupcontainer");
  location.reload();
}

// delete popup
function openDeletePopup(reservation) {
  deletePopup.classList.add("open-deletepopup");
  popupcontainer.classList.add("open-popupcontainer");

  var input = document.getElementById("hid_input");
  input.value = reservation.id;
  console.log(input.value);
}

function closeDeletePopup() {
  deletePopup.classList.remove("open-deletepopup");
  popupcontainer.classList.remove("open-popupcontainer");
}


//reschedule popup
function openReschedulePopup() {
  // Hide the original popup and show the reschedulePopup
  console.log("Reschedule button clicked");
  reschedulePopup.classList.add("open-reschedulePopup");
  popupcontainer.classList.add("open-popupcontainer");
  popup.classList.remove("open-popup");

  const yesButton = document.querySelector(".yesButton");
  const noButton = document.querySelector(".noButton");
  const button = document.querySelector("#rescheduleButtons");

  if (numberOfDays < 0) {
    const rescheduleDetails = document.querySelector(".rescheduleDetails");
    button.classList.add("center-btns");
    rescheduleDetails.innerHTML =
      "<h4>You <span style='font-weight: bold; font-style: italic;'>Cannot</span> Reschedule the Time Slot</h4><h4>" +
      (-numberOfDays) +
      " Days passed after Your Reservation</h4>";
    yesButton.style.display = "none";
    noButton.textContent = "Okay";
  } else if (numberOfDays == 0) {
    timeSlot = "Today Is Your Reservation"
  }else {
    timeSlot = numberOfDays+" Day(s) Left For the Reservation"
  }

  const r_timeSlot_r = document.querySelector(".r_timeSlot_r");
  r_timeSlot_r.textContent = timeSlot;
}

function closeReschedulePopup() {
  reschedulePopup.classList.remove("open-reschedulePopup");
  popup.classList.add("open-popup");
  popupcontainer.style.display = "block";
  reschedulePopupContainer.style.display = "none";
}


function confirmReschedule() {
  // Add your redirection URL
  var redirectURL = "http://localhost/C&A_Indoor_Project/Pages/Calendar/manager?bookingID=" + bookingID;
  window.location.href = redirectURL;
}

//Cancel Reservation Popup
function openCancelPopup() {
  // Hide the original popup and show the reschedulePopup
  console.log("Cancel button clicked");
  cancelPopup.classList.add("open-reschedulePopup");
  popupcontainer.classList.add("open-popupcontainer");
  popup.classList.remove("open-popup");

  const yesButton = document.querySelector(".cyesButton");
  const noButton = document.querySelector(".cnoButton");
  const button = document.querySelector("#cancelButtons");

  if (numberOfDays < 0) {
    const CancelDetails = document.querySelector(".CancelDetails");
    button.classList.add("center-btns");
    CancelDetails.innerHTML =
      "<h4>You <span style='font-weight: bold; font-style: italic;'>Cannot</span> Cancel the Reservation</h4><h4>" +
      (-numberOfDays) +
      " Days passed after Your Reservation</h4>";
    yesButton.style.display = "none";
    noButton.textContent = "Okay";
  } else if (numberOfDays == 0) {
    cancelTimeSlot = "Today Is Your Reservation"
  }else {
    cancelTimeSlot = numberOfDays+" Day(s) Left For the Reservation"
  }

  const cancel_timeSlot = document.querySelector(".cancel_timeSlot");
  cancel_timeSlot.textContent = cancelTimeSlot;
  const cancel_bookingId = document.querySelector(".cancel_bookingId");
  cancel_bookingId.textContent = bookingID;
}

function closeCancelPopup() {
  cancelPopup.classList.remove("open-reschedulePopup");
  popup.classList.add("open-popup");
  popupcontainer.style.display = "block";
  reschedulePopupContainer.style.display = "none";
}