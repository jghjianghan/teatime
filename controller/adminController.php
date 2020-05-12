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
                "styleSrcList"=>['admin.css', "font-awesome.css"],
                "scriptSrcList"=> ["userManager.js"]
                ]);
        }
        private function getAllUser(){
            $query="
                SELECT email, nama, tanggalLahir, alamat, id
                FROM Admin
            ";
            $query_result = $this->db->executeSelectQuery($query);

            $result = [];
            
            foreach($query_result as $key => $value){
                $result [] = new User('Admin',$value['email'],$value['nama'],$value['tanggalLahir'],$value['alamat'],$value['id']);
            }

            $query="
                SELECT email, nama, tanggalLahir, alamat,id
                FROM Manager
            ";
            $query_result = $this->db->executeSelectQuery($query);

            foreach($query_result as $key => $value){
                $result [] = new User('Manager',$value['email'],$value['nama'],$value['tanggalLahir'],$value['alamat'],$value['id']);
            }

            $query="
                SELECT email, nama, tanggalLahir, alamat,id
                FROM Kasir
            ";
            $query_result = $this->db->executeSelectQuery($query);
            
            foreach($query_result as $key => $value){
                $result [] = new User('Kasir',$value['email'],$value['nama'],$value['tanggalLahir'],$value['alamat'],$value['id']);
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
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $userTableArr = array ("admin", "manager", "kasir");
                        $used = false;
                        for ($i = 0; $i<3 && !$used; $i++){
                            if ($this->db->executeSelectQuery("SELECT id FROM ".$userTableArr[$i]." WHERE email = '$email'")!=null){
                                $used = true;
                            }
                        }
                        $response = null;
                        if ($used){
                            $response = array("status"=>"error", "message"=>"The email has been used by another account");
                        } else {
                            $success = $this->db->executeNonSelectQuery("INSERT INTO $posisi(email, password, nama, tanggalLahir, alamat)
                                VALUES('".$email."','".$rnd_pass."','".$nama."','".$ttl."','".$alamat."')
                            ");
                            if ($success){
                                $response = array("status"=>"success", "name"=>$nama, "password"=>$rnd_pass);
                            } else {
                                $response = array("status"=>"error", "message"=>"This account can't be created");
                            }
                        }
                        return json_encode($response);
                    }
                    else{
                        return json_encode(array("status"=>"error", "message"=>"Email is invalid"));
                    }
                }else{
                    return json_encode(array("status"=>"error", "message"=>"Not enough information to create account"));
                }
        }

        public function editUser(){
            if(isset($_POST['idUser'])
                && isset($_POST['posisi'])
                && isset($_POST['edit-email'])
                && isset($_POST['edit-nama'])
                && isset($_POST['edit-ttl'])
                && isset($_POST['edit-alamat'])){
                    $id = $this->db->escapeString($_POST['idUser']);
                    $posisi = $this->db->escapeString($_POST['posisi']);
                    $email = $this->db->escapeString($_POST['edit-email']);
                    $nama = $this->db->escapeString($_POST['edit-nama']);
                    $ttl = $this->db->escapeString($_POST['edit-ttl']);
                    $alamat = $this->db->escapeString($_POST['edit-alamat']);
                    // echo $id.'|'.$posisi.'|'.$email.'|'.$nama.'|'.$ttl.'|'.$alamat;
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $this->db->executeNonSelectQuery("UPDATE $posisi SET email = '".$email."', nama = '".$nama."', tanggalLahir = '".$ttl."', alamat = '".$alamat."' WHERE id = $id");
                    }
                }
        }

        public function resetPass(){
            $post = json_decode(file_get_contents('php://input'), true);
            // return $post;
            if (isset($post['idUser']) 
                && isset($post['posisi'])
                &&isset($post['nama'])
                && $post['idUser'] !=="" 
                && $post['posisi']!==""
                && $post['nama']!==""
            ){
                $id = $this->db->escapeString($post['idUser']);
                $posisi = $this->db->escapeString($post['posisi']);
                $nama = $this->db->escapeString($post['nama']);
                $premitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                $rnd_pass = substr(str_shuffle($premitted_chars),0,8);
                $this->db->executeNonSelectQuery("UPDATE $posisi SET password = '$rnd_pass' WHERE id = $id");
                $response = array("status"=>"success", "name"=>$nama, "password"=>$rnd_pass);
                return json_encode($response);
            }else{
                return json_encode(array("status"=>"error"));
            }
        }

        public function deleteUser(){
            $post = json_decode(file_get_contents('php://input'), true);
            if (isset($post['idUser']) && $post['idUser'] !=="" && isset($post['posisi']) && $post['posisi']!==""){
                $id = $this->db->escapeString($post['idUser']);
                $posisi = $this->db->escapeString($post['posisi']);
                // $s = $id .'|'. $posisi;
                // return $s;
                $success = $this->db->executeNonSelectQuery("DELETE FROM $posisi WHERE id = $id");
                if ($success){
                    return json_encode(array("status"=>"Success", "message"=>"User deleted."));
                } else {
                    return json_encode(array("status"=>"Fail", "message"=>"This user cannot be deleted."));
                }
            } else {
                return json_encode(array("status"=>"Fail", "message"=>"Incomplete input"));
            }
        }

        //tea
        public function viewTea(){
            $result = $this->getAllTea();
            return View::createView('teaData.php',[
                "result"=>$result,
                "uplevel"=>1,
                "title"=>"Tea Data",
                "styleSrcList"=>['admin.css', "font-awesome.css"],
                "scriptSrcList"=> ["teaManager.js"]
                ]);
        }

        private function getAllTea(){
            return Teh::getAllTea();
        }

        public function addTea(){
            if(isset($_POST['nama'])
                && isset($_POST['reg'])
                && isset($_POST['large'])
                && isset($_FILES['foto']['name'])
                && $_FILES['foto']['name']!=""){
                if(getimagesize($_FILES['foto']['tmp_name'])!=0){
                    $oldname = $_FILES['foto']['tmp_name'];
                    $gambar = pathinfo($_FILES['foto']['name']);
                    $filename = time().".". $gambar['extension'];
                    $newName = dirname(__DIR__)."\\asset\\img\\tea\\".$filename;
                    move_uploaded_file($oldname, $newName);
                    $nama = $this->db->escapeString($_POST['nama']);
                    $reg = $this->db->escapeString($_POST['reg']);
                    $large = $this->db->escapeString($_POST['large']);
                    $foto = $this->db->escapeString($filename);
                    $this->db->executeNonSelectQuery("INSERT INTO teh(nama, hargaRegular,hargaLarge,gambar) VALUES('".$nama."','".$reg."','".$large."','".$foto."')");
                }
                    
            }
        }

        public function updateTea(){
            if(isset($_POST['update-nama'])
                && isset($_POST['idTeh'])
                && isset($_POST['update-reg'])
                && isset($_POST['update-large'])){
                    if(isset($_FILES['foto']['name'])&& $_FILES['foto']['name']!=""){
                        if(getimagesize($_FILES['foto']['tmp_name'])!=0){
                            $oldname = $_FILES['foto']['tmp_name'];
                            $gambar = pathinfo($_FILES['foto']['name']);
                            $filename = time().".". $gambar['extension'];
                            $newName = dirname(__DIR__)."\\asset\\img\\tea\\".$filename;
                            move_uploaded_file($oldname, $newName);
                            $id = $this->db->escapeString($_POST['idTeh']);
                            $nama = $this->db->escapeString($_POST['update-nama']);
                            $reg = $this->db->escapeString($_POST['update-reg']);
                            $large = $this->db->escapeString($_POST['update-large']);
                            $foto = $this->db->escapeString($filename);
                            $slc = $this->db->executeSelectQuery("SELECT gambar FROM teh WHERE id = $id");
                            unlink(dirname(__DIR__)."\\asset\\img\\tea\\".$slc[0]['gambar']);
                            $this->db->executeSelectQuery("UPDATE teh SET nama = '".$nama."', hargaRegular = '".$reg."', hargaLarge = '".$large."', gambar = '".$foto."' WHERE id = $id");
                            // echo 'f '.$id.'|'.$nama.'|'.$reg.'|'.$large.'|'.$foto;
                            
                        }
                    }
                    else{
                        $id = $this->db->escapeString($_POST['idTeh']);
                        $nama = $this->db->escapeString($_POST['update-nama']);
                        $reg = $this->db->escapeString($_POST['update-reg']);
                        $large = $this->db->escapeString($_POST['update-large']);
                        $this->db->executeNonSelectQuery("UPDATE teh SET nama = '".$nama."', hargaRegular = '".$reg."', hargaLarge = '".$large."' WHERE id = $id");
                        // echo 'nf '.$id.'|'.$nama.'|'.$reg.'|'.$large;
                
                    }
            }
            
        }
        

        public function deleteTea(){
            $post = json_decode(file_get_contents('php://input'), true);
            if (isset($post['idTeh']) && $post['idTeh'] !==""){
                $id = $this->db->escapeString($post['idTeh']);
                $slc = $this->db->executeSelectQuery("SELECT gambar FROM teh WHERE id = $id");
                $result = $this->db->executeNonSelectQuery("DELETE FROM teh WHERE id = $id");
                if($result){
                    unlink(dirname(__DIR__)."\\asset\\img\\tea\\".$slc[0]['gambar']);
                    return json_encode(["status"=>'Success', 'message'=>'Tea is deleted.']);
                }
                else{
                    return json_encode(["status"=>'Fail', 'message'=>'An error occured. Tea could not be deleted.']);
                }
            } else {
                return json_encode(["status"=>'Error', 'message'=>'Missing input. Not enough information to delete tea.']);
            }
        }

        //topping
        public function viewTopping(){
            $result = $this->getAllTopping();
            return View::createView('toppingData.php',[
                "result"=>$result,
                "uplevel"=>1,
                "title"=>"Topping Data",
                "styleSrcList"=>['admin.css', "font-awesome.css"],
                "scriptSrcList"=> ["toppingManager.js"]
                ]);
        }

        private function getAllTopping(){
            return Topping::getAllTopping();
        }
        
        public function addTopping(){
            if(isset($_POST['nama'])
                && isset($_POST['harga'])
                && isset($_FILES['foto']['name'])
                && $_FILES['foto']['name']!=""){
                    if(getimagesize($_FILES['foto']['tmp_name'])!=0){
                        $oldname = $_FILES['foto']['tmp_name'];
                        $gambar = pathinfo($_FILES['foto']['name']);
                        $filename = time().".". $gambar['extension'];
                        $newName = dirname(__DIR__)."\\asset\\img\\topping\\".$filename;
                        move_uploaded_file($oldname, $newName);
                        $nama = $this->db->escapeString($_POST['nama']);
                        $harga = $this->db->escapeString($_POST['harga']);
                        $foto = $this->db->escapeString($filename);
                        $this->db->executeNonSelectQuery("INSERT INTO topping(nama,harga,gambar) VALUES('".$nama."','".$harga."','".$foto."')");
                    }
                }
        }

        public function updateTopping(){
            if(isset($_POST['update-nama'])
                && isset($_POST['update-harga'])
                && isset($_POST['idTopping'])
                ){
                    if(file_exists($_FILES['foto']['tmp_name']) || is_uploaded_file($_FILES['foto']['tmp_name'])){
                        if(getimagesize($_FILES['foto']['tmp_name'])!=0){
                            $oldname = $_FILES['foto']['tmp_name'];
                            $gambar = pathinfo($_FILES['foto']['name']);
                            $filename = time().".". $gambar['extension'];
                            $newName = dirname(__DIR__)."\\asset\\img\\topping\\".$filename;
                            move_uploaded_file($oldname, $newName);
                            $id = $this->db->escapeString($_POST['idTopping']);
                            $nama = $this->db->escapeString($_POST['update-nama']);
                            $harga = $this->db->escapeString($_POST['update-harga']);
                            $foto = $this->db->escapeString($filename);
                            $slc = $this->db->executeSelectQuery("SELECT gambar FROM topping WHERE id = $id");
                            unlink(dirname(__DIR__)."\\asset\\img\\topping\\".$slc[0]['gambar']);
                            $this->db->executeNonSelectQuery("UPDATE topping SET nama = '".$nama."',harga = '".$harga."', gambar = '".$foto."' WHERE id = $id");
                            // echo 'f'.$id.'|'.$nama.'|'.$harga.'|'.$foto;
                        }  
                    }
                    else{
                        $id = $this->db->escapeString($_POST['idTopping']);
                        $nama = $this->db->escapeString($_POST['update-nama']);
                        $harga = $this->db->escapeString($_POST['update-harga']);
                        $this->db->executeNonSelectQuery("UPDATE topping SET nama = '".$nama."',harga = '".$harga."' WHERE id = $id");
                        // echo 'nf'.$id.'|'.$nama.'|'.$harga;
                    }
            }
        }
        
        public function deleteTopping(){
            if (isset($_POST['idTopping']) && $_POST['idTopping'] !==""){
                $id = $this->db->escapeString($_POST['idTopping']);
                $slc = $this->db->executeSelectQuery("SELECT gambar FROM topping WHERE id = $id");
                $result = $this->db->executeNonSelectQuery("DELETE FROM topping WHERE id = $id");
                if($result){
                    unlink(dirname(__DIR__)."\\asset\\img\\topping\\".$slc[0]['gambar']);
                }
                else{
                    
                }
            }
        }

        public function getTeaById($id){
            $id = $this->db->escapeString($id);

            return $this->db->executeSelectQuery("SELECT * FROM Tea WHERE id = $id")[0];
        }

        
    }
?>
