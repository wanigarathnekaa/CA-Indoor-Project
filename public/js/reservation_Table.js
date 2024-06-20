function search() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("reservationTable");
  tr = table.getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {  // Start from index 1 to skip the header row
      var found = false;
      for (j = 1; j <= 7; j++) {  // Adjust the column range as needed
          td = tr[i].getElementsByTagName("td")[j];
          if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  found = true;
                  break;
              }
          }
      }

      if (found) {
          tr[i].style.display = "";
      } else {
          tr[i].style.display = "none";
      }
  }
}
