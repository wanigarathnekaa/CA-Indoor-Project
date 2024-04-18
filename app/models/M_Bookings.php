<?php

// require_once ('C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/TCPDF-main/tcpdf.php');
// require 'C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/phpmailer/src/PHPMailer.php';
// require 'C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/phpmailer/src/Exception.php';
// require 'C:/xampp/htdocs/C&A_Indoor_Project/app/libraries/phpmailer/src/SMTP.php';


// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;


// class MYPDF extends TCPDF
// {

//     public function Invoice($customerName, $email, $payment, $date, $paymentstatus)
//     {
//         // Set PDF properties
//         $this->SetCreator(PDF_CREATOR);
//         $this->SetAuthor('Admin');
//         $this->SetTitle('Invoice');
//         $this->SetSubject('Invoice');
//         $this->SetKeywords('Invoice, Payment');
//         $this->AddPage();

//         // Set font
//         $this->SetFont('helvetica', '', 12);

//         // Company name
//         $this->SetFont('helvetica', 'B', 16);
//         $this->Cell(0, 10, 'C&A Indoor Cricket', 0, 1, 'C');
//         $this->Ln(5);

//         // Payment description
//         $this->SetFont('helvetica', 'B', 12);
//         $this->Ln(10);
//         $this->Cell(0, 10, 'Payment Description', 0, 1, 'L');
//         $this->SetFont('helvetica', '', 12);
//         $this->MultiCell(0, 10, 'This invoice is for the time slot booking payment made on ' . $date . '.', 0, 'L');

//         // Customer details
//         $this->SetFont('helvetica', '', 12);
//         $this->Cell(80, 10, 'Customer Name:', 0, 0, 'L');
//         $this->Cell(0, 10, $customerName, 0, 1, 'R');
//         $this->Cell(80, 10, 'Email:', 0, 0, 'L');
//         $this->Cell(0, 10, $email, 0, 1, 'R');



//         // Payment details
//         $this->SetFont('helvetica', 'B', 12);
//         $this->Ln(5);
//         $this->Cell(0, 10, 'Payment:', 0, 1, 'L');
//         $this->SetFont('helvetica', '', 12);
//         $this->Cell(80, 10, 'Amount:', 0, 0, 'L');
//         $this->Cell(0, 10, $payment, 0, 1, 'R');

//         // Calculate remaining payment
//         $this->SetFont('helvetica', 'B', 12);
//         $this->Ln(5);
//         $this->Cell(0, 10, 'Remaining Payment:', 0, 1, 'L');
//         $this->SetFont('helvetica', '', 12);
//         $remainingPayment = 0;
//         if ($paymentstatus == 'Not Paid') {
//             $remainingPayment = $payment;
//         } elseif ($paymentstatus == 'Pending') {
//             $remainingPayment = $payment - 300;
//         }
//         $this->Cell(0, 10, $remainingPayment, 0, 1, 'R');
//     }
// }



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


    public function sendEmail($reservation)
    {

        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->Invoice($reservation->name, $reservation->email, $reservation->bookingPrice, $reservation->date, $reservation->paymentStatus);



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
        $mail->Password = 'wupbxphjicpfidgj
                ';
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

    public function permanentBooking($data){
        $this->db->query('INSERT INTO permanent_booking (name, email, phoneNumber, date, coach, timeDuration, day, timeSlotA, timeSlotB, timeSlotM) VALUES (:name, :email, :phoneNumber, :date, :coach, :timeDuration, :day, :timeSlotA, :timeSlotB, :timeSlotM)');
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


}
?>