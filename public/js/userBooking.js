let selectedSlots = [];
let totPrice = 0;
let paidPrice = 0;
let selected_date = "";
let coach = "No Coach";

class CustomSelect {
  constructor(originalSelect) {
    this.originalSelect = originalSelect;
    this.customSelect = document.createElement("div");
    this.customSelect.classList.add("select");

    // Initialize the Confirm Reservation button
    this.confirmationForm = document.getElementById("confirmationForm");
    this.confirmButton = this.confirmationForm.querySelector(".confBut");

    // Bind the update button visibility function to the instance
    this.updateButtonVisibility = this.updateButtonVisibility.bind(this);

    this.originalSelect.querySelectorAll("option").forEach((optionElement) => {
      const itemElement = document.createElement("div");

      itemElement.classList.add("select__item");
      itemElement.textContent = optionElement.textContent;

      const isBooked = optionElement.hasAttribute("data-booked");
      const isToday = optionElement.hasAttribute("today-slot");

      if (isBooked) {
        itemElement.classList.add("select__item--booked");
        itemElement.setAttribute("data-booked", "true");
      }

      if (isToday) {
        itemElement.classList.add("select__item--today");
        itemElement.setAttribute("today-slot", "true");
      }

      this.customSelect.appendChild(itemElement);

      if (optionElement.selected) {
        this._select(itemElement, optionElement);
        this._storeSelectedDetails(optionElement);
      }

      itemElement.addEventListener("click", () => {
        if (
          this.originalSelect.multiple &&
          itemElement.classList.contains("select__item--selected")
        ) {
          this._deselect(itemElement, optionElement);
        } else if (!isBooked && !isToday) {
          this._select(itemElement, optionElement);
          this._storeSelectedDetails(optionElement);
        }
      });
    });

    this.originalSelect.insertAdjacentElement("afterend", this.customSelect);
    this.originalSelect.style.display = "none";
  }

  updateButtonVisibility() {
    if (selectedSlots.length > 0) {
      this.confirmationForm.style.display = "block";
    } else {
      this.confirmationForm.style.display = "none";
    }
  }

  _select(itemElement, optionElement) {
    const index = Array.from(this.customSelect.children).indexOf(itemElement);

    if (!this.originalSelect.multiple) {
      this.customSelect.querySelectorAll(".select__item").forEach((el) => {
        el.classList.remove("select__item--selected");
      });
      // selectedSlots = [];
    }

    this.originalSelect.querySelectorAll("option")[index].selected = true;
    itemElement.classList.add("select__item--selected");

    const selectedSlot = {
      timeSlot: optionElement.getAttribute("value"),
      netType: optionElement.getAttribute("data-net-type"),
      date: optionElement.getAttribute("data-date"),
    };
    selectedSlots.push(selectedSlot);

    this.updateButtonVisibility();
  }

  _deselect(itemElement, optionElement) {
    const index = Array.from(this.customSelect.children).indexOf(itemElement);
    const deselectedSlot = selectedSlots.find(
      (slot) =>
        slot.timeSlot === optionElement.getAttribute("value") &&
        slot.netType === optionElement.getAttribute("data-net-type")
    );

    if (deselectedSlot) {
      this.originalSelect.querySelectorAll("option")[index].selected = false;
      itemElement.classList.remove("select__item--selected");
      selectedSlots = selectedSlots.filter((slot) => slot !== deselectedSlot);

      // Log the updated array to the console
      console.log("Selected Slots Array:", selectedSlots);

      this.updateButtonVisibility();
    }
  }

  _storeSelectedDetails(optionElement) {
    const selectedDetails = {
      timeSlot: optionElement.getAttribute("value"),
      netType: optionElement.getAttribute("data-net-type"),
      date: optionElement.getAttribute("data-date"),
    };

    // Log the selected details and array to the console
    console.log("Selected Details:", selectedDetails);
    console.log("Selected Slots Array:", selectedSlots);
  }
}

document.querySelectorAll(".custom-select").forEach((selectElement) => {
  new CustomSelect(selectElement);
});

let popup = document.getElementById("popup");
let popupcontainer = document.getElementById("popupcontainer");

