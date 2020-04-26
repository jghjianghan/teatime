<?php
    require_once "controller/services/mysqlDB.php";
    require_once "controller/services/view.php";

    class ManajerController{
        protected $db;

        public function __construct()
        {
            $this->db = new MySQLDB("localhost","root","", "teatime");
        }
        public function view()
        {
            return View::createView('manajer.php',[
                "styleSrcList"=>["style.css"],
                "title"=>"Report"
            ]);
        }

        public function viewHarian(){
            return View::createView('laporanharian.php',[
                "uplevel"=>1,
                "styleSrcList"=>['style2.css']
            ]);
        }

        public function viewJamRamai(){
            return View::createView('laporanjamramai.php',[
                "uplevel"=>1,
                "styleSrcList"=>['style2.css']
            ]);
        }

        public function viewKasir(){
            return View::createView('laporankasir.php',[
                "uplevel"=>1,
                "styleSrcList"=>['style2.css']
            ]);
        }

        public function viewKeuangan(){
            return View::createView('laporankeuangan.php',[
                "uplevel"=>1,
                "styleSrcList"=>['style2.css']
            ]);
        }

        public function viewRentang(){
            return View::createView('laporanrentang.php',[
                "uplevel"=>1,
                "styleSrcList"=>['style2.css']
            ]);
        }
    }
?>