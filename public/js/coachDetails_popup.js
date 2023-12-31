let popup = document.getElementById('popup');
let popupcontainer = document.getElementById('popupcontainer');
let deletePopup = document.getElementById('deletepopup');


// details popup
function openPopup(coach, user) {
      popup.classList.add("open-popup");
      popupcontainer.classList.add("open-popupcontainer");

      const c_name = document.querySelector(".c_name");
      c_name.textContent = user.name;

      const c_email = document.querySelector(".c_email");
      c_email.textContent = user.email;

      const c_mobile = document.querySelector(".c_mobile");
      c_mobile.textContent = user.mobile;

      const c_exp = document.querySelector(".c_exp");
      c_exp.textContent = coach.experience;

      const c_spl = document.querySelector(".c_spl");
      c_spl.textContent = coach.specialty;

      const c_cert = document.querySelector(".c_cert");
      c_cert.textContent = coach.certificate;
}

function closePopup() {
      popup.classList.remove("open-popup");
      popupcontainer.classList.remove("open-popupcontainer");
}


// delete popup
function openDeletePopup(){
      deletePopup.classList.add("open-deletepopup");
      popupcontainer.classList.add("open-popupcontainer");
}

function closeDeletePopup(){
      deletePopup.classList.remove("open-deletepopup");
      popupcontainer.classList.remove("open-popupcontainer");
}