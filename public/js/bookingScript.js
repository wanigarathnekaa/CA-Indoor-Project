var timeSlots = localStorage.getItem("selectedSlots");

// Parse the JSON string to convert it back to an array
var timeSlotArray = JSON.parse(timeSlots) || [];

// Function to dynamically create and append table rows
function createTableRows(array, container) {
  array.forEach(function (item) {
    var row = document.createElement("tr");
    row.classList.add("table-row"); // Add a class for styling

    var timeSlotCell = document.createElement("td");
    timeSlotCell.textContent = item.timeSlot;
    row.appendChild(timeSlotCell);

    var netTypeCell = document.createElement("td");
    netTypeCell.textContent = item.netType;
    row.appendChild(netTypeCell);

    container.appendChild(row);
  });
}

// Run the function to create table rows for time slots
var timeSlotTable = document.querySelector(".time-slots-table");
createTableRows(timeSlotArray, timeSlotTable);

// Update the hidden input field with the array values
document.getElementById("timeSlotsAndNetTypes").value = timeSlots;
console.log(timeSlots);




// Calculate the total price
let totprice = 0;


for (var i = 0; i < timeSlotArray.length; i++) {
  console.log(timeSlotArray[i].timeSlot);
  console.log(timeSlotArray[i].netType);
  console.log(timeSlotArray[i].date);

  if (timeSlotArray[i].netType == "Normal Net A") {
    totprice += 1000;
  }else if (timeSlotArray[i].netType == "Normal Net B") {
    totprice += 1000;
  }else if (timeSlotArray[i].netType == "Machine Net") {
    totprice += 1500;
  }
}

var netprice = document.getElementById("netprice");
netprice.textContent = "Total Price: " + totprice + " LKR";

document.getElementById("bookingPrice").value = totprice;