<?php 
    class Database{
        private $host ="127.0.0.1";
        private $port = "8889";
        private $db_name ="cms_db";
        private $username ="root";
        private $password ="root";
        public $conn;

        public function getConnection(){
            $this->conn = null;
            
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
               

                $this->conn->exec("set names utf8"); 

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $exeption){
                echo "Connection error: " . $exeption->getMessage();
            }
            return $this->conn;
        }
    }
?>
