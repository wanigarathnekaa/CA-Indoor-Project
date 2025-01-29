// JavaScript for Modal
var modal = document.getElementById("orderDetailsModal");

function openModal() {
    modal.style.display = "block";
    document.getElementById("form_type").value = "save";
}

function closeModal() {
  modal.style.display = "none";
  location.reload();
}