let popup2 = document.querySelector(".popup2");
let popupcontainer2 = document.querySelector(".popupcontainer2");



//Previous reservation
function openPopup2(reservation) {
      popup2.classList.add("open-popup2");
      popupcontainer2.classList.add("open-popupcontainer2");
    
      const p_id = document.querySelector(".p_id");
      p_id.textContent = reservation.id;
    
      const p_name = document.querySelector(".p_name");
      p_name.textContent = reservation.name;
    
      const p_date = document.querySelector(".p_date");
      p_date.textContent = reservation.date;
    
      const p_net = document.querySelector(".p_net");
      p_net.textContent = reservation.netType;
    
      const p_timeSlot = document.querySelector(".p_timeSlot");
      p_timeSlot.textContent = reservation.timeSlot;
    
      // timeSlot = reservation.timeSlot;
      // bookingID = reservation.booking_id;
    
      // Calculate the number of days
      // const reservationDate = new Date(reservation.date);
      // const currentDate = new Date();
    
      // Calculate the difference in days, rounding up to the nearest whole number
      // numberOfDays = Math.ceil(
      //   (reservationDate - currentDate) / (1000 * 3600 * 24)
      // );
    
      // If the reservation date is the same as the current date, set numberOfDays to 0
      // if (reservationDate.toDateString() === currentDate.toDateString()) {
      //   numberOfDays = 0;
      // }

      const p_price = document.querySelector(".p_price");
      p_price.textContent = reservation.bookingPrice;

      const p_paid = document.querySelector(".p_paid");
      p_paid.textContent = reservation.paidPrice;


    
      const p_payment = document.querySelector(".p_payment");
      p_payment.textContent = reservation.paymentStatus;
    }
    
    function closePopup2() {
      location.reload();
      popup2.classList.remove("open-popup2");
      popupcontainer2.classList.remove("open-popupcontainer2");
    }