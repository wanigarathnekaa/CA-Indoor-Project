<?php
    class Database{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password = DB_PASSWORD;
        private $dbName = DB_NAME;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct() {
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            //Instantiate PDO
            try{
                $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
            }
            catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }

        }

        //prepare statement
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }

        //bind parameter
        public function bind($param, $value, $type = NULL){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;    
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->stmt->bindValue($param, $value, $type);
        }

        //Execute the prepared statement
        public function execute(){
            return $this->stmt->execute();
        }

        //get multiple records as the result
        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //get single record as the result
        public function single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //get the row count
        public function rowCount(){
            return $this->stmt->rowCount();
        }

    }
?>