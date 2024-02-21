let popup = document.getElementById("popup");
let popupcontainer = document.getElementById("popupcontainer");
// let reschedulePopupContainer = document.getElementById("reschedulePopupContainer");
let deletePopup = document.getElementById("deletepopup");
let numberOfDays = 0;
let timeSlot = "";
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
  console.log(numberOfDays);
}

function closePopup() {
  popup.classList.remove("open-popup");
  popupcontainer.classList.remove("open-popupcontainer");
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

function openReschedulePopup() {
  // Hide the original popup and show the reschedulePopup
  console.log("Reschedule button clicked");
  reschedulePopup.classList.add("open-reschedulePopup");
  popupcontainer.classList.add("open-popupcontainer");
  popup.classList.remove("open-popup");
  // reschedulePopupContainer.classList.add("open-popupcontainer");

  // popupcontainer.style.display = "none";
  // reschedulePopupContainer.style.display = "block";
  const r_timeSlot_r = document.querySelector(".r_timeSlot_r");
  r_timeSlot_r.textContent = timeSlot;
}

function closeReschedulePopup() {
  reschedulePopup.classList.remove("open-reschedulePopup");
  popup.classList.add("open-popup");
  // popupcontainer.classList.remove("open-popupcontainer");
  // reschedulePopupContainer.classList.remove("open-popupcontainer");
  popupcontainer.style.display = "block";
  reschedulePopupContainer.style.display = "none";
}

function confirmReschedule() {
  // Add your redirection URL
  var redirectURL = "http://localhost/C&A_Indoor_Project/Pages/Calendar/manager?bookingID=" + bookingID;
  window.location.href = redirectURL;
}
