<?php
    require_once "controller/services/mysqlDB.php";
    require_once "controller/services/view.php";

    class MainController{
        protected $db;

        public function __construct()
        {
            $this->db = new MySQLDB("localhost","root","", "teatime");
        }
        public function viewHomw()
        {
            return 'uwu';
        }
    }
?>