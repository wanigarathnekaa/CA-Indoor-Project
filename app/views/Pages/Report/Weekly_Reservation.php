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
<section class="home"><div class='container pt-5'>
    <h1 class='text-center text-primary'>Booking Report for Selected Date Range</h1><hr>
    <div class="row">
        <div class="col-md-6">
            <!-- <h2 class="text-success">Filter Bookings</h2> -->

            <form action="<?php echo URLROOT;?>/Reports/Weekly_Reservation" method="post">
                <div class="form-group">
                    <label>Select Report Type</label>
                    <select name="report_type" id="report_type" class="form-control" >
                        <option value=""></option>
                        <option value="net-Types">Net Types</option>
                        <option value="weekly">Reservation-chart</option>
                        <option value="timeALO">Time-Allocation</option>

                      
                    </select>
                    <span class="form-invalid"><?php echo isset($data['report_type_error'])? $data['report_type_error'] : '';?></span>

                </div>
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="text" name="invoice_date" id="start_date" class="form-control datepicker" >
                    <span class="form-invalid"><?php echo isset($data['invoice_date_error'])? $data['invoice_date_error'] : '';?></span>

                    
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="text" name="invoice_due_date" id="end_date" class="form-control datepicker" >
                    <span class="form-invalid"><?php echo isset($data['invoice_due_date_error'])? $data['invoice_due_date_error'] : '';?></span>

                </div>

                

                <div class="btn-container">
                        <input type="submit" name="view_pdf" value="View" class="btn btn-primary">
                        <input type="submit" name="download_pdf" value="Download" class="btn btn-primary">                    <!-- <input type="submit" name="download_pdf" value="Download" class="btn btn-primary"> -->
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
