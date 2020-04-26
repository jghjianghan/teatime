<?php
    require_once "controller/services/mysqlDB.php";
    require_once "controller/services/view.php";
    require_once "model/user.php";
    require_once "model/teh.php";
    require_once "model/topping.php";

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
            $result = $this->getLaporanHarian();
            return View::createView('laporanharian.php',[
                "result"=>$result,
                "uplevel"=>1,
                "styleSrcList"=>['style2.css']
            ]);
        }
        private function getLaporanHarian(){
            $query="
                SELECT kode, waktu, namaPemesan, totalHarga, kasir.nama
                FROM transaksi INNER JOIN kasir
                ON transaksi.email = kasir.email
                WHERE transaksi.waktu = ".$_POST['tanggal']."
            ";
            $query_result = $this->db->executeSelectQuery($query);

            $result = [];
            
            foreach($query_result as $key => $value){
                $result [] = new Transaksi($value['kode'],$value['waktu'],$value['namaPemesan'],$value['totalHarga'],$value['kasir.nama']);
            }

            return $result;
        }

        public function viewJamRamai(){
            $result = $this->getLaporanHarian();
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
