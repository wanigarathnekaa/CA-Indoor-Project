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
    <h1 class='text-center text-primary'>Monthly Booking Report</h1><hr>
    <div class="row">
        <div class="col-md-6">

            <form action="<?php echo URLROOT;?>/Reports/SalesMonthly" method="post">
            <div class="form-group">
    <label>Select the Month</label>
    <select name="Selected_month" id="Selected_month" class="form-control" required>
        <option value="">Select Month</option>
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>
</div>

                <input type="submit" name="Filter" value="Filterbtn" class="btn btn-primary">
                <input type="submit" name="download_pdf" value="download_pdf" class="btn btn-primary">

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
