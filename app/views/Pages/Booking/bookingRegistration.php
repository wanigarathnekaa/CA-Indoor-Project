<?php
$selected_date = isset($_GET['timedate']) ? urldecode($_GET['timedate']) : date('Y-m-d');
$bookingId = isset($_GET['bookingID']) ? urldecode($_GET['bookingID']) : 0;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Booking_Styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Booking Registration Form </title>
</head>

<body>

    <!-- Sidebar -->
    <?php
    $role = $_SESSION['user_role'];
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">
        <div class="container">

            <form action="<?php echo URLROOT; ?>/Bookings/register" method="POST" class="form">
                <!-- Left side - Personal Details -->
                <div class="details personal">
                    <header>Make Your Book</header>

                    <div class="input-field">
                        <label>Full Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name" required>
                    </div>

                    <div class="input-field">
                        <label>Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    </div>

                    <div class="input-field">
                        <label>Phone Number</label>
                        <input type="tel" name="phoneNumber" id="phoneNumber" placeholder="Enter your phone number"
                            pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number" required>
                    </div>

                    <span class="user-invalid"></span>
                </div>

                <!-- Right side - Booking Details -->
                <div class="details ID">
                    <!-- Display other information like time slots, date, coach name, etc. here -->

                    <div class="input-field">
                        <label>Booking Date</label>
                        <input type="date" name="date" value="<?php echo $selected_date; ?>" readonly required>
                    </div>

                    <table class="time-slots-table">
                        <thead>
                            <tr>
                                <th>Time Slot</th>
                                <th>Net Type</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div class="input-field">
                        <label>Who is the coach?</label>
                        <select name="coach" id="coach" required>
                            <option disabled selected>Select the coach</option>
                        </select>
                    </div>

                    <input type="hidden" name="timeSlotsAndNetTypes" id="timeSlotsAndNetTypes">

                    <input type="hidden" name="booking_delete_id" id="booking_delete_id" value=<?php echo $bookingId; ?>>

                    <!-- net price -->
                    <div class="input-field">
                        <label>Net Price</label>
                        <!-- <input type="text" name="netprice" id="netprice" > -->
                        <span id="netprice" name="bookingPrice" style="font-weight:500;font-size:20px;"></span>
                    </div>

                    <input type="hidden" name="bookingPrice" id="bookingPrice">


                    <button type="submit" name="booking">
                        <span class="btnText">Confirm</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>


    <!-- Script -->
    <script src="<?php echo URLROOT; ?>/js/bookingScript.js"></script>
    <script>
        $(document).ready(function () {
            $("#email").change(function (e) {
                e.preventDefault();
                var email = $("#email").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Users/getUserByEmail",
                    data: {
                        email: email
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        if (response == false) {
                            $(".user-invalid").text("User not found");
                        } else {
                            $(".user-invalid").text("");
                            $("#name").val(response.name);
                            $("#phoneNumber").val(response.phoneNumber);
                        }
                    }
                })
            });

            $('#coach').click(function () {
                var timeSlots = $("#timeSlotsAndNetTypes").val();
                var date = '<?php echo $selected_date; ?>'

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Coach/getAvailableCoaches",
                    data: {
                        timeSlots: timeSlots,
                        date: date
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        $("#coach").html(response.output);
                    }
                });
            });

            
        });

    </script>
</body>

</html>