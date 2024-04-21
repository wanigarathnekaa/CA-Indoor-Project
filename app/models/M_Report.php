<?php
require_once('C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/TCPDF-main/tcpdf.php');
// Load PHPMailer class file
require 'C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/phpmailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/phpmailer/src/Exception.php';
require 'C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/phpmailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class MYPDF extends TCPDF {

  
    public function ColoredTable($header,$data) {

       
        // Colors, line width and bold font
        $this->SetFillColor(211, 211, 211);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 128, 128);
        $this->SetLineWidth(0.3);
        $this->SetFont('');

        // Header
        $w = array(60, 60, 60);
        $this->SetTextColor(0); //column names
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        
        // Data
        $fill = 0;
        foreach ($data as $row) {
            // Convert $row[2] to float before passing to number_format()
            $price = floatval(str_replace(',', '', $row[2]));

            $this->SetFillColor(255, 255, 255); // White


            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, number_format($price, 2), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }

        // Last line
        $this->Cell(array_sum($w), 0, '', 'T');
        $this->Ln(10); // Add  space before total amounts

    }


}

class MYPDFSixColumns extends TCPDF {

    public function ColoredTableSixColumns($header, $data) {

        // Colors, line width, and bold font
        $this->SetFillColor(211, 211, 211);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 128, 128);
        $this->SetLineWidth(0.3);
        $this->SetFont('');

        // Header
        $w = array(20, 50, 30, 30, 30, 30); // Column widths
        $this->SetTextColor(0); // Column names
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);

        // Data
        $fill = 0;
        foreach ($data as $row) {
            // Convert $row[3] to float before passing it to number_format()
            $price = floatval(str_replace(',', '', $row[3]));

            $this->SetFillColor(255, 255, 255); // White

            // Output the data
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'L', $fill);
            $date = $row[3];
            if (DateTime::createFromFormat('Y-m-d H:i:s', $date) !== false) {
                // If it's in 'Y-m-d H:i:s' format, display only the date part
                $formattedDate = date('Y-m-d', strtotime($date));
            } else {
                // If it's not in 'Y-m-d H:i:s' format, display as is
                $formattedDate = $date;
            }
            
            $this->Cell($w[3], 6, $formattedDate, 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row[4], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row[5], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }

        // Last line
        $this->Cell(array_sum($w), 0, '', 'T');
        $this->Ln(10); // Add space before total amounts
    }


}



class M_Report
{        private $db;
    
        public function __construct(){
            $this->db = new Database;
        }
    
