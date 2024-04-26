<!--  -->
<!DOCTYPE html>
<html>
<head>
    <title>Booking Report for Selected Date Range</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bookingFilter.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<?php
$role = $_SESSION['user_role'];
require APPROOT.'/views/Pages/Dashboard/header.php';
require APPROOT.'/views/Components/Side Bars/sideBar.php';
?>
<section class="home">
    <div class='container pt-5'>
        <h1 class='text-center text-primary'>Account Logs for Selected Date Range</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <!-- <h2 class="text-success">Filter Bookings</h2> -->

                <form action="<?php echo URLROOT;?>/Reports/Userlogs" method="post">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="text" name="invoice_date" id="start_date" class="form-control datepicker" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="text" name="invoice_due_date" id="end_date" class="form-control datepicker" required>
                    </div>
                    <div class="btn-container">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary">
                        <input type="submit" name="view_pdf" value="View" class="btn btn-primary">
                        <input type="submit" name="download_pdf" value="Download" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if ($data && isset($data['bookings'])) {
        if (count($data['bookings']) > 0) {
            echo "<div class='alert alert-success'>Filtered User Logs:</div>";
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>User ID</th><th>User Name</th><th>Email</th><th>Creation Date</th><th>Last Login</th><th>Last Logout</th></tr></thead>";
            echo "<tbody>";

            // Fetching results as associative array
            foreach ($data['bookings'] as $row) {
                echo "<tr>";
                echo "<td>" . $row->uid . "</td>"; // User ID
                echo "<td>" . $row->user_name . "</td>"; // User Name
                echo "<td>" . $row->email . "</td>"; // Email
                echo "<td>" . $row->create_date . "</td>"; // Creation Date
                echo "<td>" . $row->last_login . "</td>"; // Last Login
                echo "<td>" . $row->last_logout . "</td>"; // Last Logout
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";

            echo "<input type='hidden' name='invoice_date' value='".$data1['invoice_date']."'>";
            echo "<input type='hidden' name='invoice_due_date' value='".$data1['invoice_due_date']."'>";
        } else {
            echo "<div class='alert alert-warning'>No bookings found between the selected dates.</div>";
        }
    }?>
</section>
<script>
    $(document).ready(function(){
        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>
</body>
</html>
