const body = document.querySelector("body"),
      sidebar = body.querySelector(".sidebar"),
      toggle = body.querySelector(".toggle");

      toggle.addEventListener("click", () => {
        console.log("Toggle button clicked.");
        sidebar.classList.toggle("close");
      });