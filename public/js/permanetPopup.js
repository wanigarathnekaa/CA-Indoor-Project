

let popup2 = document.querySelector(".popup2");
let popupcontainer2 = document.querySelector(".popupcontainer2");



function openPermanentPopup(permanentBooking) {
      popup2.classList.add("open-popup2");
      popupcontainer2.classList.add("open-popupcontainer2");     
    
      const p_name = document.querySelector(".p_name");
      p_name.textContent = permanentBooking.name;

      const p_email = document.querySelector(".p_email");
      p_email.textContent = permanentBooking.email;

      const p_phone = document.querySelector(".p_phone");
      p_phone.textContent = permanentBooking.phoneNumber;

      const p_date = document.querySelector(".p_date");
      p_date.textContent = permanentBooking.date;

      const p_timeDuration = document.querySelector(".p_timeDuration");
      p_timeDuration.textContent = permanentBooking.timeDuration;

      const p_day = document.querySelector(".p_day");
      p_day.textContent = permanentBooking.day;

      



    
      
    
    }
    
function closePermanentPopup() {
      location.reload();
      popup2.classList.remove("open-popup2");
      popupcontainer2.classList.remove("open-popupcontainer2");
}
    