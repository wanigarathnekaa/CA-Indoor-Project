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
$role = "Admin";
require APPROOT.'/views/Pages/Dashboard/header.php';
require APPROOT.'/views/Components/Side Bars/sideBar.php';
?>
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

               
            <div class="btn-container">
                    <input type="submit" name="filter" value="View" class="btn btn-primary">
                    <input type="submit" name="download_pdf" value="Download" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <?php if ($data && isset($data['orders']) ) {
        if(count($data['orders']) > 0){
            echo "<div class='alert alert-success'>Filtered Orders:</div>";
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Customer Name</th><th>Product Name</th><th>Quantity</th><th>order_date</th><th>Payment Status</th><th>Amount</th></tr></thead>";
            echo "<tbody>";
            $totalPrice = 0;
            $totalPaid = 0;
            $totalNotPaid = 0;
    
            // Fetching results as associative array
            foreach ($data['orders'] as $row) {
                echo "<tr>";
                echo "<td>" . $row->full_name . "</td>";
                echo "<td>" . $row->product_title . "</td>";
                echo "<td>" . $row->quantity . "</td>";

                echo "<td>" . $row->order_date . "</td>";
                echo "<td>" . $row->paymentStatus . "</td>";
                echo "<td>" . $row->price . "</td>";

                echo "</tr>";
                $totalPrice += $row->price;
    
                //Increment appropriate total based on payment status
                switch ($row->paymentStatus) {
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
    
            // echo "<form method='post'>";
            //     echo "<input type='hidden' name='Selected_month' value='".$data1['$input_month']."'>";
            // echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download</button>";
            
            // echo "</form>";
        } else {
            echo "<div class='alert alert-warning'>No Orders found in this product.</div>";
        }
    }

   
    ?>
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
