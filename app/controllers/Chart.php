<?php

 
class Chart extends Controller{
    private $chartModel;
    public function __construct(){
        $this->chartModel=$this->model('M_Chart');

    }
   
    public function weeklyReservationsChart(){


        $this->view('Pages/Charts/weeklyReservationsChart');



        }

        public function customersCountChart(){


            $this->view('Pages/Charts/customersCountChart');
    
    
    
            }
            public function reservationsNetChart(){


                $this->view('Pages/Charts/reservationsNetChart');
        
        
        
                }
}
                         

?>