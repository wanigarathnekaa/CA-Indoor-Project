<?php
$selectedTimeSlot = isset($_GET['timeslot']) ? urldecode($_GET['timeslot']) : '7.00 - 8.00';
$selected_date = isset($_GET['timedate']) ? urldecode($_GET['timedate']) : date('Y-m-d');
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Booking_Styles.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Booking Regisration Form </title>
</head>

<body>
    <div class="container">
        <header>Make Your Book</header>

        <form action="<?php echo URLROOT;?>/Bookings/register" method="POST">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Book only nets</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Full Name</label>
                            <input type="text" name="name" placeholder="Enter your name" required>
                        </div>

                        <div class="input-field">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="input-field">
                            <label>Mobile Number</label>
                            <input type="number" name="phoneNumber" placeholder="Enter mobile number" required>
                        </div>



                        <!-- <div class="input-field">
                            <label>NIC Number</label>
                            <input type="number" placeholder="Enter your ccupation" required>
                        </div> -->

                        <div class="input-field">
                            <label>Booking Date</label>
                            <input type="date" name="date" value="<?php echo $selected_date; ?>">
                        </div>

                        <div class="input-field">
                            <label>Time Slot</label>
                            <input type="text" name="timeSlot" value="<?php echo $selectedTimeSlot; ?>">
                        </div>

                        <div class="input-field">
                            <label>Who is the coach?</label>
                            <select name="coach" required>
                                <option disabled selected>Select the coach</option>
                                <option>Mr. Kamal</option>
                                <option>Mr. Namal</option>
                                <option>Mr. Wimal</option>
                                <option>Mr. Sunil</option>
                                <option>Mr. Nimal</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Net Type?</label>
                            <select name="net" required>
                                <option disabled selected>Select the Net</option>
                                <option>Normal Net A</option>
                                <option>Normal Net B</option>
                                <option>Machine Net</option>
                            </select>
                        </div>


                    </div>
                </div>

                <div class="details ID">

                    <button type="submit" name="booking">
                        <span class="btnText">Confirm</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>



    <script src="<?php echo URLROOT; ?>/js/bookingScript.js"></script>
</body>

</html>