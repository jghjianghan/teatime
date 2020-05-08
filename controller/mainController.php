<?php
    require_once "controller/services/mysqlDB.php";
    require_once "controller/services/view.php";

    class MainController{
        protected $db;

        public function __construct()
        {
            $this->db = new MySQLDB("localhost","root","", "teatime");
        }
        public function viewHome()
        {
            return View::createView("home.php",[
                'title' => "Home"
            ]);
        }
        public function viewForbidden()
        {
            return View::createView("forbidden.php",[
                'title' => "Access Denied"
            ]);
        }
        public function viewLogin($message = "")
        {
            return View::createView("login.php",[
                'title' => "Login",
                'styleSrcList' => ["login.css", "font-awesome.css"],
                "message" => $message
            ]);
        }

        public function validateLogin()
        {
            if (isset($_POST['email']) && $_POST['email']!="" && isset($_POST['password']) && $_POST['password']!=""){
                $email = $this->db->escapeString($_POST['email']);
                $password = $_POST['password'];

                $result = $this->db->executeSelectQuery("SELECT id, nama FROM admin WHERE email = '$email'");
                
                if ($result != null){
                    $idUser = $result[0]['id'];
                    if ($password == $this->db->executeSelectQuery("SELECT password FROM admin WHERE id = $idUser")[0]['password']){
                        $_SESSION['role'] = 'admin';
                        $_SESSION['id'] = $idUser;
                        $_SESSION['name'] = $result[0]['nama'];
                        header("location: admin");
                        return;
                    } else {
                        return $this->viewLogin("Wrong password");
                    }
                }
                
                $result = $this->db->executeSelectQuery("SELECT id, nama FROM manager WHERE email = '$email'");
                if ($result != null){
                    $idUser = $result[0]['id'];
                    if ($password == $this->db->executeSelectQuery("SELECT password FROM manager WHERE id = $idUser")[0]['password']){
                        $_SESSION['role'] = 'manager';
                        $_SESSION['id'] = $idUser;
                        $_SESSION['name'] = $result[0]['nama'];
                        header("location: manajer");
                        return;
                    } else {
                        return $this->viewLogin("Wrong password");
                    }
                }
                $result = $this->db->executeSelectQuery("SELECT id, nama FROM kasir WHERE email = '$email'");
                if ($result != null){
                    $idUser = $result[0]['id'];
                    if ($password == $this->db->executeSelectQuery("SELECT password FROM kasir WHERE id = $idUser")[0]['password']){
                        $_SESSION['role'] = 'kasir';
                        $_SESSION['id'] = $idUser;
                        $_SESSION['name'] = $result[0]['nama'];
                        header("location: kasir");
                        return;
                    } else {
                        return $this->viewLogin("Wrong password");
                    }
                }
                return $this->viewLogin("User not found");
            } else {
                return $this->viewLogin("Please fill both email and password");
            }
        }
        public function logout()
        {
            session_unset();
            session_destroy();
            header("location: index");
        }
        public function viewChangePass()
        {
            return View::createView("changePassword.php",[
                'title' => "",
                'styleSrcList' => ['changePassword.css']
            ]);
        }
    }
