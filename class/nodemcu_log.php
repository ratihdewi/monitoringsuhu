<?php
    class Nodemcu_log{

        // Connection
        private $conn;

        // Table
        private $db_table = "new_dht";

        // Columns
        public $id;
        public $suhu;
        public $kelembaban;
        public $created_at;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // CREATE
        public function createLogData(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        t = :t, 
                        h = :h";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->suhu=htmlspecialchars(strip_tags($this->suhu));
            $this->kelembaban=htmlspecialchars(strip_tags($this->kelembaban));
        
            // bind data
            $stmt->bindParam(":t", $this->suhu);
            $stmt->bindParam(":h", $this->kelembaban);
            if($stmt->execute()){
               return true;
            }
            return false;
        }
    }
?>