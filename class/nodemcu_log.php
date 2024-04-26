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
        public $suhu22;
        public $kelembaban22;
        public $ppm;
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
                        h = :h,
                        t22 = :t22, 
                        h22 = :h22,
                        ppm = :ppm";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // dht11
            $this->suhu=htmlspecialchars(strip_tags($this->suhu));
            $this->kelembaban=htmlspecialchars(strip_tags($this->kelembaban));

            //dht22
            $this->suhu22=htmlspecialchars(strip_tags($this->suhu22));
            $this->kelembaban22=htmlspecialchars(strip_tags($this->kelembaban22));

            //asap
            $this->ppm=htmlspecialchars(strip_tags($this->ppm));
        
            // bind data
            $stmt->bindParam(":t", $this->suhu);
            $stmt->bindParam(":h", $this->kelembaban);
            $stmt->bindParam(":t22", $this->suhu22);
            $stmt->bindParam(":h22", $this->kelembaban22);
            $stmt->bindParam(":ppm", $this->ppm);
            if($stmt->execute()){
               return true;
            }
            return false;
        }
    }
?>