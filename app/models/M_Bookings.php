<?php


require_once ('C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/TCPDF-main/tcpdf.php');
require 'C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/phpmailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/phpmailer/src/Exception.php';
require 'C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/phpmailer/src/SMTP.php';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class MYPDF extends TCPDF {

    public function Invoice($id,$customerName, $email, $payment,$paidprice, $date, $paymentstatus,$phoneNumber) {
        // Set PDF properties
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('Admin');
        $this->SetTitle('Invoice');
        $this->SetSubject('Invoice');
        $this->SetKeywords('Invoice, Payment');
        $this->AddPage();




        $this->SetFont('helvetica', 'B', 15);
        $this->Cell(0, 10, 'C & A Cricket Net', 0, 1, 'L');

        
        // RECEIVER & SENDER DETAILS 
        $receiverDetailsX = $this->GetPageWidth() - 10 - $this->GetStringWidth('RECEIVER DETAILS');
        $this->SetXY($receiverDetailsX, $this->GetY() - 10); // Set position to the same line
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'INVOICE', 0, 1, 'R');


        $this->Ln(5);


        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'ORDER PLACED SUCCESSFULLY', 0, 1, 'L');


        $receiverDetailsX = $this->GetPageWidth() - 10 - $this->GetStringWidth('RECEIVER DETAILS');
        $this->SetXY($receiverDetailsX, $this->GetY() - 10); 
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'INV_NO : #' . $id, 0, 1, 'R');

        $this->Ln(5); 

        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'SENDER DETAILS', 0, 1, 'L');



        $receiverDetailsX = $this->GetPageWidth() - 10 - $this->GetStringWidth('RECEIVER DETAILS');
        $this->SetXY($receiverDetailsX, $this->GetY() - 10); 
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'INV_NO : #' . $id, 0, 1, 'R');

        $this->Ln(5); 


        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'SENDER DETAILS', 0, 1, 'L');
        
        
        $receiverDetailsX = $this->GetPageWidth() - 10 - $this->GetStringWidth('RECEIVER DETAILS');
        $this->SetXY($receiverDetailsX, $this->GetY() - 10);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'RECEIVER DETAILS', 0, 1, 'R');




        $this->Ln(5); 





        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 6,'Kaveesha Wanigarathne', 0, 1, 'L');
        


        $receiverDetailsX = $this->GetPageWidth() - 10 - $this->GetStringWidth('RECEIVER DETAILS');
        $this->SetXY($receiverDetailsX, $this->GetY() - 6); 
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 6, $customerName, 0, 1, 'R');


        $this->Ln(1);

        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 6, '0770722933/0701184455', 0, 1, 'L');

        $receiverDetailsX = $this->GetPageWidth() - 10 - $this->GetStringWidth('RECEIVER DETAILS');
        $this->SetXY($receiverDetailsX, $this->GetY() - 6); // Set position to the same line
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 6,$phoneNumber, 0, 1, 'R');


        $this->Ln(1);

        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 6, 'caindoor44@gmail.com', 0, 1, 'L');

        $receiverDetailsX = $this->GetPageWidth() - 10 - $this->GetStringWidth('RECEIVER DETAILS');
        $this->SetXY($receiverDetailsX, $this->GetY() - 6); // Set position to the same line
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 6, $email, 0, 1, 'R');


        $this->Ln(3);




        // Special notes
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'SPECIAL NOTES', 0, 1, 'L');
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 10, 'No special note found', 0, 1, 'L');
        $this->Ln(10);

        // Payment description
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'Payment Description', 0, 1, 'L');
        $this->SetFont('helvetica', '', 12);
        $this->MultiCell(0, 10, 'This invoice is for the time slot booking payment made on ' . $date . '.', 0, 'L');

// Amounts
$this->SetFont('helvetica', 'B', 12);
$this->Cell(0, 10, 'Total Amount: ', 0, 1, 'L');

