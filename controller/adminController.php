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
        //main-menu admin
        public function view(){
            return View::createView('admin.php',[
                "styleSrcList"=>["admin.css"],
                "title"=>"Admin",
            ]);
        }

        //user
        public function viewUser(){
            $result = $this->getAllUser();
            return View::createView('userData.php',[
                "result"=>$result,
                "title"=>"User Data",
                "uplevel"=>1,
                "styleSrcList"=>['admin.css'],
                "scriptSrcList"=> ["userManager.js"]
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

        // public function viewAddUser(){
        //     return View::createView('addUser.php',[
        //         "uplevel"=>1,
        //         "title"=>"Add User",
        //         "styleSrcList"=>['mainStyle.css']
        //     ]);
        // }

        public function addUser(){
            $post = json_decode(file_get_contents('php://input'), true);
            if(isset($post['posisi']) 
                && isset($post['email'])
                && isset($post['nama'])
                && isset($post['ttl'])
                && isset($post['alamat'])
                && $post['email']!==""
                && $post['nama']!==""
                && $post['alamat']!==""
                ){
                    $premitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                    $rnd_pass = substr(str_shuffle($premitted_chars),0,8);
                    $posisi = $this->db->escapeString($post['posisi']);
                    $email = $this->db->escapeString($post['email']);
                    $nama = $this->db->escapeString($post['nama']);
                    $ttl = $this->db->escapeString($post['ttl']);
                    $alamat = $this->db->escapeString($post['alamat']);
                    $this->db->executeNonSelectQuery("INSERT INTO $posisi(email, password, nama, tanggalLahir, alamat)
                        VALUES('".$email."','".$rnd_pass."','".$nama."','".$ttl."','".$alamat."')
                    ");
                    $response = array("status"=>"success", "name"=>$nama, "password"=>$rnd_pass);
                    return json_encode($response);
                }else{
                    return json_encode(array("status"=>"error"));
                }
        }

        //tea
        public function viewTea(){
            $result = $this->getAllTea();
            return View::createView('teaData.php',[
                "result"=>$result,
                "uplevel"=>1,
                "title"=>"Tea Data",
                "styleSrcList"=>['admin.css'],
                "scriptSrcList"=> ["teaManager.js"]
                ]);
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

        public function viewAddTea(){
            return View::createView('addTea.php',[
                "uplevel"=>1,
                "title"=>"Add Tea",
                "styleSrcList"=>['mainStyle.css']
            ]);
        }

        public function addTea(){
            if(isset($_POST['nama'])
                && isset($_POST['reg'])
                && isset($_POST['large'])
                && isset($_POST['foto'])){
                    $nama = $this->db->escapeString($_POST['nama']);
                    $reg = $this->db->escapeString($_POST['reg']);
                    $large = $this->db->escapeString($_POST['large']);
                    $foto = $this->db->escapeString($_POST['foto']);
                    $this->db->executeNonSelectQuery("INSERT INTO teh(nama, hargaRegular,hargaLarge,gambar) VALUES('".$nama."','".$reg."','".$large."','".$foto."')");
                }
        }

        //topping
        public function viewTopping(){
            $result = $this->getAllTopping();
            return View::createView('toppingData.php',[
                "result"=>$result,
                "uplevel"=>1,
                "title"=>"Topping Data",
                "styleSrcList"=>['admin.css'],
                "scriptSrcList"=> ["toppingManager.js"]
                ]);
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
                
        public function viewAddTopping(){
            return View::createView('addTopping.php',[
                "uplevel"=>1,
                "title"=>"Add Topping",
                "styleSrcList"=>['mainStyle.css']
            ]);
        }
        
        public function addTopping(){
            if(isset($_POST['nama'])
                && isset($_POST['harga'])
                && isset($_POST['foto'])){
                    $nama = $this->db->escapeString($_POST['nama']);
                    $harga = $this->db->escapeString($_POST['harga']);
                    $foto = $this->db->escapeString($_POST['foto']);
                    $this->db->executeNonSelectQuery("INSERT INTO topping(nama,harga,gambar) VALUES('".$nama."','".$harga."','".$foto."')");
                }
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