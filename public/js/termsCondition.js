document.addEventListener("DOMContentLoaded", function () {
      const tabs = document.querySelectorAll(".tab_item");
      const tabListItems = document.querySelectorAll(".tabs_list li");
      const nextButton = document.querySelector(".agree1");
      const nextButton2 = document.querySelector(".agree3");
      const nextButton3 = document.querySelector(".agree2");
      const nextButton4 = document.querySelector(".agree4");
    
    
    
      // Function to show a specific tab
      function showTab(tabId) {
        tabs.forEach(tab => {
          tab.style.display = "none";
        });
        document.querySelector(`.${tabId}`).style.display = "block";
      }
    
      // Function to update the active tab in the tab list
      function updateActiveTab(tabId) {
        tabListItems.forEach(tabListItem => {
          tabListItem.classList.remove("active");
        });
        document.querySelector(`[data-tc="${tabId}"]`).classList.add("active");
      }
    
      // Event listener for "Next" button click
      nextButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default form submission behavior
    
        const currentTab = document.querySelector(".tabs_list li.active");
        const currentTabId = currentTab.getAttribute("data-tc");
    
        // Find the next tab
        let nextTabId = "";
        for (let i = 0; i < tabListItems.length; i++) {
          if (tabListItems[i] === currentTab) {
            nextTabId = tabListItems[i + 1].getAttribute("data-tc");
            break;
          }
        }
    
        // Show the next tab
        if (nextTabId) {
          showTab(nextTabId);
          updateActiveTab(nextTabId);
        } else {
          // If there's no next tab and it's the Payment tab, redirect to Cricket Shop
          if (currentTabId === "tab_item_2") {
            window.location.href = 'cricket_shop.html';
          } else {
            // Handle other scenarios or provide an alert/message
            alert("No next tab found.");
          }
        }
      });
      
     
       nextButton2.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default form submission behavior
    
        const currentTab = document.querySelector(".tabs_list li.active");
        const currentTabId = currentTab.getAttribute("data-tc");
    
        // Find the next tab
        let nextTabId = "";
        for (let i = 0; i < tabListItems.length; i++) {
          if (tabListItems[i] === currentTab) {
            nextTabId = tabListItems[i + 1].getAttribute("data-tc");
            break;
          }
        }
    
        // Show the next tab
        if (nextTabId) {
          showTab(nextTabId);
          updateActiveTab(nextTabId);
        } else {
          // If there's no next tab and it's the Payment tab, redirect to Cricket Shop
          if (currentTabId === "tab_item_3") {
            window.location.href = 'cricket_shop.html';
          } else {
            // Handle other scenarios or provide an alert/message
            alert("No next tab found.");
          }
        }
      });
      
      nextButton3.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default form submission behavior
    
        const currentTab = document.querySelector(".tabs_list li.active");
        const currentTabId = currentTab.getAttribute("data-tc");
    
        // Find the next tab
        let nextTabId = "";
        for (let i = 0; i < tabListItems.length; i++) {
          if (tabListItems[i] === currentTab) {
            nextTabId = tabListItems[i -1].getAttribute("data-tc");
            break;
          }
        }
    
        // Show the next tab
        if (nextTabId) {
          showTab(nextTabId);
          updateActiveTab(nextTabId);
        } else {
          // If there's no next tab and it's the Payment tab, redirect to Cricket Shop
          if (currentTabId === "tab_item_1") {
            window.location.href = 'cricket_shop.html';
          } else {
            // Handle other scenarios or provide an alert/message
            alert("No next tab found.");
          }
        }
      });
      nextButton4.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default form submission behavior
    
        const currentTab = document.querySelector(".tabs_list li.active");
        const currentTabId = currentTab.getAttribute("data-tc");
    
        // Find the next tab
        let nextTabId = "";
        for (let i = 0; i < tabListItems.length; i++) {
          if (tabListItems[i] === currentTab) {
            nextTabId = tabListItems[i -1].getAttribute("data-tc");
            break;
          }
        }
    
        // Show the next tab
        if (nextTabId) {
          showTab(nextTabId);
          updateActiveTab(nextTabId);
        } else {
          // If there's no next tab and it's the Payment tab, redirect to Cricket Shop
          if (currentTabId === "tab_item_2") {
            window.location.href = 'cricket_shop.html';
          } else {
            // Handle other scenarios or provide an alert/message
            alert("No next tab found.");
          }
        }
      });
      
      
    });
    
    
    
    
    