$receiverDetailsX = $this->GetPageWidth() - 10 - $this->GetStringWidth('RECEIVER DETAILS');
$this->SetXY($receiverDetailsX, $this->GetY() - 6); 
$this->SetFont('helvetica', '', 12);
$this->Cell(0, 10,  number_format($payment, 2), 0, 1, 'R');



$this->SetFont('helvetica', 'B', 12);
$this->Cell(0, 10, 'Paid Amount: ', 0, 1, 'L');

$receiverDetailsX = $this->GetPageWidth() - 10 - $this->GetStringWidth('RECEIVER DETAILS');
$this->SetXY($receiverDetailsX, $this->GetY() - 6); 
$this->SetFont('helvetica', '', 12);
$this->Cell(0, 10,  number_format($paidprice, 2), 0, 1, 'R');



$lineWidth = 50; // Adjust the width as needed

// Calculate the X coordinates
$startX = $this->GetPageWidth() - 10 - $lineWidth; // Starting X coordinate
$endX = $this->GetPageWidth() - 10; // Ending X coordinate

// Draw the line
$this->Line($startX, $this->GetY(), $endX, $this->GetY());

// Move to the next line
$this->Ln(10); // You can adjust the spacing after the line as needed

// SENDER DETAILS on the left
$this->SetFont('helvetica', 'B', 12);
$this->Cell(0, 10, 'Remaining Payment:', 0, 1, 'L');



// RECEIVER DETAILS on the right
$receiverDetailsX = $this->GetPageWidth() - 10 - $this->GetStringWidth('RECEIVER DETAILS');
$this->SetXY($receiverDetailsX, $this->GetY() - 6); // Set position to the same line
$this->SetFont('helvetica', '', 12);
$remainingPayment = $paymentstatus == 'Not Paid' ? $payment : ($paymentstatus == 'Pending' ? ($payment - $paidprice) : 0);
$this->Cell(0, 10,  number_format($remainingPayment, 2), 0, 1, 'R');

// Define the width of the line
$lineWidth = 50; // Adjust the width as needed

// Calculate the X coordinates
$startX = $this->GetPageWidth() - 10 - $lineWidth; // Starting X coordinate
$endX = $this->GetPageWidth() - 10; // Ending X coordinate

// Draw the line
$this->Line($startX, $this->GetY(), $endX, $this->GetY());
$this->Ln(1); // You can adjust the spacing after the line as needed

$this->Line($startX, $this->GetY(), $endX, $this->GetY());



$this->Ln(100); // Adjust the spacing as needed


// Add a straight line after the previous content
$this->Line(10, $this->GetY(), $this->GetPageWidth() - 10, $this->GetY());


$this->Ln(10); // You can adjust the spacing after the line as needed


    }

}