function openPopup(date) {
  selected_date = date;
  console.log("Open popup");
  popup.classList.add("open-popup");
  popupcontainer.classList.add("open-popupcontainer");

  // Set event listener for Make Payment button
  document
    .getElementById("makePaymentBtn")
    .addEventListener("click", function () {
      paidPrice = totPrice;
      makePayment();
    });

  document
    .getElementById("makePaymentBtnCon")
    .addEventListener("click", function () {
      paidPrice = totPrice * 0.3;
      makePayment();
    });

  document.getElementById("coach").addEventListener("click", function () {
    var timeSlot = selectedSlots.map((slot) => slot.timeSlot);
    var date = selected_date;
    var selectElement = document.getElementById("coach");
    selectElement.innerHTML = "<option value=''>--Available Coach--</option>";

          // Clear existing options
    selectElement.innerHTML = "<option value=''>--Availabe Coach--</option>";
    var xhr = new XMLHttpRequest();

    var postData = {
      date: date,
      timeSlots: timeSlot,
    };

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          console.log(xhr.responseText);
          var responseObject = JSON.parse(xhr.responseText);
          
          responseObject.forEach(function (coach) {
            var option = document.createElement("option");
            option.value = coach.email; // Set the value to the coach id if needed
            option.textContent = coach.uid + " - " + coach.name;
            selectElement.appendChild(option);
          });
        } else {
          // Handle error, show an error message, etc.
          console.error("Error in XMLHttpRequest. Status:", xhr.status);
        }
      }
    };

    xhr.open("POST", "C&A_Indoor_Project/Coach/getCoachesAvailable");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(postData));
  });

  document.getElementById("coach").addEventListener("change", function () {
    coach = document.getElementById("coach").value;
    console.log(coach);
  });

  // Set event listener for Cancel button
  document.getElementById("cancelBtn").addEventListener("click", closePopup);

  let row = "";
  let totalPrice = 0;
  tbody = document.getElementById("popupTableBody");

  selectedSlots.forEach(data_to_table);

  function data_to_table(item) {
    if (item.netType === "Normal Net A" || item.netType === "Normal Net B") {
      totalPrice += 1000;
    } else {
      totalPrice += 1500;
    }
    row +=
      "<tr>" +
      "<td>" +
      item.timeSlot +
      "</td>" +
      "<td>" +
      item.netType +
      "</td>" +
      "</tr>";
  }

  tbody.innerHTML = row;
  const payment = document.querySelector(".payment");
  payment.textContent = totalPrice + " LKR";

  const con_payment = document.querySelector(".con_payment");
  con_payment.textContent = totalPrice * 0.3 + " LKR";

  totPrice = totalPrice;
}

function closePopup() {
  popup.classList.remove("open-popup");
  popupcontainer.classList.remove("open-popupcontainer");

  // Remove event listeners when closing the popup
  document
    .getElementById("makePaymentBtn")
    .removeEventListener("click", makePayment);
  document.getElementById("cancelBtn").removeEventListener("click", closePopup);

  document
    .getElementById("makePaymentBtnCon")
    .removeEventListener("click", makePayment);
  document.getElementById("cancelBtn").removeEventListener("click", closePopup);
}

function makePayment() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Log the response to the console
      console.log(xhttp.responseText);
      var obj = JSON.parse(xhttp.responseText);

      // Payment completed. It can be a successful failure.
      // ... (your existing code)

      // Payment completed. It can be a successful failure.
      payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);

        // Payment completed. It can be a successful failure.
        var xhr = new XMLHttpRequest();

        var postData = {
          name: obj["first_name"],
          email: obj["email"],
          phone: obj["phone"],
          date: selected_date,
          coach: coach,
          timeSlots: JSON.stringify(selectedSlots),
          bookingPrice: totPrice,
          paymentStatus: "Paid",
          paidPrice: paidPrice,
        };

        console.log(postData);

        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4) {
            if (xhr.status == 200) {
              // Log the response to the console
              console.log(xhr.responseText);
              var responseObject = JSON.parse(xhr.responseText);

              if (responseObject.status === "success") {
                location.reload();
              }
            } else {
              // Handle error, show an error message, etc.
              console.error("Error in XMLHttpRequest. Status:", xhr.status);
            }
          }
        };

        xhr.open("POST", "C&A_Indoor_Project/Bookings/BookingRegister");
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify(postData));

        // ... (rest of your existing code)
      };
      // ... (rest of your existing code)

      // Payment window closed
      payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
      };

      // Error occurred
      payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:" + error);
      };

      // Put the payment variables here
      var payment = {
        sandbox: true,
        merchant_id: obj["merchant_id"],
        return_url:
          "http://localhost/C&A_Indoor_Project/Pages/User_Booking/user", // Important
        cancel_url:
          "http://localhost/C&A_Indoor_Project/Pages/User_Booking/user", // Important
        notify_url: "http://sample.com/notify",
        order_id: obj["order_id"],
        items: obj["items"],
        amount: paidPrice,
        currency: obj["currency"],
        hash: obj["hash"], // *Replace with generated hash retrieved from backend
        first_name: obj["first_name"],
        last_name: obj["last_name"],
        email: obj["email"],
        phone: obj["phone"],
        address: obj["address"],
        city: obj["city"],
        country: "Sri Lanka",
        delivery_address: "No. 46, Galle road, Kalutara South",
        delivery_city: "Kalutara",
        delivery_country: "Sri Lanka",
        custom_1: "",
        custom_2: "",
      };
      console.log(payment);
      payhere.startPayment(payment);
    }
  };

  // xhttp.setRequestHeader('Content-Type', 'application/json');
  xhttp.open(
    "GET",
    "C&A_Indoor_Project/Pages/Payment/user?amount=" + String(paidPrice),
    true
  );
  xhttp.send();
}

function closePopupSuccess() {
  location.reload();
}
