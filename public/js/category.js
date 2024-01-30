// JavaScript for Modal
var modal = document.getElementById("myModal");

function openModal() {
  modal.style.display = "block";
}

function closeModal() {
  modal.style.display = "none";
  location.reload();
}

function saveCategory() {
    // Get form data
    var formData = new FormData(document.getElementById("categoryForm"));

    // AJAX request
    $.ajax({
        url: "/C&A_Indoor_Project/Category/saveCategory",
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (response) {
            // Handle server response
            if (response.success) {
                // If successful, close the modal or perform other actions
                closeModal();
            } else {
                // If validation fails, display the error message
                $("#categoryNameError").html(response.categoryName_err);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", error);
        }
    });
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

      if (pageClicked === "Prev" && currentPage > 1) {
        currentPage--;
      } else if (pageClicked === "Next" && currentPage < totalPages) {
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