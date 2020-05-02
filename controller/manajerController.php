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
                "scriptSrcList"=> ["tanggal.js"],
                "title"=>"Report"
            ]);
        }

        public function viewHarian(){
            // $result = $this->getLaporanHarian();
            return View::createView('laporanharian.php',[
                // "result"=>$result,
                "uplevel"=>1,
                "styleSrcList"=>['style2.css'],
                "title"=>"Daily Report"
            ]);
        }
        // private function getLaporanHarian(){
        //     $query="
        //         SELECT transaksi.kode, transaksi.waktu, transaksi.namaPemesan, transaksi.totalHarga, kasir.nama
        //         FROM transaksi INNER JOIN kasir
        //         ON transaksi.email = kasir.email
        //         INNER JOIN pesanan
        //         ON transaksi.kode = pesanan.fkKode
        //         WHERE transaksi.waktu = ".$_POST['tanggal']."
        //     ";
        //     $query_result = $this->db->executeSelectQuery($query);

        //     $result = [];
            
        //     foreach($query_result as $key => $value){
        //         $result [] = new Transaksi($value['kode'],$value['waktu'],$value['namaPemesan'],$value['totalHarga'],$value['kasir.nama']);
        //     }

        //     return $result;
        // }

        public function viewJamRamai(){
            // $result = $this->getJamRamai();
            return View::createView('laporanjamramai.php',[
                // "result" = $result,
                "uplevel"=>1,
                "styleSrcList"=>['style2.css'],
                "title"=>"Popular Hours Report"
            ]);
        }

        // private function getJamRamai(){
        //     $query="
                
        //     ";
        //     $query_result = $this->db->executeSelectQuery($query);

        //     $result = [];
            
        //     foreach($query_result as $key => $value){
        //         $result [] = 
        //     }

        //     return $result;
        // }

        public function viewKasir(){
            // $result = $this->getKasir();
            return View::createView('laporankasir.php',[
                // "result" = $result,
                "uplevel"=>1,
                "styleSrcList"=>['style2.css'],
                "title"=>"Mainstreamed Cashiers Report"
            ]);
        }

        // private function getKasir(){
        //     $query="
            
        //     ";
        //     $query_result = $this->db->executeSelectQuery($query);

        //     $result = [];
            
        //     foreach($query_result as $key => $value){
        //         $result [] = 
        //     }

        //     return $result;
        // }

        public function viewKeuangan(){
            // $result = $this->getKeuangan();
            return View::createView('laporankeuangan.php',[
                // "result" = $result,
                "uplevel"=>1,
                "styleSrcList"=>['style2.css'],
                "title"=>"Incomes Report"
            ]);
        }

        // private function getKeuangan(){
        //     $query="

        //     ";
        //     $query_result = $this->db->executeSelectQuery($query);

        //     $result = [];
            
        //     foreach($query_result as $key => $value){
        //         $result [] = 
        //     }

        //     return $result;
        // }

        public function viewRentang(){
            // $result = $this->getRentang();
            return View::createView('laporanrentang.php',[
                // "result" = $result,
                "uplevel"=>1,
                "styleSrcList"=>['style2.css'],
                "title"=>"Ranged Report"
            ]);
        }

        // private function getRentang(){
        //     $query="
                
        //     ";
        //     $query_result = $this->db->executeSelectQuery($query);

        //     $result = [];
            
        //     foreach($query_result as $key => $value){
        //         $result [] = 
        //     }

        //     return $result;
        // }
    }
