// JavaScript for Modal
var modal = document.getElementById("orderDetailsModal");
var modal1 = document.getElementById("myModal");
var modal2 = document.getElementById("cancelModal");


function openModal() {
    modal1.style.display = "block";
    document.getElementById("form_type").value = "save";
}

function openCancelModal() {
  modal2.style.display = "block";
}

function closeModal() {
  modal.style.display = "none";
  location.reload();
}

function closeCancelModal() {
  modal2.style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {
  const table = document.getElementById("coachTable");
  const rows = table.tBodies[0].rows;
  const rowsPerPage = 5; // Set the number of rows per page
  const totalPages = Math.ceil(rows.length / rowsPerPage);
  let currentPage = 1;

  showPage(currentPage);

  // Handle pagination click events
  document.querySelector(".pagination").addEventListener("click", function (e) {
    e.preventDefault();

    if (e.target.classList.contains("page-link")) {
      const pageClicked = e.target.textContent;

      if (pageClicked === "« Prev" && currentPage > 1) {
        currentPage--;
      } else if (pageClicked === "Next »" && currentPage < totalPages) {
        currentPage++;
      } else if (!isNaN(pageClicked)) {
        currentPage = parseInt(pageClicked);
      }

      showPage(currentPage);
    }
  });

  // Function to display the specified page
  function showPage(pageNumber) {
    const startIndex = (pageNumber - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;

    for (let i = 0; i < rows.length; i++) {
      rows[i].style.display = i >= startIndex && i < endIndex ? "" : "none";
    }

    updatePaginationButtons();
  }

  // Function to update the state of pagination buttons
  function updatePaginationButtons() {
    const prevButton = document.querySelector(".pagination li:first-child a");
    const nextButton = document.querySelector(".pagination li:last-child a");

    prevButton.classList.toggle("disabled", currentPage === 1);
    nextButton.classList.toggle("disabled", currentPage === totalPages);

    document
      .querySelectorAll(".pagination li:not(:first-child):not(:last-child) a")
      .forEach((link, index) => {
        const page = index + 1;
        link.textContent = page;
        link.classList.toggle("active", page === currentPage);
      });
  }
});
