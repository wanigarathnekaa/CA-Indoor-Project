<?php
require_once('C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/TCPDF-main/tcpdf.php');

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

    // Your custom function for generating a report
    public function GenerateReport($header, $data, $totalPrice, $totalPaid, $totalPending, $totalNotPaid) {
        $this->AddPage();
        $this->SetFont('helvetica', '', 12);
        $this->Write(0, 'Booking Report', '', 0, 'C', true, 0, false, false, 0);
        $this->ColoredTable($header, $data);

        //space
        $this->Ln(10); 

        // Print total amounts
        $this->Write(0, 'Total Price: $' . number_format($totalPrice, 2));
        $this->Ln();
        $this->Write(0, 'Total Paid: $' . number_format($totalPaid, 2));
        $this->Ln(); 
        $this->Write(0, 'Total Pending: $' . number_format($totalPending, 2));
        $this->Ln(); 
        $this->Write(0, 'Total Not Paid: $' . number_format($totalNotPaid, 2));
        $this->Ln(); 
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
        
        public function getMonthlyBookingDetails($data) {
            $input_month = $data['Selected_month'];
            
            
    
            $this->db->query('SELECT * FROM bookings WHERE MONTH(date) = :input_month');
            $this->db->bind(':input_month',$input_month);
            return $this->db->resultSet();
        }
        
        public function filterBookingsAndGenerateANDsendPDF($data) {
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
            $pdf->Write(0, 'Booking Report', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Cell(0, 10, 'Between selected dates', 0, 1, 'C');
            $pdf->Cell(0, 10, 'From ' . $invoice_date . ' to ' . $invoice_due_date, 0, 1, 'C');
 
          
            
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
           $pdfContent = $pdf->Output('booking_report1.pdf', 'S');
           $recipientEmail="nivodya2001@gmail.com";
           // Compose email
           $to = $recipientEmail;
           $subject = 'Booking Report';
           $message = 'Please find the booking report attached.';
           $headers = 'From: admin@example.com' . "\r\n";
           $headers .= 'MIME-Version: 1.0' . "\r\n";
           $headers .= 'Content-Type: multipart/mixed; boundary="boundary"' . "\r\n";
           
           // Set boundary
           $boundary = 'boundary';
   
           // Email content
           $body = "--$boundary\r\n";
           $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
           $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
           $body .= $message . "\r\n";
           $body .= "--$boundary\r\n";
           $body .= "Content-Type: application/pdf; name=\"booking_report1.pdf\"\r\n";
           $body .= "Content-Disposition: attachment; filename=\"booking_report1.pdf\"\r\n";
           $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
           $body .= chunk_split(base64_encode($pdfContent)) . "\r\n";
           $body .= "--$boundary--";
   
           // Send email
           if (mail($to, $subject, $body, $headers)) {
               echo 'Email sent successfully.';
           } else {
               echo 'Email sending failed.';
           }        }
         
        
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
            $pdf->Write(0, 'Booking Report', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Cell(0, 10, 'Between selected dates', 0, 1, 'C');
            $pdf->Cell(0, 10, 'From ' . $invoice_date . ' to ' . $invoice_due_date, 0, 1, 'C');
 
          
            
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
           $pdf->Output('booking_report1.pdf', 'D');
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
                echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download PDF</button>";
                echo "</form>";
            } else {
                echo "<div class='alert alert-warning'>No bookings found between the selected dates.</div>";
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
        
                echo "<form method='post' action='" . URLROOT . "/Reports/SalesMonthly'>";
                echo "<input type='hidden' name='invoice_date' value='$input_month'>";
                // echo "<input type='hidden' name='invoice_due_date' value='$invoice_due_date'>";
                echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download PDF</button>";
                
                echo "</form>";
            } else {
                echo "<div class='alert alert-warning'>No bookings found between the selected dates.</div>";
            }
        }
        


      
    }
    



    
  