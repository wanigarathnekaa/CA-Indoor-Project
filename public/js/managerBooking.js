let selectedSlots = [];
let totPrice = 0;

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

      const isToday = optionElement.hasAttribute("today-slot");
      const isBooked = optionElement.hasAttribute("data-booked");
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

function passValues() {
  // Convert the array to a JSON string before storing in localStorage
  const selectedSlotsString = JSON.stringify(selectedSlots);
  console.log(selectedSlotsString);

  localStorage.setItem("selectedSlots", selectedSlotsString);

  return false;
}

let popup = document.getElementById("SuccessPopup");

function openPopup() {
  popup.classList.add("open-popup");
}

function closePopup() {
  location.reload();
}
