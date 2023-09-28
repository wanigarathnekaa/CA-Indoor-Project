<?php

class Pages extends Controller{
    public function __construct(){
        //echo 'This is the Pages Controller';
    }

    public function about($name){
        $this->view('v_about');
    }

    public function Dashboard($name){
        if($name == "user"){
            $this->view('Pages/Dashboard/user');
        }
        else if($name == "admin"){
            $this->view('Pages/Dashboard/admin');
        }
        else if($name == "cashier"){
            $this->view('Pages/Dashboard/cashier');
        }
        else if($name == "coach"){
            $this->view('Pages/Dashboard/coach');
        }
        else if($name == "manager"){
            $this->view('Pages/Dashboard/manager');
        }
        else if($name == "owner"){
            $this->view('Pages/Dashboard/owner');
        }
    }
    
    public function Login($name){
        // $role = $name;
        $this->view('Pages/LoginPage/login');
    }
}

?>