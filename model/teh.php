<?php
    class Teh{
        protected $id;
        protected $gambar;
        protected $nama;
        protected $hargaRegular;
        protected $hargaLarge;

        public function __construct($id,$gambar,$nama,$hargaRegular,$hargaLarge){
            $this->id = $id;
            $this->gambar = $gambar;
            $this->nama = $nama;
            $this->hargaRegular = $hargaRegular;
            $this->hargaLarge = $hargaLarge;
        }

        public function getId(){
            return $this->id;
        }public function getGambar(){
            return $this->gambar;
        }public function getNama(){
            return $this->nama;
        }public function getHargaRegular(){
            return $this->hargaRegular;
        }public function getHargaLarge(){
            return $this->hargaLarge;
        }

        public static function getAllTea()
        {
            require_once "controller/services/mysqlDB.php";
            $db = new MySQLDB("localhost","root","", "teatime");
            $query="
                SELECT id, gambar, nama, hargaRegular, hargaLarge
                FROM Teh
            ";
            $query_result = $db->executeSelectQuery($query);
            $result = [];
            
            foreach($query_result as $key => $value){
                $result [] = new Teh($value['id'],$value['gambar'],$value['nama'],$value['hargaRegular'],$value['hargaLarge']);
            }
            return $result;
        }
    }
?>