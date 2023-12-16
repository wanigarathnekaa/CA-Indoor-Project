<?php

    class Controller{
        public function model($model){
            require_once '../app/models/'. $model. '.php';

            //Instantiate the model and pass it to the controller 
            return new $model;
        }

        //to load the view
        public function view($view, $data=[], $data1=[]){
            if(file_exists('../app/views/'.$view.'.php')){ 
                require_once '../app/views/'.$view.'.php';
            }
            else{
                die("Corresponding view doesn't exist.");
            }

            
        }
    }

?>