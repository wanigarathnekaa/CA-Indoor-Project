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
<section class="home">
<div class='container pt-5'>
    <h1 class='text-center text-primary'>Booking Report for Selected Date Range</h1><hr>
    <div class="row">
        <div class="col-md-6">
            <!-- <h2 class="text-success">Filter Bookings</h2> -->

            <form action="<?php echo URLROOT;?>/Reports/Userlogs" method="post">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="text" name="invoice_date" id="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="text" name="invoice_due_date" id="end_date" class="form-control" required>
                </div>
                <div class="btn-container">
                    <input type="submit" name="filter" value="View" class="btn btn-primary">
                    <input type="submit" name="download_pdf" value="Download" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <?php if (isset($filteredBookings)) {
        echo $filteredBookings;
    } ?>
</div>
</section>
<script>
    $(document).ready(function(){
        $("#invoice_date, #invoice_due_date").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>
</body>
</html>
