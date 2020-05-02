<?php
    require_once "controller/services/mysqlDB.php";
    require_once "controller/services/view.php";
    require_once "model/teh.php";

    class KasirController{
        protected $db;

        public function __construct()
        {
            $this->db = new MySQLDB("localhost","root","", "teatime");
        }
        public function viewTPS()
        {
            return View::createView('transactionRecord.php',[
                "title" => "Transaction Record",
                "styleSrcList" => ["kasir.css", "font-awesome.css"],
                "scriptSrcList" => ["teaChooser.js", "toppingChooser.js", "orderList.js", "orderManager.js"]
            ]);
        }

        public function getAllTea()
        {
            $tehArray = Teh::getAllTea();
            $result = [];
            foreach($tehArray as $key=>$value){
                $result[] = array(
                    "id"=>$value->getId(),
                    "nama"=>$value->getNama(),
                    "gambar"=>$value->getGambar(),
                    "hargaRegular"=>$value->getHargaRegular(),
                    "hargaLarge"=>$value->getHargaLarge()
                );
            }
            return $result;
        }
    }
?>