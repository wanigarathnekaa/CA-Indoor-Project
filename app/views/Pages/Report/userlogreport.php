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
    <h1 class='text-center text-primary'>Account Logs for Selected Date Range</h1><hr>
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
    <?php if ($data && isset($data['bookings']) ) {
        if(count($data['bookings']) > 0){
            echo "<div class='alert alert-success'>Filtered bookings:</div>";
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Customer Name</th><th>Booking Date</th><th>Booking Price</th><th>Payment Status</th></tr></thead>";
            echo "<tbody>";
            $totalPrice = 0;
            $totalPaid = 0;
            $totalPending = 0;
            $totalNotPaid = 0;

            // Fetching results as associative array
            foreach ($data['bookings'] as $row) {
                echo "<tr>";
                echo "<td>" . $row->email . "</td>";
                echo "<td>" . $row->date . "</td>";
                echo "<td>" . $row->bookingPrice . "</td>";
                echo "<td>" . $row->paymentStatus . "</td>";
                echo "</tr>";
                $totalPrice += $row->bookingPrice;

                // Increment appropriate total based on payment status
                switch ($row->paymentStatus) {
                    case 'Paid':
                        $totalPaid += $row->bookingPrice;
                        break;
                    case 'Pending':
                        $totalPending += $row->bookingPrice;
                        break;
                    case 'Not Paid':
                        $totalNotPaid += $row->bookingPrice;
                        break;
                }
            }

            echo "<tr><td colspan='3' style='text-align:right; font-size: 20px;'><b>Total Paid:</b></td><td style='font-size: 20px;'><b>$totalPaid</td></tr>";
            echo "<tr><td colspan='3' style='text-align:right; font-size: 20px;'><b>Total Pending:</b></td><td style='font-size: 20px;'><b>$totalPending</td></tr>";
            echo "<tr><td colspan='3' style='text-align:right; font-size: 20px;'><b>Total Not Paid:</b></td><td style='font-size: 20px;'><b>$totalNotPaid</td></tr>";
            // Calculate the expected total amount
            $expectedTotal = $totalPaid + $totalPending + $totalNotPaid;
            echo "<tr><td colspan='3' style='text-align:right; font-size: 20px;'><b>Total Income:</b></td><td style='font-size: 20px;'><b>$expectedTotal</td></tr>";

            echo "</tbody>";
            echo "</table>";

            echo "<form method='post'>";
            echo "<input type='hidden' name='invoice_date' value='" . $data1['invoice_date'] . "'>";
            echo "<input type='hidden' name='invoice_due_date' value='".$data1['invoice_date']."'>";
            echo "</form>";
        } 
        else {
            echo "<div class='alert alert-warning'>No bookings found between the selected dates.</div>";
        }
    }?>
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
