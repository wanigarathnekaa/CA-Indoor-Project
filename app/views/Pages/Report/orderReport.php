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
    <h1 class='text-center text-primary'>Order Report</h1><hr>
    <div class="row">
        <div class="col-md-6">
            <!-- <h2 class="text-success">Filter Bookings</h2> -->

            <form action="<?php echo URLROOT;?>/Reports/OrderReport" method="post">
            <div class="form-group">
            <label for="product">Product</label>
            <select name="Product" id="product" class="form-control" required>
                <option value="">Select a product...</option>
                <option value="SS Ton Power Plus English Willow Cricket Bat Size ...">SS Ton Power Plus English Willow Cricket Bat Size ...</option>
                <option value="SS Blast English Willow Cricket Bat Size SH">SS Blast English Willow Cricket Bat Size SH</option>
                <option value="SS Vintage Green 4.0 English Willow Cricket Bat Si...">SS Vintage Green 4.0 English Willow Cricket Bat Si...</option>
                <option value="SG Savage Plus Kashmir Willow Cricket">SG Savage Plus Kashmir Willow Cricket</option>
                <option value="Kookaburra Jos Buttler Classic Kashmir Willow Cric...">Kookaburra Jos Buttler Classic Kashmir Willow Cric...</option>
                <option value="SS Super Test Cricket Batting Gloves">SS Super Test Cricket Batting Gloves</option>
                <option value="DSC Intense Passion Cricket Batting Gloves">DSC Intense Passion Cricket Batting Gloves</option>
                <option value="EM GT 1.0 Cricket Batting Leg Guard Pads">EM GT 1.0 Cricket Batting Leg Guard Pads</option>
                <option value="SS Test Opener Cricket Batting Leg Guard Pads">SS Test Opener Cricket Batting Leg Guard Pads</option>
                <option value="Masuri Pro Premium Cricket Helmet">Masuri Pro Premium Cricket Helmet</option>
                <option value="Kookaburra Pace Cricket Ball">Kookaburra Pace Cricket Ball</option>
            </select>
            </div>

               
                <input type="submit" name="filter" value="Filter" class="btn btn-primary">
                <input type="submit" name="download_pdf" value="Download_PDF" class="btn btn-primary">

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
