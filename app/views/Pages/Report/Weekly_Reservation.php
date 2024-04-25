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

            <form action="<?php echo URLROOT;?>/Reports/Weekly_Reservation" method="post">
                <div class="form-group">
                    <label>Select Report Type</label>
                    <select name="report_type" id="report_type" class="form-control" required>
                        <option value=""></option>
                        <option name="daily">payment-status</option>
                        <option value="weekly">reservation-chart</option>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="text" name="invoice_date" id="start_date" class="form-control datepicker" required>
                    
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="text" name="invoice_due_date" id="end_date" class="form-control datepicker" required>
                </div>
                <!-- <div class="form-group">
    <label>Month1</label>
    <select name="month1" id="month1" class="form-control" required>
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
<div class="form-group">
    <label>Month1</label>
    <select name="month2" id="month1" class="form-control" required>
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
</div> -->

                <div class="btn-container">
                    <input type="submit" name="filter" value="Download" class="btn btn-primary">
                    <!-- <input type="submit" name="download_pdf" value="Download" class="btn btn-primary"> -->
                </div>
            </form>
        </div>
    </div>
</div>
</section>

<script>
    $(function() {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>

</body>
</html>