class M_Bookings
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function Booking_Register($data)
    {
        $this->db->query('INSERT INTO reservation (name, email, date, net, timeSlot, phoneNumber, coach) VALUES (:name, :email, :date, :net, :timeSlot, :phoneNumber, :coach)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':net', $data['net']);
        $this->db->bind(':timeSlot', $data['timeSlot']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':coach', $data['coach']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function last_inserted_id()
    {
        $this->db->query("SELECT MAX(id) AS lastID FROM bookings");
        $this->db->execute();
        $result = $this->db->single();
        return $result->lastID;
    }


    public function Make_Reservation($data)
    {
        $this->db->query("INSERT INTO bookings (name, email, phoneNumber, date, coach, bookingPrice, paymentStatus, paidPrice) VALUES (:name, :email, :phoneNumber, :date, :coach, :bookingPrice, :paymentStatus, :paidPrice)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':coach', $data['coach']);
        $this->db->bind(':bookingPrice', $data['bookingPrice']);
        $this->db->bind(':paymentStatus', $data['paymentStatus']);
        $this->db->bind(':paidPrice', $data['paidPrice']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function addTimeSlots($bookingId, $timeSlot, $netType)
    {
        $this->db->query("INSERT INTO time_slots (booking_id, timeSlot, netType) VALUES (:bookingId, :timeSlot, :netType)");
        $this->db->bind(':bookingId', $bookingId);
        $this->db->bind(':timeSlot', $timeSlot);
        $this->db->bind(':netType', $netType);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function findBooking($date, $timeSlot, $net)
    {
        $this->db->query('SELECT * FROM reservation WHERE date = :date && timeSlot = :timeSlot && net = :net');
        $this->db->bind(':date', $date);
        $this->db->bind(':timeSlot', $timeSlot);
        $this->db->bind(':net', $net);


        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function deleteBooking($reservation__Id)
    {
        $this->db->query('DELETE FROM time_slots WHERE id=:id');
        $this->db->bind(':id', $reservation__Id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteReservation($reservation__Id)
    {

        $this->db->query('DELETE FROM bookings WHERE id=:id');
        $this->db->bind(':id', $reservation__Id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function GetReservInfo($reservationId)
    {
        $this->db->query('SELECT * FROM bookings WHERE id = :reservationId');

        $this->db->bind(':reservationId', $reservationId);
        $this->db->execute();
        $resultSet = $this->db->single();

        return $resultSet;

    }


    public function SendEmailToCoach($data, $admin)
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $email = $data['email'];
        $name = $data['name'];
        $phoneNumber = $data['phoneNumber'];
        $date = $data['date'];
        $timeSlots = $data['timeSlots'];

        $adminEMAIL = $admin->email; // Retrieve email
        $adminNAME = $admin->name; // Retrieve name
        $adminPNO = $admin->phoneNumber;


        require_once APPROOT . '/libraries/phpmailer/src/PHPMailer.php';
        require_once APPROOT . '/libraries/phpmailer/src/SMTP.php';
        require_once APPROOT . '/libraries/phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nivodya2001@gmail.com';
        $mail->Password = 'wupbxphjicpfidgj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('nivodya2001@gmail.com', 'Hasini Hewa');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'About your appointment';
        $mail->Body = "Hello $name,<br><br>
        ";
    
    // Assuming $timeSlots is your array of objects
    $timeSlots = '[{"timeSlot":"20:00PM-21:00PM","netType":"Normal Net B","date":"2024-04-26"}]';
    $timeSlotsArray = json_decode($timeSlots, true);
    
    foreach ($timeSlotsArray as $slot) {
        $timeSlot = $slot['timeSlot'];
        $netType = $slot['netType'];
        $date = $slot['date'];
    
        $mail->Body .= "You have a time slot on $date, at $timeSlot assigned to the player $name. Here are their contact details:<br>
            - Phone Number: $phoneNumber<br>
            - Email: $email<br>
            If you have any issues, please contact the administrator before $date.<br><br>
        ";
    }
    
    $mail->Body .= "Admin Details:<br>
        - Name: $adminNAME<br>
        - Phone Number: $adminPNO<br>
        - Email: $adminEMAIL<br>
        Thank you.";
    


        // Attempt to send email
        try {
            $mail->send();
            $response = [
                'status' => 'success',
                'message' => 'Email sent to coach.'
            ];
            return true;

        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo,
            ];
            return false;

        }


    }
    public function getADMINdetails()
    {
        $this->db->query('SELECT * FROM company_users WHERE role = 2');
        $this->db->execute();
        $resultSet = $this->db->single();

        return $resultSet;
    }

    public function sendEmail($reservation)
    {

        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->Invoice($reservation->id, $reservation->name, $reservation->email, $reservation->bookingPrice, $reservation->paidPrice, $reservation->date, $reservation->paymentStatus, $reservation->phoneNumber);



        $file_location = "C:\\xampp\\htdocs\\C&A_Indoor_Project\\app\\views\\Pages\\Report\\Invoice\\";

        $file_name = "INV_" . $reservation->id . ".pdf"; // Concatenate booking ID with file name
        $pdf->Output($file_location . $file_name, 'F'); // F means upload PDF file on some folder
        echo "Upload successfully!!";
        return $file_name;

    }

    public function sendingemail($invoice_name, $reservation)
    {

        $mail = new PHPMailer(true);

        $email = $reservation->email;

        $file_location = "C:\\xampp\\htdocs\\C&A_Indoor_Project\\app\\views\\Pages\\Report\\Invoice\\";


        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nivodya2001@gmail.com';
        $mail->Password = 'wupbxphjicpfidgj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('nivodya2001@gmail.com', 'Hasini Hewa');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'About your complaint';
        $mail->Body = 'Please find the attached PDF file.';

        // Load PDF file
        $file_path = $file_location . $invoice_name; // Assuming $invoice_name contains the file name
        $mail->addAttachment($file_path); // Attach the PDF file

        // Send email
        if ($mail->send()) {
            echo 'Email sent.';
        } else {
            echo 'Email could not be sent.';
        }

    }

    public function permanentBooking($data)
    {
        $this->db->query("INSERT INTO permanent_booking (name, email, phoneNumber, date, coach, timeDuration, day, timeSlotA, timeSlotB, timeSlotM) VALUES (:name, :email, :phoneNumber, :date, :coach, :timeDuration, :day, :timeSlotA, :timeSlotB, :timeSlotM)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':coach', $data['coach']);
        $this->db->bind(':timeDuration', $data['timeDuration']);
        $this->db->bind(':day', $data['day']);
        $this->db->bind(':timeSlotA', $data['timeSlotA']);
        $this->db->bind(':timeSlotB', $data['timeSlotB']);
        $this->db->bind(':timeSlotM', $data['timeSlotM']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPermanentBookings()
    {
        $this->db->query('SELECT * FROM permanent_booking WHERE status = "ongoing"');
        return $this->db->resultSet();
    }

    public function getReservationDetailsByID($bookingId)
    {
        $this->db->query('SELECT * FROM bookings JOIN time_slots ON bookings.id = time_slots.booking_id WHERE time_slots.booking_id = :bookingId ORDER BY bookings.date ASC;');
        $this->db->bind(':bookingId', $bookingId);
        $this->db->execute();
        return $this->db->resultSet(); // Return the result set
    }

    public function getBookingId($date, $netType, $timeSlot)
    {
        $this->db->query('SELECT bookings.id FROM bookings JOIN time_slots ON bookings.id = time_slots.booking_id WHERE bookings.date = :date AND time_slots.netType = :netType AND  time_slots.timeSlot = :timeSlot;');
        $this->db->bind(':date', $date);
        $this->db->bind(':netType', $netType);
        $this->db->bind(':timeSlot', $timeSlot);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function updateReservation($bookingId)
    {
        $this->db->query('UPDATE bookings SET paymentStatus = :paymentStatus, paidPrice = bookingPrice WHERE id = :bookingId');
        $this->db->bind(':paymentStatus', 'Paid');
        $this->db->bind(':bookingId', $bookingId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePermanentBookingStatus($bookingId)
    {
        $this->db->query('UPDATE permanent_booking SET status="Cancelled" WHERE id = :bookingId');
        $this->db->bind(':bookingId', $bookingId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCoachesAvailable($date)
    {
        $this->db->query('SELECT * FROM coach_availability where date = :date');
        $this->db->bind(':date', $date);

        return $this->db->resultSet();
    }

    public function update_coach_availability($data)
    {
        $this->db->query('UPDATE coach_availability SET time_slot = :time_slot WHERE email = :email AND date = :date');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':time_slot', $data['time_slot']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_reserved_timeSlots($data)
    {
        $this->db->query('UPDATE coach_availability SET reserved_slots = :reserved_slots WHERE email = :email AND date = :date');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':reserved_slots', $data['reserved_time_slot']);

        $this->db->execute();
    }

    public function getCoachAvailability($data)
    {
        $this->db->query('SELECT time_slot FROM coach_availability WHERE email = :email AND date = :date');
        $this->db->bind(':email', $data['coach']);
        $this->db->bind(':date', $data['date']);

        return $this->db->resultSet();
    }


}
?>