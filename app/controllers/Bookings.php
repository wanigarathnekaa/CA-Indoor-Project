<?php
class Bookings extends Controller
{
    private $bookingModel;
    public function __construct()
    {
        $this->bookingModel = $this->model('M_Bookings');

    }

}

?>