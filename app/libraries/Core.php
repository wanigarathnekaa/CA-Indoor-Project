<?php
    class Core{
        //Url format--> /Controller/Method/ParamList

        protected $currentController = "Pages";
        protected $currentMethod = "index";
        protected $params = [];

        public function __construct(){
            // print_r($this->getURL());
            $url = $this->getURL();

            if(file_exists('../app/controllers/'.ucwords($url[0].'.php'))){
                //If the controller exist, the load the controller
                $this->currentController = ucwords($url[0]);

                //unset the controller in the URL
                unset($url[0]);
                
                //call the controller
                require_once '../app/controllers/'.$this->currentController.'.php';

                //instantiate the controller
                $this->currentController = new $this->currentController;

                //check whether the method exist in the controller or not
                if(isset($url[1])){
                    if(method_exists($this->currentController, $url[1])){
                        $this->currentMethod = $url[1];

                        unset($url[1]);
                    }
                }

                //get the parameter list
                $this->params = $url ? array_values($url): [];

                //Call method and  pass parameter list
                call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
                

            }

        }

        public function getURL(){
            echo '<br>';
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);

                return $url;
            }      
        }
    }

?>