        public function getBookingDetails($data) {
            $invoice_date = $data['invoice_date'];
            $invoice_due_date = $data['invoice_due_date'];
    
    
            $this->db->query('SELECT * FROM bookings WHERE date >= :invoice_date AND date <= :invoice_due_date');
            $this->db->bind(':invoice_date',$invoice_date);
            $this->db->bind(':invoice_due_date',$invoice_due_date);
            return $this->db->resultSet();
        }
        public function getOrderDetails($data) {
            $Product = $data['Product'];
    
           
            
            $this->db->query('SELECT orders.*, orderitems.*
                  FROM orders
                  INNER JOIN orderitems ON orders.order_id = orderitems.order_id
                  INNER JOIN product ON orderitems.product_id = product.product_id
                  WHERE product.product_title = :product');

            $this->db->bind(':product', $Product);
            return $this->db->resultSet();

        }
        
        public function getMonthlyBookingDetails($data) {
            $input_month = $data['Selected_month'];
            
            
    
            $this->db->query('SELECT * FROM bookings WHERE MONTH(date) = :input_month');
            $this->db->bind(':input_month',$input_month);
            return $this->db->resultSet();
        }
                    
        public function filterBookingsAndGeneratePDF($data) {
            $invoice_date = $data['invoice_date'];
            $invoice_due_date = $data['invoice_due_date'];
        
           
            $this->db->query('SELECT * FROM bookings WHERE date >= :invoice_date AND date <= :invoice_due_date');
            $this->db->bind(':invoice_date', $invoice_date);
            $this->db->bind(':invoice_due_date', $invoice_due_date);
            $result = $this->db->resultSet();
            
            
            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
            //set pdf infor
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('admin');
            $pdf->SetTitle('Booking Report');
            $pdf->SetSubject('Booking Report');
            $pdf->SetKeywords('Booking, Report');
            
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 12);
            
            $pdf->SetFont('', 'B'); //bold
            $pdf->Write(0, 'Booking Snapshot', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Cell(0, 10, 'Insights from ' . $invoice_date . '  to' . $invoice_due_date,  0, 1, 'C');
            $pdf->Cell(0, 10, 'A detailed overview of bookings during the specified period' ,  0, 1, 'C');

         
            $pdf->Ln(10); 
            
            // prepare data
            $tableHeader = array('Date', 'Name', 'Booking Price');
            $tableData = array();
            $totalIncome = 0;
            $totalPaid = 0;
            $totalPending = 0;
            $totalNotPaid = 0;
            
            //data for totals
            foreach ($result as $row) {
                $tableData[] = array($row->date, $row->name, number_format($row->bookingPrice, 2));
            
                $totalIncome += $row->bookingPrice;
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
            
            // send data for colored table
            $pdf->ColoredTable($tableHeader, $tableData);
            
           // Print total income
           $pdf->Ln(10);
           $pdf->Cell(130); 
           $pdf->SetFont('', '', 12);
           $pdf->Write(0, 'Total Paid       :' . number_format($totalPaid, 2));
           $pdf->Ln(); 

           $pdf->Cell(130);
           $pdf->SetFont('', '', 12); 
           $pdf->Write(0, 'Total Pending :' . number_format($totalPending, 2));
           $pdf->Ln(); 

           $pdf->Cell(130);
           $pdf->SetFont('', '', 12); 
           $pdf->Write(0, 'Total Not Paid :' . number_format($totalNotPaid, 2));
           $pdf->Ln(); 
            
           

           $pdf->Cell(130); 
           $pdf->SetFont('', '', 12);
           $pdf->SetFont('', 'B'); 
           $pdf->Write(0, 'Total Income  :' . number_format($totalIncome, 2));
           $pdf->Ln(); 

           // download pdf
           $pdf->Output('booking_report1.pdf', 'D');
        }

        public function MonthlyfilterBookingsAndGeneratePDF($data) {
            $input_month = $data['Selected_month'];
            
            
    
            $this->db->query('SELECT * FROM bookings WHERE MONTH(date) = :input_month');
            $this->db->bind(':input_month',$input_month);
            $result= $this->db->resultSet();

            // Check if the query returned any results
            if (!$result) {
                die("Error: No results found for the selected month.");
            }
            
            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
            //set pdf infor
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('admin');
            $pdf->SetTitle('Booking Report');
            $pdf->SetSubject('Booking Report');
            $pdf->SetKeywords('Booking, Report');
            
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 12);
            
            $pdf->SetFont('', 'B'); //bold
            $pdf->Write(0, ' Monthly Booking Report', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Cell(0, 10, 'OF', 0, 1, 'C');
            $pdf->Cell(0, 10, $input_month, 0, 1, 'C');
 
          
            
            // prepare data
            $tableHeader = array('Date', 'Name', 'Booking Price');
            $tableData = array();
            $totalIncome = 0;
            $totalPaid = 0;
            $totalPending = 0;
            $totalNotPaid = 0;
            
            //data for totals
            foreach ($result as $row) {
                $tableData[] = array($row->date, $row->name, number_format($row->bookingPrice, 2));
            
                $totalIncome += $row->bookingPrice;
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
            
            // send data for colored table
           $pdf->ColoredTable($tableHeader, $tableData);
            
           // Print total income
           $pdf->Ln(10);
           $pdf->Cell(130); 
           $pdf->SetFont('', '', 12);
           $pdf->Write(0, 'Total Paid       :' . number_format($totalPaid, 2));
           $pdf->Ln(); 

           $pdf->Cell(130);
           $pdf->SetFont('', '', 12); 
           $pdf->Write(0, 'Total Pending :' . number_format($totalPending, 2));
           $pdf->Ln(); 

           $pdf->Cell(130);
           $pdf->SetFont('', '', 12); 
           $pdf->Write(0, 'Total Not Paid :' . number_format($totalNotPaid, 2));
           $pdf->Ln(); 
           
           $pdf->Cell(130); 
           $pdf->SetFont('', '', 12);
           $pdf->SetFont('', 'B'); 
           $pdf->Write(0, 'Total Income  :' . number_format($totalIncome, 2));
           $pdf->Ln(); 

           // download pdf
           $pdf->Output('Monthly_booking_report.pdf', 'D');
        }

        public function OrderGeneratePDF($data) {
            $Product = $data['Product'];
        
            // Fetch data from the database
            $this->db->query('SELECT orders.*, orderitems.*
                              FROM orders
                              INNER JOIN orderitems ON orders.order_id = orderitems.order_id
                              INNER JOIN product ON orderitems.product_id = product.product_id
                              WHERE product.product_title = :product');
        
            $this->db->bind(':product', $Product);
            $result = $this->db->resultSet();
            
            // Debugging: print the result to check the retrieved data
            print_r($result);
        
            // Create PDF object
            $pdf = new MYPDFSixColumns(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
            // Set PDF information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('admin');
            $pdf->SetTitle('Booking Report');
            $pdf->SetSubject('Booking Report');
            $pdf->SetKeywords('Booking, Report');
            
            // Add a page to the PDF
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 16);
            
            // Add title to the PDF
            $pdf->SetFont('', 'B'); //bold
            $pdf->Write(0, 'Product Sales Analysis Report', '', 0, 'L', true, 0, false, false, 0);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(0, 10, 'Selected Product: ' . $Product, 0, 1, 'L');
            $pdf->Ln(15); 
        
            // Prepare table data
            $tableHeader = array('Order_ID', 'Name', 'Quantity', 'Total Price', 'Order_date', 'Order_Status');
            $tableData = array();
            
            // Populate table data
            foreach ($result as $order) {
                // Assuming the properties exist in $order, adjust the property names if needed
                $tableData[] = array(
                    $order->order_id,
                    $order->full_name, // Adjust property name if needed
                    $order->quantity,
                    number_format($order->price_per_unit, 2),
                    $order->order_date,
                    $order->order_status
                );
            }
        
            // Debugging: print the table data to check if it's populated correctly
            print_r($tableData);
        
            // Add colored table to the PDF
            $pdf->ColoredTableSixColumns($tableHeader, $tableData);
        
            // Output PDF
            $pdf->Output('Order_report.pdf', 'D');
        }
        public function LogsGeneratePDF($data) {
            $invoice_date = $data['invoice_date'];
            $invoice_due_date = $data['invoice_due_date'];
        
            $this->db->query("SELECT * FROM userlog WHERE create_date >= :start_date AND create_date <= :end_date");

            $this->db->bind(':start_date', $invoice_date);
            $this->db->bind(':end_date', $invoice_due_date);
            $result = $this->db->resultSet();
            
                    
            // Create PDF object
            $pdf = new MYPDFSixColumns(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
            // Set PDF information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('admin');
            $pdf->SetTitle('Booking Report');
            $pdf->SetSubject('Booking Report');
            $pdf->SetKeywords('Booking, Report');
            
            // Add a page to the PDF
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 16);
            
            // Add title to the PDF
            $pdf->SetFont('', 'B'); //bold
            $pdf->Write(0, 'User Logs Report', '', 0, 'L', true, 0, false, false, 0);
            $pdf->SetFont('helvetica', '',8);
            $pdf->Cell(0, 10, 'Account Details for Accounts Created Between ' . $invoice_date . ' and ' . $invoice_due_date, 0, 1, 'L'); // Add the description
            $pdf->Ln(15); 
        
            // Prepare table data
            $tableHeader = array('User ID', 'Email ', 'User Name', 'Creation Date', 'Last Login', 'Last Logout');
            $tableData = array();
            
            // Populate table data
            foreach ($result as $log) {
                // Assuming the properties exist in $order, adjust the property names if needed
                $tableData[] = array(
                     $log->uid,
                     $log->email,
                     $log->user_name,
                     $log->create_date,
                     $log->last_login,
                     $log->last_logout,
                );
            }
        
            // Debugging: print the table data to check if it's populated correctly
            print_r($tableData);
        
            // Add colored table to the PDF
            $pdf->ColoredTableSixColumns($tableHeader, $tableData);
        
            // Output PDF
            $pdf->Output('User_log_report.pdf', 'D');
        }
            
        
        public function displayFilteredBookings($data) {
            $invoice_date = $data['invoice_date'];
            $invoice_due_date = $data['invoice_due_date'];
        
            $this->db->query('SELECT * FROM bookings WHERE date >= :invoice_date AND date <= :invoice_due_date');
            $this->db->bind(':invoice_date', $invoice_date);
            $this->db->bind(':invoice_due_date', $invoice_due_date);
            $result = $this->db->resultSet();
        
            if ($result && count($result) > 0) {
                echo "<div class='alert alert-success'>Filtered bookings:</div>";
                echo "<table class='table table-bordered'>";
                echo "<thead><tr><th>Customer Name</th><th>Booking Date</th><th>Booking Price</th><th>Payment Status</th></tr></thead>";
                echo "<tbody>";
                $totalPrice = 0;
                $totalPaid = 0;
                $totalPending = 0;
                $totalNotPaid = 0;
        
                // Fetching results as associative array
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row->name . "</td>";
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
                echo "<input type='hidden' name='invoice_date' value='$invoice_date'>";
                echo "<input type='hidden' name='invoice_due_date' value='$invoice_due_date'>";
                echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download</button>";
                echo "</form>";
            } else {
                echo "<div class='alert alert-warning'>No bookings found between the selected dates.</div>";
            }
        }

        public function displayFilteredOrders($data) {
            $Product = $data['Product'];
    
           
            
            $this->db->query('SELECT orders.*, orderitems.*
            FROM orders
            INNER JOIN orderitems ON orders.order_id = orderitems.order_id
            INNER JOIN product ON orderitems.product_id = product.product_id
            WHERE product.product_title = :product');

            $this->db->bind(':product', $Product);
            $result=$this->db->resultSet();

            if ($result && count($result) > 0) {
                echo "<div class='alert alert-success'>Filtered Orders:</div>";
                echo "<table class='table table-bordered'>";
                echo "<thead><tr><th>Order ID</th><th>Customer Name</th><th>Quantity</th><th>Total Price</th><th>Order Date</th><th>Order Status</th></tr></thead>";
                echo "<tbody>";
                // $totalPrice = 0;
                // $totalPaid = 0;
                // $totalPending = 0;
                // $totalNotPaid = 0;
        // Fetching results as objects of stdClass
foreach ($result as $order) {
    echo "<tr>";
        echo "<td>" . $order->order_id . "</td>";
        echo "<td>" . $order->full_name . "</td>";
        echo "<td>" . $order->quantity . "</td>";
        echo "<td>" . $order->price_per_unit . "</td>";
        echo "<td>" . $order->order_date . "</td>";
        echo "<td>" . $order->order_status . "</td>";
        echo "</tr>";
}

                
        
                
                echo "</tbody>";
                echo "</table>";
        
              
                echo "<form method='post'>";
                echo "    <input type='hidden' name='Product' value='" . $Product . "'>";
                echo "    <button type='submit' name='download_pdf' class='btn btn-primary'>Download</button>";
                echo "</form>";
                         
              } else {
                echo "<div class='alert alert-warning'>No Orses Found.</div>";
            }
        }
        public function displayMonthlyFilteredBookings($data) {
            $input_month = $data['Selected_month'];
            
            
    
            $this->db->query('SELECT * FROM bookings WHERE MONTH(date) = :input_month');
            $this->db->bind(':input_month',$input_month);
            $result= $this->db->resultSet();
        
            if ($result && count($result) > 0) {
                echo "<div class='alert alert-success'>Filtered bookings:</div>";
                echo "<table class='table table-bordered'>";
                echo "<thead><tr><th>Customer Name</th><th>Booking Date</th><th>Booking Price</th><th>Payment Status</th></tr></thead>";
                echo "<tbody>";
                $totalPrice = 0;
                $totalPaid = 0;
                $totalPending = 0;
                $totalNotPaid = 0;
        
                // Fetching results as associative array
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row->name . "</td>";
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
                echo "<input type='hidden' name='Selected_month' value='$input_month'>";
                echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download</button>";
                
                echo "</form>";
            } else {
                echo "<div class='alert alert-warning'>No bookings found between the selected dates.</div>";
            }
        }
        public function displayLogs($data) {
            $invoice_date = $data['invoice_date'];
            $invoice_due_date = $data['invoice_due_date'];
        
            $this->db->query("SELECT * FROM userlog WHERE create_date >= :start_date AND create_date <= :end_date");

            $this->db->bind(':start_date', $invoice_date);
            $this->db->bind(':end_date', $invoice_due_date);
            $result = $this->db->resultSet();
        
            if ($result && count($result) > 0) {
                echo "<div class='alert alert-success'>Filtered User Logs:</div>";
                echo "<table class='table table-bordered'>";
                echo "<thead><tr><th>User ID</th><th>User Name</th><th>Email</th><th>Creation Date</th><th>Last Login</th><th>Last Logout</th></tr></thead>";
                echo "<tbody>";
           
        
                // Fetching results as associative array
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row->uid . "</td>"; // User ID
                    echo "<td>" . $row->user_name . "</td>"; // User Name
                    echo "<td>" . $row->email . "</td>"; // Email
                    echo "<td>" . $row->create_date . "</td>"; // Creation Date
                    echo "<td>" . $row->last_login . "</td>"; // Last Login
                    echo "<td>" . $row->last_logout . "</td>"; // Last Logout
                    echo "</tr>";}
        
                    
                echo "</tbody>";
                echo "</table>";
        
                echo "<form method='post'>";
                echo "<input type='hidden' name='invoice_date' value='$invoice_date'>";
                echo "<input type='hidden' name='invoice_due_date' value='$invoice_due_date'>";
                echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download</button>";
                echo "</form>";
            } else {
                echo "<div class='alert alert-warning'>No bookings123 found between the selected dates.</div>";
            }
        }
        
        
        
    }

      
    
    



    
  