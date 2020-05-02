<?php
    class Topping{
        protected $id;
        protected $gambar;
        protected $nama;
        protected $harga;

        public function __construct($id,$gambar,$nama,$harga){
            $this->id = $id;
            $this->gambar = $gambar;
            $this->nama = $nama;
            $this->harga = $harga;
        }

        public function getId(){
            return $this->id;
        }public function getGambar(){
            return $this->gambar;
        }public function getNama(){
            return $this->nama;
        }public function getHarga(){
            return $this->harga;
        }
        public static function getAllTopping(){
            require_once "controller/services/mysqlDB.php";
            $db = new MySQLDB("localhost","root","", "teatime");

            $query="
                SELECT id, gambar, nama, harga
                FROM Topping
            ";
            $query_result = $db->executeSelectQuery($query);

            $result = [];
            
            foreach($query_result as $key => $value){
                $result [] = new Topping($value['id'],$value['gambar'],$value['nama'],$value['harga']);
            }
            return $result;
        }
    }
?>