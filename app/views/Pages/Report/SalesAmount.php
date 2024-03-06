<?php
require "fpdf/fpdf.php"; 

class SalesAmountController {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost","root","","c&a_indoor_net");
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function filterBookingsAndGeneratePDF($start_date, $end_date) {
        $start_date = date("Y-m-d", strtotime($start_date));
        $end_date = date("Y-m-d", strtotime($end_date));

        $sql = "SELECT name, date, bookingPrice FROM bookings WHERE date BETWEEN '$start_date' AND '$end_date'";
        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            // Create PDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',12);

            while ($row = $result->fetch_assoc()) {
                $pdf->Cell(40,10,$row['name'],1,0,'C');
                $pdf->Cell(40,10,$row['date'],1,0,'C');
                $pdf->Cell(40,10,$row['bookingPrice'],1,1,'C');
            }

            $pdf->Output('filtered_bookings.pdf', 'D'); 
        } else {
            echo "<div class='alert alert-warning'>No bookings found between the selected dates.</div>";
        }
    }

    public function displayFilteredBookings($start_date, $end_date) {
        $start_date = date("Y-m-d", strtotime($start_date));
        $end_date = date("Y-m-d", strtotime($end_date));

        $sql = "SELECT name, date, bookingPrice FROM bookings WHERE date BETWEEN '$start_date' AND '$end_date'";
        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<div class='alert alert-success'>Filtered bookings:</div>";
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Customer Name</th><th>Booking Date</th><th>Booking Price</th></tr></thead>";
            echo "<tbody>";
            $totalPrice = 0;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['bookingPrice'] . "</td>";
                echo "</tr>";
                $totalPrice += $row['bookingPrice'];
            }
            echo "<tr><td colspan='2' style='text-align:right'><b>Total Price:</b></td><td>$totalPrice</td></tr>";
            echo "</tbody>";
            echo "</table>";

            echo "<form method='post'>";
            echo "<input type='hidden' name='start_date' value='$start_date'>";
            echo "<input type='hidden' name='end_date' value='$end_date'>";
            echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download PDF</button>";
            echo "</form>";
        } else {
            echo "<div class='alert alert-warning'>No bookings found between the selected dates.</div>";
        }
    }
}

if(isset($_POST["filter"])){
    $controller = new SalesAmountController();
    $controller->displayFilteredBookings($_POST["start_date"], $_POST["end_date"]);
}

if(isset($_POST["download_pdf"])) {
    $controller = new SalesAmountController();
    $controller->filterBookingsAndGeneratePDF($_POST["start_date"], $_POST["end_date"]);
}
?>
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
            <h2 class="text-success">Filter Bookings</h2>
            <form method="post">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="text" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="text" name="end_date" id="end_date" class="form-control" required>
                </div>
                <input type="submit" name="filter" value="Filter" class="btn btn-primary">
            </form>
        </div>
        
    </div>
</div>
</section>
<script>
    $(document).ready(function(){
        $("#start_date, #end_date").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>
</body>
</html>
