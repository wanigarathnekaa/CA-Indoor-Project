let popup = document.getElementById('popup');
let popupcontainer = document.getElementById('popupcontainer');
let deletePopup = document.getElementById('deletepopup');


// details popup
function openPopup(manager) {
      console.log(manager);
      popup.classList.add("open-popup");
      popupcontainer.classList.add("open-popupcontainer");

      const m_name = document.querySelector(".m_name");
      m_name.textContent = manager.name;

      const m_email = document.querySelector(".m_email");
      m_email.textContent = manager.email;

      const m_number = document.querySelector(".m_number");
      m_number.textContent = manager.phoneNumber;

      const m_nic = document.querySelector(".m_nic");
      m_nic.textContent = manager.nic;

      const m_address = document.querySelector(".m_address");
      m_address.textContent = manager.strAddress + "," + manager.city;

   
}

function closePopup() {
      popup.classList.remove("open-popup");
      popupcontainer.classList.remove("open-popupcontainer");
}


// delete popup
function openDeletePopup(manager){
      deletePopup.classList.add("open-deletepopup");
      popupcontainer.classList.add("open-popupcontainer");

      var input = document.getElementById("hid_input");
      input.value = manager.email;
}

function closeDeletePopup(){
      deletePopup.classList.remove("open-deletepopup");
      popupcontainer.classList.remove("open-popupcontainer");
}