<?php
class Admin extends Controller
{
    private $adminModel;
    public function __construct()
    {
        $this->adminModel = $this->model('M_Admin');

    }
}


?>