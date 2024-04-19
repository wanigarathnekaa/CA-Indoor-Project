<?php
$duration = 60;
$cleanup = 0;
$start = "07:00";
$end = "22:00";
function time_slot($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots = array();

    for ($intStart = $start; $intStart < $end; $intStart->add($interval)) {
        $endPeriod = clone $intStart;
        // echo $endPeriod->format("H:iA");
        $endPeriod->add($interval);
        // echo $endPeriod->format("H:iA");

        if ($endPeriod > $end) {
            break;
        }

        $slots[] = $intStart->format("H:iA") . "-" . $endPeriod->format("H:iA");
    }

    return $slots;
}

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
    $role = "Manager";
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">
        <div class="container">

            <form method="POST" class="form">
                <!-- Left side - Personal Details -->
                <div class="details personal">
                    <header>Make Your Booking</header>

                    <div class="input-field">
                        <label>Full Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name">
                    </div>

                    <div class="input-field">
                        <label>Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email">
                    </div>

                    <div class="input-field">
                        <label>Phone Number</label>
                        <input type="tel" name="phoneNumber" id="phoneNumber" placeholder="Enter your phone number"
                            pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number">
                    </div>

                    <div class="input-field">
                        <label>Select Time Duration:</label>
                        <select name="timeDuration" required>
                            <option disabled selected>Select Time</option>
                            <option><?php echo "3 Months" ?></option>
                            <option><?php echo "6 Months" ?></option>
                            <option><?php echo "1 Year" ?></option>
                        </select>
                    </div>

                    <div class="input-field">
                        <label>Select Day:</label>
                        <select name="day" required>
                            <option disabled selected>Select The Day</option>
                            <option><?php echo "Sunday" ?></option>
                            <option><?php echo "Monday" ?></option>
                            <option><?php echo "Tuesday" ?></option>
                            <option><?php echo "Wednesday" ?></option>
                            <option><?php echo "Thursday" ?></option>
                            <option><?php echo "Friday" ?></option>
                            <option><?php echo "Saturday" ?></option>
                        </select>
                    </div>

                    <span class="user-invalid"></span>
                </div>

                <!-- Right side - Booking Details -->
                <div class="details ID">
                    <!-- Display other information like time slots, date, coach name, etc. here -->

                    <div class="input-field">
                        <label>From:</label>
                        <input type="date" name="date" id="date">
                    </div>

                    <div class="input-field">
                        <label>Who is the coach?</label>
                        <select name="coach" required>
                            <option disabled selected>Select the coach</option>
                            <?php foreach ($data as $coach): ?>
                                <option>
                                    <?php echo "{$coach->name}" ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="netbtnbar">
                        <button id="timeSlotA" name="booking" class="net">
                            <span class="btnText">Normal Net A</span>
                        </button>

                        <button id="timeSlotB" name="booking" class="net">
                            <span class="btnText">Normal Net B</span>
                        </button>

                        <button id="timeSlotM" name="booking" class="net">
                            <span class="btnText">Machine Net</span>
                        </button>
                    </div>

                    <button type="submit" name="booking">
                        <span class="btnText">Confirm</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- net A -->
        <div class="modal" id="timeSlotsSectionA" style="display: none;">
            <div class="modal-content">
                <h1 class="title">Normal Net A</h1>
                <div class="row">
                    <?php
                    $timeslots = time_slot($duration, $cleanup, $start, $end);
                    foreach ($timeslots as $ts) {
                        ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="<?php echo str_replace(':', '', $ts); ?>" name="timeSlotA"
                                    value="<?php echo $ts; ?>">
                                <label for="<?php echo str_replace(':', '', $ts); ?>" class="btn btn-danger">
                                    <?php echo $ts; ?>
                                </label>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="btn">
                    <input type="hidden" id="form_type" name="form_type">
                    <!-- <button type="button">Okay</button> -->
                    <button type="button" onclick="closeModalA()">Okay</button>
                </div>
            </div>
        </div>

        <!-- net B -->
        <div class="modal" id="timeSlotsSectionB" style="display: none;">
            <div class="modal-content">
                <h1 class="title">Normal Net B</h1>
                <div class="row">
                    <?php
                    $timeslots = time_slot($duration, $cleanup, $start, $end);
                    foreach ($timeslots as $ts) {
                        ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="<?php echo str_replace(':', '', $ts); ?>" name="timeSlotB"
                                    value="<?php echo $ts; ?>">
                                <label for="<?php echo str_replace(':', '', $ts); ?>" class="btn btn-danger">
                                    <?php echo $ts; ?>
                                </label>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="btn">
                    <input type="hidden" id="form_type" name="form_type">
                    <!-- <button type="button">Okay</button> -->
                    <button type="button" onclick="closeModalB()">Okay</button>
                </div>
            </div>
        </div>

        <!-- Machine net -->
        <div class="modal" id="timeSlotsSectionM" style="display: none;">
            <div class="modal-content">
                <h1 class="title">Machine Net</h1>
                <div class="row">
                    <?php
                    $timeslots = time_slot($duration, $cleanup, $start, $end);
                    foreach ($timeslots as $ts) {
                        ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="<?php echo str_replace(':', '', $ts); ?>" name="timeSlotM"
                                    value="<?php echo $ts; ?>">
                                <label for="<?php echo str_replace(':', '', $ts); ?>" class="btn btn-danger">
                                    <?php echo $ts; ?>
                                </label>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="btn">
                    <input type="hidden" id="form_type" name="form_type">
                    <!-- <button type="button">Okay</button> -->
                    <button type="button" onclick="closeModalM()">Okay</button>
                </div>
            </div>
        </div>
    </section>


    <!-- Script -->
    <script>
        function closeModalA() {
            $("#timeSlotsSectionA").hide();
        }
        function closeModalB() {
            $("#timeSlotsSectionB").hide();
        }
        function closeModalM() {
            $("#timeSlotsSectionM").hide();
        }

        $(document).ready(function () {
            let selectedTimeSlotsA = [];
            let selectedTimeSlotsB = [];
            let selectedTimeSlotsM = [];

            // Update selected time slots array on checkbox change
            $("input[name='timeSlotA']").on("change", function () {
                if ($(this).is(":checked")) {
                    selectedTimeSlotsA.push($(this).val());
                } else {
                    const index = selectedTimeSlotsA.indexOf($(this).val());
                    if (index > -1) {
                        selectedTimeSlotsA.splice(index, 1);
                    }
                }
                console.log(selectedTimeSlotsA); // Log the array to check
            });

            $("input[name='timeSlotB']").on("change", function () {
                if ($(this).is(":checked")) {
                    selectedTimeSlotsB.push($(this).val());
                } else {
                    const index = selectedTimeSlotsB.indexOf($(this).val());
                    if (index > -1) {
                        selectedTimeSlotsB.splice(index, 1);
                    }
                }
                console.log(selectedTimeSlotsB); // Log the array to check
            });

            $("input[name='timeSlotM']").on("change", function () {
                if ($(this).is(":checked")) {
                    selectedTimeSlotsM.push($(this).val());
                } else {
                    const index = selectedTimeSlotsM.indexOf($(this).val());
                    if (index > -1) {
                        selectedTimeSlotsM.splice(index, 1);
                    }
                }
                console.log(selectedTimeSlotsM); // Log the array to check
            });


            $("#email").on("input", function (e) {
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
                        if (response === false) {
                            $(".user-invalid").text("User not found");
                        } else {
                            $(".user-invalid").text("");
                            $("#name").val(response.name);
                            $("#phoneNumber").val(response.phoneNumber);
                        }
                    }
                });
            });

            $("#timeSlotA").on("click", function (e) {
                //Show Time slots
                e.preventDefault();
                $("#timeSlotsSectionA").css("display", "block");
            });

            $("#timeSlotB").on("click", function (e) {
                //Show Time slots
                e.preventDefault();
                $("#timeSlotsSectionB").css("display", "block");
            });

            $("#timeSlotM").on("click", function (e) {
                //Show Time slots
                e.preventDefault();
                $("#timeSlotsSectionM").css("display", "block");
            });

            //Submit the form
            $("form").on("submit", function (e) {
                e.preventDefault();
                var name = $("#name").val();
                var email = $("#email").val();
                var phoneNumber = $("#phoneNumber").val();
                var timeDuration = $("select[name='timeDuration']").val();
                var day = $("select[name='day']").val();
                var date = $("#date").val();
                var coach = $("select[name='coach']").val();

                // Convert arrays to JSON strings
                var timeSlotsA = JSON.stringify(selectedTimeSlotsA);
                var timeSlotsB = JSON.stringify(selectedTimeSlotsB);
                var timeSlotsM = JSON.stringify(selectedTimeSlotsM);

                // Check if the user has selected any time slots
                if (selectedTimeSlotsA.length === 0 && selectedTimeSlotsB.length === 0 && selectedTimeSlotsM.length === 0) {
                    alert("Please select a time slot");
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Bookings/permanentBooking",
                    data: {
                        name: name,
                        email: email,
                        phoneNumber: phoneNumber,
                        timeDuration: timeDuration,
                        day: day,
                        date: date,
                        coach: coach,
                        timeSlotsA: timeSlotsA,
                        timeSlotsB: timeSlotsB,
                        timeSlotsM: timeSlotsM
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status.trim() === "success") {
                            alert("Booking successful");
                            window.location.href = "http://localhost/C&A_Indoor_Project/Pages/Dashboard/manager";
                        } else {
                            alert("Booking failed");
                        }
                    }

                });
            });

            $("#date, select[name='timeDuration'], select[name='day']").on("change", function () {
                var date = $("#date").val();
                var timeDuration = $("select[name='timeDuration']").val();
                var day = $("select[name='day']").val();
                if (date && timeDuration && day) {
                    console.log(date, timeDuration, day);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo URLROOT; ?>/Bookings/checkBooking",
                        data: {
                            date: date,
                            timeDuration: timeDuration,
                            day: day,
                        },
                        success: function (response) {
                            response = JSON.parse(response);
                            if (response.status === "success") {
                                var bookings = response.data;
                                bookings.forEach(element => {
                                    var selectedDate = new Date(date);
                                    var endDateForSelectedDate = new Date(date);
                                    var bookingEndDate = new Date(element.date);
                                    var endDate = new Date(element.date);
                                    endDate.setMonth(endDate.getMonth() + parseInt(element.timeDuration.split(" ")[0])); // Add time duration in months
                                    endDateForSelectedDate.setMonth(endDateForSelectedDate.getMonth() + parseInt(timeDuration.split(" ")[0])); // Add time duration in months
                                    timeSlotsA = JSON.parse(element.timeSlotA);
                                    timeSlotsB = JSON.parse(element.timeSlotB);
                                    timeSlotsM = JSON.parse(element.timeSlotM);
                                    console.log(bookingEndDate <= endDateForSelectedDate);

                                    if ((selectedDate >= new Date(element.date) && selectedDate <= endDate && day === element.day) ||
                                        (selectedDate <= new Date(element.date) && bookingEndDate <= endDateForSelectedDate && day === element.day)) {

                                        // Disable time slots for net A
                                        timeSlotsA.forEach(slot => {
                                            $("input[name='timeSlotA'][value='" + slot + "']").prop("disabled", true);
                                        });

                                        // Disable time slots for net B
                                        timeSlotsB.forEach(slot => {
                                            $("input[name='timeSlotB'][value='" + slot + "']").prop("disabled", true);
                                        });

                                        // Disable time slots for machine net
                                        timeSlotsM.forEach(slot => {
                                            $("input[name='timeSlotM'][value='" + slot + "']").prop("disabled", true);
                                        });

                                    } else {
                                        timeSlotsA.forEach(slot => {
                                            $("input[name='timeSlotA'][value='" + slot + "']").prop("disabled", false);
                                        });

                                        // Disable time slots for net B
                                        timeSlotsB.forEach(slot => {
                                            $("input[name='timeSlotB'][value='" + slot + "']").prop("disabled", false);
                                        });

                                        // Disable time slots for machine net
                                        timeSlotsM.forEach(slot => {
                                            $("input[name='timeSlotM'][value='" + slot + "']").prop("disabled", false);
                                        });                                    }
                                });
                            } else {
                                alert("Booking not available");
                            }
                        }
                    });
                }
            });


        });
    </script>
</body>

</html>