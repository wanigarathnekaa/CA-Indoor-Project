<?php
require_once APPROOT . '/libraries/TCPDF-main/tcpdf.php';
require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
require_once APPROOT . '/libraries/phpmailer/src/Exception.php';


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
class MYPDFSixColumnss extends TCPDF {

    public function ColoredTableSixColumns($header, $data) {

        // Colors, line width, and bold font
        $this->SetFillColor(211, 211, 211);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 128, 128);
        $this->SetLineWidth(0.3);
        $this->SetFont('');

        // Header
        $w = array(15, 100, 12, 25, 20, 20); // Column widths
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

            $this->SetFillColor(255, 255, 255); // White

            // Output the data
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row[3], 'LR', 0, 'L', $fill);
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
        public function getUserLogs($data){
        
            $invoice_date = $data['invoice_date'];
            $invoice_due_date = $data['invoice_due_date'];
        
            $this->db->query("SELECT * FROM userlog WHERE create_date >= :start_date AND create_date <= :end_date");
        
            $this->db->bind(':start_date', $invoice_date);
            $this->db->bind(':end_date', $invoice_due_date);
            return $this->db->resultSet();}
        
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
        public function filterBookingsAndGeneratePDF1($data) {
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
           $pdf->Output('booking_report1.pdf', 'I');
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
            $input_month = date("F", strtotime("01-$input_month-2024"));
            $pdf->Cell(0, 10, 'Month :'.$input_month, 0, 1, 'C'); 
          
            
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
        public function MonthlyfilterBookingsAndGeneratePDF1($data) {
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
            $input_month = date("F", strtotime("01-$input_month-2024"));
            $pdf->Cell(0, 10, 'Month :'.$input_month, 0, 1, 'C'); 
          
            
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
           $pdf->Output('Monthly_booking_report.pdf', 'I');
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
        public function OrderGeneratePDF1($data) {
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
            $pdf->Output('Order_report.pdf', 'I');
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
        public function LogsGeneratePDF1($data) {
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
            $pdf->Output('User_log_report.pdf', 'I');
        }

        public function MonthlyOrdersGeneratePDF($data) {
            $input_month = $data['Selected_month'];
        
            $this->db->query('SELECT orders.*, orderitems.product_id, orderitems.quantity, product.product_title
                      FROM orders
                      INNER JOIN orderitems ON orders.order_id = orderitems.order_id
                      INNER JOIN product ON orderitems.product_id = product.product_id
                      WHERE MONTH(orders.order_date) = :input_month');
        
            $this->db->bind(':input_month', $input_month);
            $result = $this->db->resultSet();
            
            // Create PDF object
            $pdf = new MYPDFSixColumnss(); // Assuming MYPDFSixColumnss is defined somewhere
        
            // Set PDF information
            $pdf->SetCreator('Your Creator');
            $pdf->SetAuthor('admin');
            $pdf->SetTitle('Monthly Order Report');
            $pdf->SetSubject('Monthly Order Report');
            $pdf->SetKeywords('Order, Report');
            
            // Add a page to the PDF
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 16);
        
            // Add title to the PDF
            $pdf->SetFont('', 'B');
            $pdf->Write(0, 'Monthly Order Income Analysis:', '', 0, 'L', true, 0, false, false, 0);
            $pdf->SetFont('helvetica', '', 10);
            $input_month_name = date("F", strtotime("01-$input_month-2024"));
            $pdf->Cell(0, 10, 'Month: ' . $input_month_name, 0, 1, 'L');
            $pdf->Ln(15); 
            
            // Prepare table data
            $tableHeader = array('Name', 'Product', 'Quantity', 'Order Date', 'Status', 'Amount');
            $tableData = array();
            
            $totalIncome = 0;
            $totalPaid = 0;
            $totalNotPaid = 0;
        
            // Populate table data
            foreach ($result as $row) {
                $full_name = $row->full_name;
                $names = explode(" ", $full_name);
                $first_name = $names[0];
        
                $tableData[] = array(
                    $first_name,
                    $row->product_title,
                    $row->quantity,
                    date('Y-m-d', strtotime($row->order_date)), // Format the date
                    $row->payment_status,
                    $row->price
                );
        
                $totalIncome += $row->price;
                switch ($row->payment_status) {
                    case 'Paid':
                        $totalPaid += $row->price;
                        break;
                    case 'Not Paid':
                        $totalNotPaid += $row->price;
                        break;
                }
            }
        
            // Add colored table to the PDF
            $pdf->ColoredTableSixColumns($tableHeader, $tableData);
           
            // Print total income
            $pdf->Ln(10);
            $pdf->Cell(130); 
            $pdf->SetFont('', 'B', 12);
            $pdf->Write(0, 'Total Paid    : ' . number_format($totalPaid, 2));
            $pdf->Ln(); 
        
            $pdf->Cell(130);
            $pdf->Write(0, 'Total Not Paid: ' . number_format($totalNotPaid, 2));
            $pdf->Ln(); 
            
            $pdf->Cell(130); 
            $pdf->Write(0, 'Total Income  : ' . number_format($totalIncome, 2));
            $pdf->Ln(); 
        
            // Output PDF
            $pdf->Output('Monthly_Order_report.pdf', 'D');
        }
        public function MonthlyOrdersGeneratePDF1($data) {
            $input_month = $data['Selected_month'];
        
            $this->db->query('SELECT orders.*, orderitems.product_id, orderitems.quantity, product.product_title
                      FROM orders
                      INNER JOIN orderitems ON orders.order_id = orderitems.order_id
                      INNER JOIN product ON orderitems.product_id = product.product_id
                      WHERE MONTH(orders.order_date) = :input_month');
        
            $this->db->bind(':input_month', $input_month);
            $result = $this->db->resultSet();
            
            // Create PDF object
            $pdf = new MYPDFSixColumnss(); // Assuming MYPDFSixColumnss is defined somewhere
        
            // Set PDF information
            $pdf->SetCreator('Your Creator');
            $pdf->SetAuthor('admin');
            $pdf->SetTitle('Monthly Order Report');
            $pdf->SetSubject('Monthly Order Report');
            $pdf->SetKeywords('Order, Report');
            
            // Add a page to the PDF
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 16);
        
            // Add title to the PDF
            $pdf->SetFont('', 'B');
            $pdf->Write(0, 'Monthly Order Income Analysis:', '', 0, 'L', true, 0, false, false, 0);
            $pdf->SetFont('helvetica', '', 10);
            $input_month_name = date("F", strtotime("01-$input_month-2024"));
            $pdf->Cell(0, 10, 'Month: ' . $input_month_name, 0, 1, 'L');
            $pdf->Ln(15); 
            
            // Prepare table data
            $tableHeader = array('Name', 'Product', 'Quantity', 'Order Date', 'Status', 'Amount');
            $tableData = array();
            
            $totalIncome = 0;
            $totalPaid = 0;
            $totalNotPaid = 0;
        
            // Populate table data
            foreach ($result as $row) {
                $full_name = $row->full_name;
                $names = explode(" ", $full_name);
                $first_name = $names[0];
        
                $tableData[] = array(
                    $first_name,
                    $row->product_title,
                    $row->quantity,
                    date('Y-m-d', strtotime($row->order_date)), // Format the date
                    $row->payment_status,
                    $row->price
                );
        
                $totalIncome += $row->price;
                switch ($row->payment_status) {
                    case 'Paid':
                        $totalPaid += $row->price;
                        break;
                    case 'Not Paid':
                        $totalNotPaid += $row->price;
                        break;
                }
            }
        
            // Add colored table to the PDF
            $pdf->ColoredTableSixColumns($tableHeader, $tableData);
           
            // Print total income
            $pdf->Ln(10);
            $pdf->Cell(130); 
            $pdf->SetFont('', 'B', 12);
            $pdf->Write(0, 'Total Paid    : ' . number_format($totalPaid, 2));
            $pdf->Ln(); 
        
            $pdf->Cell(130);
            $pdf->Write(0, 'Total Not Paid: ' . number_format($totalNotPaid, 2));
            $pdf->Ln(); 
            
            $pdf->Cell(130); 
            $pdf->Write(0, 'Total Income  : ' . number_format($totalIncome, 2));
            $pdf->Ln(); 
        
            // Output PDF
            $pdf->Output('Monthly_Order_report.pdf', 'I');
        }
        
        public function displayRevenueChart($data) {
            $invoice_date = isset($_POST['invoice_date']) ? $_POST['invoice_date'] : '';
            $invoice_due_date = isset($_POST['invoice_due_date']) ? $_POST['invoice_due_date'] : '';
        
            // Fetch booking data based on invoice dates
            $sql = "SELECT COUNT(*) AS booking_count, DATE_FORMAT(date, '%Y-%m-%d') AS booking_date 
                    FROM bookings 
                    WHERE date >= :invoice_date AND date <= :invoice_due_date 
                    GROUP BY booking_date";
        
            $this->db->query($sql);
            $this->db->bind(':invoice_date', $invoice_date);
            $this->db->bind(':invoice_due_date', $invoice_due_date);
            $this->db->execute();
            $bookingData = $this->db->resultSet();
        
            // Prepare data for the line chart
            $dates = array();
            $bookingCounts = array();
        
            foreach ($bookingData as $row) {
                $dates[] = $row->booking_date; // Storing booking dates for labeling X-axis
                $bookingCounts[] = $row->booking_count;
            }
        
            // ---------------------------------------------------------
            // Create new TCPDF instance
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Booking Count Chart');
            $pdf->SetSubject('Booking Count Chart');
            $pdf->SetKeywords('Booking, Count, Chart');
        
            // Set font
            $pdf->SetFont('helvetica', '', 10);
        
            // Add a page
            $pdf->AddPage();
        
            // Title
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->Cell(0, 10, 'Booking Count Chart', 0, 1, 'C');
        
            // Date range
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, 'Date Range: ' . $invoice_date . ' to ' . $invoice_due_date, 0, 1, 'C');
        
            // Line break
            $pdf->Ln(10);
        
            // Line chart parameters
            $xStart = 30; // Adjusted X-axis start position
            $yStart = $pdf->GetY(); // Get current Y position after title and date range
        
            $width = 160;
            $height = 100;
            $xScale = $width / (count($dates) - 1);
            
            // Fetch the maximum count of bookings
            $maxCount = max($bookingCounts);
        
            // Calculate yScale
            $yScale = $height / ceil($maxCount); // Using ceil to ensure we get a whole number
        
            // Draw the line chart for booking counts
            $pdf->SetLineWidth(0.8); // thicker line for booking counts
            $pdf->SetDrawColor(0, 128, 0); // Green color for booking counts
            $prevX = $xStart;
            $prevY = $yStart + $height;
            foreach ($bookingCounts as $index => $count) {
                $x = $xStart + ($index * $xScale);
                $y = $yStart + ($height - ($count * $yScale));
                $pdf->Line($prevX, $prevY, $x, $y);
                $prevX = $x;
                $prevY = $y;
            }
        
            // Draw the X-axis
            $pdf->SetLineWidth(0.2); // thinner line for axes
            $pdf->SetDrawColor(0, 0, 0); // Black color for axes
            $pdf->Line($xStart, $yStart + $height, $xStart + $width, $yStart + $height);
        
            // Draw the Y-axis
            $pdf->Line($xStart, $yStart, $xStart, $yStart + $height);
        
            // Draw the Y-axis labels
            $pdf->SetTextColor(0, 0, 0); // Black color for text
            $yPos = $yStart + $height;
            $yLabel = 0;
            while ($yPos >= $yStart) {
                $pdf->Text($xStart - 20, $yPos, $yLabel); // Adjusted Y-axis label position
                $yPos -= $yScale; // smaller step for Y-axis labels
                $yLabel += 1;
            }
        
            // Draw the X-axis labels vertically below the axis
            $pdf->SetTextColor(0, 0, 0); // Black color for text
            $pdf->SetFont('helvetica', '', 10); // Adjust font size if needed
            $xPos = $xStart + $xScale / 2; // Start xPos in the middle of the first bar
            $yPos = $yStart + $height + 20; // Set yPos below the x-axis
            foreach ($dates as $date) {
                $pdf->StartTransform();
                $pdf->Rotate(90, $xPos, $yPos); // Rotate text
                $pdf->Text($xPos, $yPos, $date); // Display date vertically
                $pdf->StopTransform();
                $xPos += $xScale;
            }
        
            // Output PDF
            $pdf->Output('revenue_chart.pdf','D');
        }
        public function displayRevenueChart1() {
            $invoice_date = isset($_POST['invoice_date']) ? $_POST['invoice_date'] : '';
            $invoice_due_date = isset($_POST['invoice_due_date']) ? $_POST['invoice_due_date'] : '';
        
            // Fetch booking data based on invoice dates
            $sql = "SELECT COUNT(*) AS booking_count, DATE_FORMAT(date, '%Y-%m-%d') AS booking_date 
                    FROM bookings 
                    WHERE date >= :invoice_date AND date <= :invoice_due_date 
                    GROUP BY booking_date";
        
            $this->db->query($sql);
            $this->db->bind(':invoice_date', $invoice_date);
            $this->db->bind(':invoice_due_date', $invoice_due_date);
            $this->db->execute();
            $bookingData = $this->db->resultSet();
        
            // Prepare data for the line chart
            $dates = array();
            $bookingCounts = array();
        
            foreach ($bookingData as $row) {
                $dates[] = $row->booking_date; // Storing booking dates for labeling X-axis
                $bookingCounts[] = $row->booking_count;
            }
        
            // ---------------------------------------------------------
            // Create new TCPDF instance
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Booking Count Chart');
            $pdf->SetSubject('Booking Count Chart');
            $pdf->SetKeywords('Booking, Count, Chart');
        
            // Set font
            $pdf->SetFont('helvetica', '', 10);
        
            // Add a page
            $pdf->AddPage();
        
            // Title
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->Cell(0, 10, 'Booking Count Chart', 0, 1, 'C');
        
            // Date range
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, 'Date Range: ' . $invoice_date . ' to ' . $invoice_due_date, 0, 1, 'C');
        
            // Line break
            $pdf->Ln(10);
        
            // Line chart parameters
            $xStart = 30; // Adjusted X-axis start position
            $yStart = $pdf->GetY(); // Get current Y position after title and date range
        
            $width = 160;
            $height = 100;
            $xScale = $width / (count($dates) - 1);
            
            // Fetch the maximum count of bookings
            $maxCount = max($bookingCounts);
        
            // Calculate yScale
            $yScale = $height / ceil($maxCount); // Using ceil to ensure we get a whole number
        
            // Draw the line chart for booking counts
            $pdf->SetLineWidth(0.8); // thicker line for booking counts
            $pdf->SetDrawColor(0, 128, 0); // Green color for booking counts
            $prevX = $xStart;
            $prevY = $yStart + $height;
            foreach ($bookingCounts as $index => $count) {
                $x = $xStart + ($index * $xScale);
                $y = $yStart + ($height - ($count * $yScale));
                $pdf->Line($prevX, $prevY, $x, $y);
                $prevX = $x;
                $prevY = $y;
            }
        
            // Draw the X-axis
            $pdf->SetLineWidth(0.2); // thinner line for axes
            $pdf->SetDrawColor(0, 0, 0); // Black color for axes
            $pdf->Line($xStart, $yStart + $height, $xStart + $width, $yStart + $height);
        
            // Draw the Y-axis
            $pdf->Line($xStart, $yStart, $xStart, $yStart + $height);
        
            // Draw the Y-axis labels
            $pdf->SetTextColor(0, 0, 0); // Black color for text
            $yPos = $yStart + $height;
            $yLabel = 0;
            while ($yPos >= $yStart) {
                $pdf->Text($xStart - 20, $yPos, $yLabel); // Adjusted Y-axis label position
                $yPos -= $yScale; // smaller step for Y-axis labels
                $yLabel += 1;
            }
        
            // Draw the X-axis labels vertically below the axis
            $pdf->SetTextColor(0, 0, 0); // Black color for text
            $pdf->SetFont('helvetica', '', 10); // Adjust font size if needed
            $xPos = $xStart + $xScale / 2; // Start xPos in the middle of the first bar
            $yPos = $yStart + $height + 20; // Set yPos below the x-axis
            foreach ($dates as $date) {
                $pdf->StartTransform();
                $pdf->Rotate(90, $xPos, $yPos); // Rotate text
                $pdf->Text($xPos, $yPos, $date); // Display date vertically
                $pdf->StopTransform();
                $xPos += $xScale;
            }
        
            // Output PDF
            $pdf->Output('booking_count_chart.pdf', 'I');
        }
        
        
        
        
        
        
        
        // public function displayFilteredBookings($data) {
        //     $invoice_date = $data['invoice_date'];
        //     $invoice_due_date = $data['invoice_due_date'];
        
        //     $this->db->query('SELECT * FROM bookings WHERE date >= :invoice_date AND date <= :invoice_due_date');
        //     $this->db->bind(':invoice_date', $invoice_date);
        //     $this->db->bind(':invoice_due_date', $invoice_due_date);
        //     $result = $this->db->resultSet();
        
        //     if ($result && count($result) > 0) {
        //         echo "<div class='alert alert-success'>Filtered bookings:</div>";
        //         echo "<table class='table table-bordered'>";
        //         echo "<thead><tr><th>Customer Name</th><th>Booking Date</th><th>Booking Price</th><th>Payment Status</th></tr></thead>";
        //         echo "<tbody>";
        //         $totalPrice = 0;
        //         $totalPaid = 0;
        //         $totalPending = 0;
        //         $totalNotPaid = 0;
        
        //         // Fetching results as associative array
        //         foreach ($result as $row) {
        //             echo "<tr>";
        //             echo "<td>" . $row->name . "</td>";
        //             echo "<td>" . $row->date . "</td>";
        //             echo "<td>" . $row->bookingPrice . "</td>";
        //             echo "<td>" . $row->paymentStatus . "</td>";
        //             echo "</tr>";
        //             $totalPrice += $row->bookingPrice;
        
        //             // Increment appropriate total based on payment status
        //             switch ($row->paymentStatus) {
        //                 case 'Paid':
        //                     $totalPaid += $row->bookingPrice;
        //                     break;
        //                 case 'Pending':
        //                     $totalPending += $row->bookingPrice;
        //                     break;
        //                 case 'Not Paid':
        //                     $totalNotPaid += $row->bookingPrice;
        //                     break;
        //             }
        //                         }            
        //         echo "<tr><td colspan='3' style='text-align:right; font-size: 20px;'><b>Total Paid:</b></td><td style='font-size: 20px;'><b>$totalPaid</td></tr>";
        //         echo "<tr><td colspan='3' style='text-align:right; font-size: 20px;'><b>Total Pending:</b></td><td style='font-size: 20px;'><b>$totalPending</td></tr>";
        //         echo "<tr><td colspan='3' style='text-align:right; font-size: 20px;'><b>Total Not Paid:</b></td><td style='font-size: 20px;'><b>$totalNotPaid</td></tr>";
        //         // Calculate the expected total amount
        //         $expectedTotal = $totalPaid + $totalPending + $totalNotPaid;
        //         echo "<tr><td colspan='3' style='text-align:right; font-size: 20px;'><b>Total Income:</b></td><td style='font-size: 20px;'><b>$expectedTotal</td></tr>";
                
        
        //         echo "</tbody>";
        //         echo "</table>";
        
        //         echo "<form method='post'>";
        //         echo "<input type='hidden' name='invoice_date' value='$invoice_date'>";
        //         echo "<input type='hidden' name='invoice_due_date' value='$invoice_due_date'>";
        //         echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download</button>";
        //         echo "</form>";
             
        //     } else {
        //         echo "<div class='alert alert-warning'>No bookings found between the selected dates.</div>";
        //     }
        // }

        public function displayReservationChart($data) {
            $invoice_date = isset($_POST['invoice_date']) ? $_POST['invoice_date'] : '';
            $invoice_due_date = isset($_POST['invoice_due_date']) ? $_POST['invoice_due_date'] : '';
            
            // Fetch booking data based on invoice dates and payment status
            $sql = "SELECT COUNT(*) AS count, time_slots.netType FROM bookings 
                    INNER JOIN time_slots ON bookings.id = time_slots.booking_id
                    WHERE bookings.date >= :invoice_date AND bookings.date <= :invoice_due_date 
                    GROUP BY time_slots.netType";
            $this->db->query($sql);
            $this->db->bind(':invoice_date', $invoice_date);
            $this->db->bind(':invoice_due_date', $invoice_due_date);
            $result = $this->db->resultSet();
            
            // Prepare data for the pie chart
            $netTypeCounts = array();
            foreach ($result as $row) {
                $netTypeCounts[$row->netType] = $row->count;
            }
            
            // ---------------------------------------------------------
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
            // set font
            $pdf->SetFont('helvetica', 'B', 17);
            
            // add a page
            $pdf->AddPage();
            
            $pdf->Write(10, "NetType Distribution of Reservations\n");
            $pdf->SetFont('helvetica', '', 13);
        
            $pdf->Write(10, "Between: " . $data['invoice_date'] . " and " . $data['invoice_due_date']."\n\n");
        
            // Pie chart parameters
            $xc = 105;
            $yc = 100;
            $r = 50;
            
            // Pie chart colors
            $colors = array(
                'Machine Net' => array(51, 153, 102),    // Green
                'Normal Net A' => array(255, 204, 102),  // Yellow
                'Normal Net B' => array(204, 102, 102)   // Red
            );
            
            $startAngle = 0;
            foreach ($netTypeCounts as $netType => $count) {
                $endAngle = $startAngle + ($count / array_sum($netTypeCounts)) * 360;
                $pdf->SetFillColor($colors[$netType][0], $colors[$netType][1], $colors[$netType][2]);
                $pdf->PieSector($xc, $yc, $r, $startAngle, $endAngle, 'FD', false, 0, 2);
                $startAngle = $endAngle;
            }
            $totalReservations = array_sum($netTypeCounts);
            foreach ($netTypeCounts as $netType => $count) {
                $percentage = round(($count / $totalReservations) * 100, 2);
                $pdf->Write(10, "{$netType}: {$count} ({$percentage}%) \n");
            }
            // Draw squares and color descriptions
$xSquare = 70;
$ySquare = 150;
$colorWidth = 10;
$colorHeight = 10;
$colorGap = 5;
$colorTextGap = 3;

foreach ($colors as $status => $color) {
    // Set color for square
    $pdf->SetFillColor($color[0], $color[1], $color[2]);
    
    // Draw square
    $pdf->Rect($xSquare, $ySquare, $colorWidth, $colorHeight, 'F');
    
    // Write color description
    $pdf->Text($xSquare + $colorWidth + $colorTextGap, $ySquare + ($colorHeight / 2), $status);
    
    // Move to the next position
    $ySquare += $colorHeight + $colorGap;
}
            // Close and output PDF document
            $pdf->Output('net_type_distribution.pdf', 'D');
        }
        
        
        public function displayTimeChart($data) {
            $invoice_date = isset($_POST['invoice_date']) ? $_POST['invoice_date'] : '';
            $invoice_due_date = isset($_POST['invoice_due_date']) ? $_POST['invoice_due_date'] : '';
            
            // Fetch booking data based on invoice dates and payment status
            $sql = "SELECT 
                        COUNT(*) AS count, 
                        CASE 
                            WHEN HOUR(time_slots.timeslot) BETWEEN 7 AND 11 THEN '07:00AM-12:00PM'
                            WHEN HOUR(time_slots.timeslot) BETWEEN 12 AND 16 THEN '12:00PM-05:00PM'
                            WHEN HOUR(time_slots.timeslot) BETWEEN 17 AND 21 THEN '05:00PM-10:00PM'
                        END AS hour_range
                    FROM 
                        bookings 
                    INNER JOIN 
                        time_slots ON bookings.id = time_slots.booking_id
                    WHERE 
                        bookings.date >= :invoice_date AND bookings.date <= :invoice_due_date 
                    GROUP BY 
                        hour_range";
            
            $this->db->query($sql);
            $this->db->bind(':invoice_date', $invoice_date);
            $this->db->bind(':invoice_due_date', $invoice_due_date);
            $result = $this->db->resultSet();
            
            // Prepare data for the pie chart
            $netTypeCounts = array();
            foreach ($result as $row) {
                $netTypeCounts[$row->hour_range] = $row->count; // Changed from $row->timeslot
            }
            
            // Initialize PDF
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetFont('helvetica', 'B', 13);
            $pdf->AddPage();
            
            // Title and date range
            $pdf->Write(10, "Time Allocation of Reservations\n");
            $pdf->SetFont('helvetica', '', 13);
            $pdf->Write(10, "Between: " . $data['invoice_date'] . " and " . $data['invoice_due_date'] . "\n\n");
            
            // Pie chart parameters
            $xc = 105;
            $yc = 100;
            $r = 50;
            
            // Pie chart colors and time range labels
            $colors = array(
                '07:00AM-12:00PM' => array(51, 153, 102),    // Green
                '12:00PM-05:00PM' => array(255, 204, 102),  // Yellow
                '05:00PM-10:00PM' => array(204, 102, 102)   // Red
            );
            
            // Draw pie chart and calculate percentages
            $startAngle = 0;
            foreach ($netTypeCounts as $hourRange => $count) {
                $endAngle = $startAngle + ($count / array_sum($netTypeCounts)) * 360;
                $pdf->SetFillColor($colors[$hourRange][0], $colors[$hourRange][1], $colors[$hourRange][2]);
                $pdf->PieSector($xc, $yc, $r, $startAngle, $endAngle, 'FD', false, 0, 2);
                $startAngle = $endAngle;
            }
            
            // Display reservation counts and percentages
            $totalReservations = array_sum($netTypeCounts);
            foreach ($netTypeCounts as $hourRange => $count) {
                $percentage = round(($count / $totalReservations) * 100, 2);
                $pdf->Write(10, "{$hourRange}: {$count} ({$percentage}%) \n");
            }
            
            // Draw color squares and labels
            $xSquare = 70;
            $ySquare = 150;
            $colorWidth = 10;
            $colorHeight = 10;
            $colorGap = 5;
            $colorTextGap = 3;
        
            foreach ($colors as $rangeLabel => $color) {
                $pdf->SetFillColor($color[0], $color[1], $color[2]);
                $pdf->Rect($xSquare, $ySquare, $colorWidth, $colorHeight, 'F');
                $pdf->Text($xSquare + $colorWidth + $colorTextGap, $ySquare + ($colorHeight / 2), $rangeLabel);
                $ySquare += $colorHeight + $colorGap;
            }
            
            // Output PDF
            $pdf->Output('net_type_distribution.pdf', 'D');
        }
        public function displayTimeChart1($data) {
            $invoice_date = isset($_POST['invoice_date']) ? $_POST['invoice_date'] : '';
            $invoice_due_date = isset($_POST['invoice_due_date']) ? $_POST['invoice_due_date'] : '';
            
            // Fetch booking data based on invoice dates and payment status
            $sql = "SELECT 
                        COUNT(*) AS count, 
                        CASE 
                            WHEN HOUR(time_slots.timeslot) BETWEEN 7 AND 11 THEN '07:00AM-12:00PM'
                            WHEN HOUR(time_slots.timeslot) BETWEEN 12 AND 16 THEN '12:00PM-05:00PM'
                            WHEN HOUR(time_slots.timeslot) BETWEEN 17 AND 21 THEN '05:00PM-10:00PM'
                        END AS hour_range
                    FROM 
                        bookings 
                    INNER JOIN 
                        time_slots ON bookings.id = time_slots.booking_id
                    WHERE 
                        bookings.date >= :invoice_date AND bookings.date <= :invoice_due_date 
                    GROUP BY 
                        hour_range";
            
            $this->db->query($sql);
            $this->db->bind(':invoice_date', $invoice_date);
            $this->db->bind(':invoice_due_date', $invoice_due_date);
            $result = $this->db->resultSet();
            
            // Prepare data for the pie chart
            $netTypeCounts = array();
            foreach ($result as $row) {
                $netTypeCounts[$row->hour_range] = $row->count; // Changed from $row->timeslot
            }
            
            // Initialize PDF
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetFont('helvetica', 'B', 13);
            $pdf->AddPage();
            
            // Title and date range
            $pdf->Write(10, "Time Allocation of Reservations\n");
            $pdf->SetFont('helvetica', '', 13);
            $pdf->Write(10, "Between: " . $data['invoice_date'] . " and " . $data['invoice_due_date'] . "\n\n");
            
            // Pie chart parameters
            $xc = 105;
            $yc = 100;
            $r = 50;
            
            // Pie chart colors and time range labels
            $colors = array(
                '07:00AM-12:00PM' => array(51, 153, 102),    // Green
                '12:00PM-05:00PM' => array(255, 204, 102),  // Yellow
                '05:00PM-10:00PM' => array(204, 102, 102)   // Red
            );
            
            // Draw pie chart and calculate percentages
            $startAngle = 0;
            foreach ($netTypeCounts as $hourRange => $count) {
                $endAngle = $startAngle + ($count / array_sum($netTypeCounts)) * 360;
                $pdf->SetFillColor($colors[$hourRange][0], $colors[$hourRange][1], $colors[$hourRange][2]);
                $pdf->PieSector($xc, $yc, $r, $startAngle, $endAngle, 'FD', false, 0, 2);
                $startAngle = $endAngle;
            }
            
            // Display reservation counts and percentages
            $totalReservations = array_sum($netTypeCounts);
            foreach ($netTypeCounts as $hourRange => $count) {
                $percentage = round(($count / $totalReservations) * 100, 2);
                $pdf->Write(10, "{$hourRange}: {$count} ({$percentage}%) \n");
            }
            
            // Draw color squares and labels
            $xSquare = 70;
            $ySquare = 150;
            $colorWidth = 10;
            $colorHeight = 10;
            $colorGap = 5;
            $colorTextGap = 3;
        
            foreach ($colors as $rangeLabel => $color) {
                $pdf->SetFillColor($color[0], $color[1], $color[2]);
                $pdf->Rect($xSquare, $ySquare, $colorWidth, $colorHeight, 'F');
                $pdf->Text($xSquare + $colorWidth + $colorTextGap, $ySquare + ($colorHeight / 2), $rangeLabel);
                $ySquare += $colorHeight + $colorGap;
            }
            
            // Output PDF
            $pdf->Output('net_type_distribution.pdf', 'I');
        }
        
        public function displayReservationChart1($data) {
            $invoice_date = isset($_POST['invoice_date']) ? $_POST['invoice_date'] : '';
            $invoice_due_date = isset($_POST['invoice_due_date']) ? $_POST['invoice_due_date'] : '';
            
            // Fetch booking data based on invoice dates and payment status
            $sql = "SELECT COUNT(*) AS count, time_slots.netType FROM bookings 
                    INNER JOIN time_slots ON bookings.id = time_slots.booking_id
                    WHERE bookings.date >= :invoice_date AND bookings.date <= :invoice_due_date 
                    GROUP BY time_slots.netType";
            $this->db->query($sql);
            $this->db->bind(':invoice_date', $invoice_date);
            $this->db->bind(':invoice_due_date', $invoice_due_date);
            $result = $this->db->resultSet();
            
            // Prepare data for the pie chart
            $netTypeCounts = array();
            foreach ($result as $row) {
                $netTypeCounts[$row->netType] = $row->count;
            }
            
            // ---------------------------------------------------------
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
            // set font
            $pdf->SetFont('helvetica', 'B', 17);
            
            // add a page
            $pdf->AddPage();
            
            $pdf->Write(10, "NetType Distribution of Reservations\n");
            $pdf->SetFont('helvetica', '', 13);
        
            $pdf->Write(10, "Between: " . $data['invoice_date'] . " and " . $data['invoice_due_date']."\n\n");
        
            // Pie chart parameters
            $xc = 105;
            $yc = 100;
            $r = 50;
            
            // Pie chart colors
            $colors = array(
                'Machine Net' => array(51, 153, 102),    // Green
                'Normal Net A' => array(255, 204, 102),  // Yellow
                'Normal Net B' => array(204, 102, 102)   // Red
            );
            
            $startAngle = 0;
            foreach ($netTypeCounts as $netType => $count) {
                $endAngle = $startAngle + ($count / array_sum($netTypeCounts)) * 360;
                $pdf->SetFillColor($colors[$netType][0], $colors[$netType][1], $colors[$netType][2]);
                $pdf->PieSector($xc, $yc, $r, $startAngle, $endAngle, 'FD', false, 0, 2);
                $startAngle = $endAngle;
            }
            $totalReservations = array_sum($netTypeCounts);
            foreach ($netTypeCounts as $netType => $count) {
                $percentage = round(($count / $totalReservations) * 100, 2);
                $pdf->Write(10, "{$netType}: {$count} ({$percentage}%) \n");
            }
            // Draw squares and color descriptions
$xSquare = 70;
$ySquare = 150;
$colorWidth = 10;
$colorHeight = 10;
$colorGap = 5;
$colorTextGap = 3;

foreach ($colors as $status => $color) {
    // Set color for square
    $pdf->SetFillColor($color[0], $color[1], $color[2]);
    
    // Draw square
    $pdf->Rect($xSquare, $ySquare, $colorWidth, $colorHeight, 'F');
    
    // Write color description
    $pdf->Text($xSquare + $colorWidth + $colorTextGap, $ySquare + ($colorHeight / 2), $status);
    
    // Move to the next position
    $ySquare += $colorHeight + $colorGap;
}
            
            // Close and output PDF document
            $pdf->Output('net_type_distribution.pdf', 'I');
        }
        
        
        
        
        
//         public function displayFilteredOrders($data) {
//             $Product = $data['Product'];
    
           
            
//             $this->db->query('SELECT orders.*, orderitems.*
//             FROM orders
//             INNER JOIN orderitems ON orders.order_id = orderitems.order_id
//             INNER JOIN product ON orderitems.product_id = product.product_id
//             WHERE product.product_title = :product');

//             $this->db->bind(':product', $Product);
//             $result=$this->db->resultSet();

//             if ($result && count($result) > 0) {
//                 echo "<div class='alert alert-success'>Filtered Orders:</div>";
//                 echo "<table class='table table-bordered'>";
//                 echo "<thead><tr><th>Order ID</th><th>Customer Name</th><th>Quantity</th><th>Total Price</th><th>Order Date</th><th>Order Status</th></tr></thead>";
//                 echo "<tbody>";
//                 // $totalPrice = 0;
//                 // $totalPaid = 0;
//                 // $totalPending = 0;
//                 // $totalNotPaid = 0;
//         // Fetching results as objects of stdClass
// foreach ($result as $order) {
//     echo "<tr>";
//         echo "<td>" . $order->order_id . "</td>";
//         echo "<td>" . $order->full_name . "</td>";
//         echo "<td>" . $order->quantity . "</td>";
//         echo "<td>" . $order->price_per_unit . "</td>";
//         echo "<td>" . $order->order_date . "</td>";
//         echo "<td>" . $order->order_status . "</td>";
//         echo "</tr>";
// }

                
        
                
//                 echo "</tbody>";
//                 echo "</table>";
        
              
//                 echo "<form method='post'>";
//                 echo "    <input type='hidden' name='Product' value='" . $Product . "'>";
//                 echo "    <button type='submit' name='download_pdf' class='btn btn-primary'>Download</button>";
//                 echo "</form>";
                         
//               } else {
//                 echo "<div class='alert alert-warning'>No Orses Found.</div>";
//             }
//         }
        public function getMonthlyOrders($data) {

        $input_month = $data['Selected_month'];

        $this->db->query('SELECT orders.*, orderitems.product_id, orderitems.quantity, product.product_title
              FROM orders
              INNER JOIN orderitems ON orders.order_id = orderitems.order_id
              INNER JOIN product ON orderitems.product_id = product.product_id
              WHERE MONTH(orders.order_date) = :input_month');

        $this->db->bind(':input_month', $input_month);

        
        $this->db->bind(':input_month', $input_month);
        return $this->db->resultSet();
    }

        // public function displayMonthlyFilteredOrders($data) {
        //     $input_month = $data['Selected_month'];

        //     $this->db->query('SELECT orders.*, orderitems.product_id, orderitems.quantity, product.product_title
        //           FROM orders
        //           INNER JOIN orderitems ON orders.order_id = orderitems.order_id
        //           INNER JOIN product ON orderitems.product_id = product.product_id
        //           WHERE MONTH(orders.order_date) = :input_month');

        //     $this->db->bind(':input_month', $input_month);

            
        //     $this->db->bind(':input_month', $input_month);
        //     $result = $this->db->resultSet();
        
        //     if ($result && count($result) > 0) {
        //         echo "<div class='alert alert-success'>Filtered Orders:</div>";
        //         echo "<table class='table table-bordered'>";
        //         echo "<thead><tr><th>Customer Name</th><th>Product Name</th><th>Quantity</th><th>order_date</th><th>Payment Status</th><th>Amount</th></tr></thead>";
        //         echo "<tbody>";
        //         $totalPrice = 0;
        //         $totalPaid = 0;
        //         $totalNotPaid = 0;
        
        //         // Fetching results as associative array
        //         foreach ($result as $row) {
        //             echo "<tr>";
        //             echo "<td>" . $row->full_name . "</td>";
        //             echo "<td>" . $row->product_title . "</td>";
        //             echo "<td>" . $row->quantity . "</td>";//                    $order->quantity,

        //             echo "<td>" . $row->order_date . "</td>";
        //             echo "<td>" . $row->payment_status . "</td>";
        //             echo "<td>" . $row->price . "</td>";

        //             echo "</tr>";
        //             $totalPrice += $row->price;
        
        //             //Increment appropriate total based on payment status
        //             switch ($row->payment_status) {
        //                 case 'Paid':
        //                     $totalPaid += $row->price;
        //                     break;
        //                 case 'Not Paid':
        //                     $totalNotPaid += $row->price;
        //                     break;
        //             }
        //         }
        
        //         echo "<tr><td colspan='5' style='text-align:right; font-size: 20px;'><b>Total Paid:</b></td><td style='font-size: 20px;'><b>$totalPaid</td></tr>";
        //         echo "<tr><td colspan='5' style='text-align:right; font-size: 20px;'><b>Total Not Paid:</b></td><td style='font-size: 20px;'><b>$totalNotPaid</td></tr>";
        //         // Calculate the expected total amount
        //         $expectedTotal = $totalPaid  + $totalNotPaid;
        //         echo "<tr><td colspan='5' style='text-align:right; font-size: 20px;'><b>Total Income:</b></td><td style='font-size: 20px;'><b>$expectedTotal</td></tr>";
                
        
        //         echo "</tbody>";
        //         echo "</table>";
        
        //         echo "<form method='post'>";
        //         echo "<input type='hidden' name='Selected_month' value='$input_month'>";
        //         echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download</button>";
                
        //         echo "</form>";
        //     } else {
        //         echo "<div class='alert alert-warning'>No bookings found between the selected dates.</div>";
        //     }
        // }

        // public function displayLogs($data) {
        //     $invoice_date = $data['invoice_date'];
        //     $invoice_due_date = $data['invoice_due_date'];
        
        //     $this->db->query("SELECT * FROM userlog WHERE create_date >= :start_date AND create_date <= :end_date");

        //     $this->db->bind(':start_date', $invoice_date);
        //     $this->db->bind(':end_date', $invoice_due_date);
        //     $result = $this->db->resultSet();
        
        //     if ($result && count($result) > 0) {
        //         echo "<div class='alert alert-success'>Filtered User Logs:</div>";
        //         echo "<table class='table table-bordered'>";
        //         echo "<thead><tr><th>User ID</th><th>User Name</th><th>Email</th><th>Creation Date</th><th>Last Login</th><th>Last Logout</th></tr></thead>";
        //         echo "<tbody>";
           
        
        //         // Fetching results as associative array
        //         foreach ($result as $row) {
        //             echo "<tr>";
        //             echo "<td>" . $row->uid . "</td>"; // User ID
        //             echo "<td>" . $row->user_name . "</td>"; // User Name
        //             echo "<td>" . $row->email . "</td>"; // Email
        //             echo "<td>" . $row->create_date . "</td>"; // Creation Date
        //             echo "<td>" . $row->last_login . "</td>"; // Last Login
        //             echo "<td>" . $row->last_logout . "</td>"; // Last Logout
        //             echo "</tr>";}
        
                    
        //         echo "</tbody>";
        //         echo "</table>";
        
        //         echo "<form method='post'>";
        //         echo "<input type='hidden' name='invoice_date' value='$invoice_date'>";
        //         echo "<input type='hidden' name='invoice_due_date' value='$invoice_due_date'>";
        //         echo "<button type='submit' name='download_pdf' class='btn btn-primary'>Download</button>";
        //         echo "</form>";
        //     } else {
        //         echo "<div class='alert alert-warning'>No bookings123 found between the selected dates.</div>";
        //     }
        // }
        
        
        
    }

      
    
    



    
  