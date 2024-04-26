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
    <h1 class='text-center text-primary'>Monthly Orders Report</h1><hr>
    <div class="row">
        <div class="col-md-6">
            <form action="<?php echo URLROOT;?>/Reports/MonthlyOrderReport" method="post">
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

                <div class="btn-container">
                    <input type="submit" name="filter" value="Filter" class="btn btn-primary">
                    <input type="submit" name="view_pdf" value="View" class="btn btn-primary">
                    <input type="submit" name="download_pdf" value="Download" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    </div>
    <?php 
    
        if ($data && isset($data['monthlyOrders']) ) {
        if(count($data['monthlyOrders']) > 0){
    echo "<div class='alert alert-success'>Filtered Orders:</div>";
    echo "<table class='table table-bordered'>";
    echo "<thead><tr><th>Customer Name</th><th>Product Name</th><th>Quantity</th><th>order_date</th><th>Payment Status</th><th>Amount</th></tr></thead>";
    echo "<tbody>";
    $totalPrice = 0;
    $totalPaid = 0;
    $totalNotPaid = 0;

    // Fetching results as associative array
    foreach ($data['monthlyOrders'] as $row) {
        echo "<tr>";
        echo "<td>" . $row->full_name . "</td>";
        echo "<td>" . $row->product_title . "</td>";
        echo "<td>" . $row->quantity . "</td>";//                    $order->quantity,

        echo "<td>" . $row->order_date . "</td>";
        echo "<td>" . $row->payment_status . "</td>";
        echo "<td>" . $row->price . "</td>";

        echo "</tr>";
        $totalPrice += $row->price;

        //Increment appropriate total based on payment status
        switch ($row->payment_status) {
            case 'Paid':
                $totalPaid += $row->price;
                break;
            case 'Not Paid':
                $totalNotPaid += $row->price;
                break;
        }
    }

    echo "<tr><td colspan='5' style='text-align:right; font-size: 20px;'><b>Total Paid:</b></td><td style='font-size: 20px;'><b>$totalPaid</td></tr>";
    echo "<tr><td colspan='5' style='text-align:right; font-size: 20px;'><b>Total Not Paid:</b></td><td style='font-size: 20px;'><b>$totalNotPaid</td></tr>";
    // Calculate the expected total amount
    $expectedTotal = $totalPaid  + $totalNotPaid;
    echo "<tr><td colspan='5' style='text-align:right; font-size: 20px;'><b>Total Income:</b></td><td style='font-size: 20px;'><b>$expectedTotal</td></tr>";
    

    echo "</tbody>";
    echo "</table>";

    echo "<form method='post'>";
    // echo "<input type='hidden' name='Selected_month' value='$input_month'>";
    // echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download</button>";
    
    echo "</form>";
} else {
    echo "<div class='alert alert-warning'>No Orders.</div>";
}    } ?>

</section>
<!-- <script>
    $(document).ready(function(){
        $("#invoice_date, #invoice_due_date").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script> -->
</body>
</html>
