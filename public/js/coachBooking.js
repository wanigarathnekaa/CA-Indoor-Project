let selectedSlots = [];
let totPrice = 0;
let paidPrice = 0;
let selected_date = "";

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

      const isReserved = optionElement.hasAttribute("data-reserved");
      const isBooked = optionElement.hasAttribute("data-booked");
      if (isBooked) {
        itemElement.classList.add("select__item--booked");
        itemElement.setAttribute("data-booked", "true");
      }

      if (isReserved) {
        itemElement.classList.add("select__item--reserved");
        itemElement.setAttribute("data-reserved", "true");
      }

      this.customSelect.appendChild(itemElement);

      if (optionElement.selected) {
        this._select(itemElement, optionElement);
        this._storeSelectedDetails(optionElement);
      }

      itemElement.onclick = function () {
        if (
          this.originalSelect.multiple &&
          itemElement.classList.contains("select__item--selected")
        ) {
          this._deselect(itemElement, optionElement);
        } else if (!isBooked && !isReserved) {
          this._select(itemElement, optionElement);
          this._storeSelectedDetails(optionElement);
        }

        // Add your onclick logic here
        if (isBooked) {
            var optionValue = optionElement.getAttribute("value");
            console.log("Option Value:", optionValue);
            var optionDate = optionElement.getAttribute("date");
            console.log("Option Date:", optionDate);
            $.ajax({
                url: "http://localhost/C&A_Indoor_Project/Coach/removeAvailability",
                method: "POST",
                data: {
                    optionValue: optionValue,
                    optionDate: optionDate,
                },
                success: function (data) {
                    console.log("Data:", data);
                    location.reload();
                },
                error: function (error) {
                    console.log("Error:", error);
                },
            });
        }
      }.bind(this);
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
