<?php
    require_once "controller/services/mysqlDB.php";
    require_once "model/user.php";
    require_once "model/teh.php";
    require_once "model/topping.php";
    require_once "controller/services/view.php";

    class AdminController{
        protected $db;

        public function __construct()
        {
            $this->db = new MySQLDB("localhost","root","", "teatime");
        }

        public function viewUser(){
            $result = $this->getAllUser();
            return View::createView('userData.php',[
                "result"=>$result,
                "uplevel"=>1,
                "styleSrcList"=>['mainStyle.css']
                ]);
        }
        private function getAllUser(){
            $query="
                SELECT email, nama, tanggalLahir, alamat
                FROM Admin
            ";
            $query_result = $this->db->executeSelectQuery($query);

            $result = [];
            
            foreach($query_result as $key => $value){
                $result [] = new User('Admin',$value['email'],$value['nama'],$value['tanggalLahir'],$value['alamat']);
            }

            $query="
                SELECT email, nama, tanggalLahir, alamat
                FROM Manager
            ";
            $query_result = $this->db->executeSelectQuery($query);

            foreach($query_result as $key => $value){
                $result [] = new User('Manager',$value['email'],$value['nama'],$value['tanggalLahir'],$value['alamat']);
            }

            $query="
                SELECT email, nama, tanggalLahir, alamat
                FROM Kasir
            ";
            $query_result = $this->db->executeSelectQuery($query);
            
            foreach($query_result as $key => $value){
                $result [] = new User('Kasir',$value['email'],$value['nama'],$value['tanggalLahir'],$value['alamat']);
            }
            return $result;
        }

        public function viewTea(){
            $result = $this->getAllTea();
            return View::createView('teaData.php',["result"=>$result]);
        }
        private function getAllTea(){
            $query="
                SELECT id, gambar, nama, hargaRegular, hargaLarge
                FROM Teh
            ";
            $query_result = $this->db->executeSelectQuery($query);

            $result = [];
            
            foreach($query_result as $key => $value){
                $result [] = new Teh($value['id'],$value['gambar'],$value['nama'],$value['hargaRegular'],$value['hargaLarge']);
            }
            return $result;
        }

        public function viewTopping(){
            $result = $this->getAllTopping();
            return View::createView('toppingData.php',["result"=>$result]);
        }
        private function getAllTopping(){
            $query="
                SELECT id, gambar, nama, harga
                FROM Topping
            ";
            $query_result = $this->db->executeSelectQuery($query);

            $result = [];
            
            foreach($query_result as $key => $value){
                $result [] = new Topping($value['id'],$value['gambar'],$value['nama'],$value['harga']);
            }
            return $result;
        }
        public function getTeaById($id){
            $id = $this->db->escapeString($id);

            return $this->db->executeSelectQuery("SELECT * FROM Tea WHERE id = $id")[0];
        }

        public function updateTea()
        {
            if (isset($_POST['idTea']) && $_POST['idTea']!==""){
                $tea = $this->getTeaById($_POST['idTea']);
                
                return View::createView('updateTea.php', [
                    "nama" => $tea['nama'],
                    "hargaRegular" => $tea['hargaRegular'],
                    "hargaLarge" => $tea['hargaLarge']
                ]);
            }
        }
    }
?>