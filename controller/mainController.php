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
        public function viewChangePass($error="")
        {
            return View::createView("changePassword.php",[
                'title' => "",
                'styleSrcList' => ['changePassword.css'],
                'scriptSrcList' => ['changePassword.js'],
                'error' => $error
            ]);
        }
        public function changePassword()
        {
            $post = json_decode(file_get_contents('php://input'), true);
            if (isset($post['userId']) && $post['userId']!=""
                && isset($post['role']) && $post['role']!=""
                && isset($post['oldPass']) && $post['oldPass']!=""
                && isset($post['newPass']) && $post['newPass']!=""
                && isset($post['confirmPass']) && $post['confirmPass']!=""
            ){
                $id = $this->db->escapeString($post['userId']);
                $role = $this->db->escapeString($post['role']);
                $oriPass = $this->db->executeSelectQuery("SELECT password FROM $role WHERE id=$id")[0]['password'];
                if ($oriPass===$post['oldPass']){
                    if ($post['newPass'] === $post['confirmPass']){
                        $newPass = $this->db->escapeString($post['newPass']);

                        $success = null;
                        if ($role == "admin"){
                            $success = $this->db->executeNonSelectQuery("UPDATE $role SET password = '$newPass' WHERE id = $id");
                        } else {
                            $success = $this->db->executeNonSelectQuery("UPDATE $role SET password = '$newPass', isFirstTime = 0 WHERE id = $id");
                        }
                        if ($success){
                            return json_encode(array("status"=>"Success", "message"=>"Password is successfully changed"));
                        } else {
                            return json_encode(array("status"=>"Error", "message"=>"Failed to update password"));
                        }
                    } else {
                        return json_encode(array("status"=>"Error", "message"=>"New passsword is different with confirmed password"));
                    }
                } else {
                    return json_encode(array("status"=>"Error", "message"=>"Old password is wrong"));
                }
            } else {
                return json_encode(array("status"=>"Error", "message"=>"Incomplete input"));
            }
        }
    }
