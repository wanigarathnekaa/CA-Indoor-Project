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

                    <button id="timeSlotA" name="booking">
                        <span class="btnText">Normal Net A</span>
                    </button>

                    <button id="timeSlotB" name="booking">
                        <span class="btnText">Normal Net B</span>
                    </button>

                    <button id="timeSlotM" name="booking">
                        <span class="btnText">Machine Net</span>
                    </button>

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
                                <input type="checkbox" id="<?php echo str_replace(':', '', $ts); ?>"
                                    name="timeSlotA" value="<?php echo $ts; ?>">
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
                                <input type="checkbox" id="<?php echo str_replace(':', '', $ts); ?>"
                                    name="timeSlotB" value="<?php echo $ts; ?>">
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
                                <input type="checkbox" id="<?php echo str_replace(':', '', $ts); ?>"
                                    name="timeSlotM" value="<?php echo $ts; ?>">
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
                alert("Time slots for Normal Net A");
                $("#timeSlotsSectionA").css("display", "block");
            });

            $("#timeSlotB").on("click", function (e) {
                //Show Time slots
                e.preventDefault();
                alert("Time slots for Normal Net B");
                $("#timeSlotsSectionB").css("display", "block");
            });

            $("#timeSlotM").on("click", function (e) {
                //Show Time slots
                e.preventDefault();
                alert("Time slots for Machine Net");
                $("#timeSlotsSectionM").css("display", "block");
            });
        });
    </script>
</body>

</html>