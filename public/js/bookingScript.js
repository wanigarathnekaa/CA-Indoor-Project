var timeSlots = localStorage.getItem('selectedSlots');
console.log("These are the timeSlots");
console.log(timeSlots);

// Parse the JSON string to convert it back to an array
var timeSlotArray = JSON.parse(timeSlots) || [];

// Function to dynamically create and append table rows
function createTableRows(array, container) {
    array.forEach(function (item) {
        var row = document.createElement('tr');
        row.classList.add('table-row'); // Add a class for styling
        
        var timeSlotCell = document.createElement('td');
        timeSlotCell.textContent = item.timeSlot;
        row.appendChild(timeSlotCell);
        
        var netTypeCell = document.createElement('td');
        netTypeCell.textContent = item.netType;
        row.appendChild(netTypeCell);

        container.appendChild(row);
    });
}

// Run the function to create table rows for time slots
var timeSlotTable = document.querySelector('.time-slots-table');
createTableRows(timeSlotArray, timeSlotTable);
