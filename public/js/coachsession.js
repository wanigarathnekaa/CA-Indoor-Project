let popupcontainer3 = document.querySelector(".popupcontainer3");
let coachpopup = document.querySelector(".coachpopup");

function openPopupCoachSession(session) {
      coachpopup.classList.add("open-coachpopup");
      popupcontainer3.classList.add("open-popupcontainer3");

      const c_date = document.querySelector(".c_date");
      c_date.textContent = session.date;

      const c_time = document.querySelector(".c_time");
      c_time.textContent = session.timeSlot;

      const c_customer = document.querySelector(".c_customer");
      c_customer.textContent = session.name;

      const c_email = document.querySelector(".c_email");
      c_email.textContent = session.email;

      const c_phone = document.querySelector(".c_phone");
      c_phone.textContent = session.phoneNumber;

      const c_net = document.querySelector(".c_net");
      c_net.textContent = session.netType;
}

function closePopupCoachSession(){
      coachpopup.classList.remove("open-coachpopup");
      popupcontainer3.classList.remove("open-popupcontainer3");
}