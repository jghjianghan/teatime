<?php
require_once "controller/services/mysqlDB.php";
require_once "controller/services/view.php";

class KasirController
{
    protected $db;

    public function __construct()
    {
        $this->db = new MySQLDB("localhost", "root", "", "teatime");
    }
    public function viewTPS()
    {
        return View::createView('transactionRecord.php', [
            "title" => "Transaction Record",
            "styleSrcList" => ["kasir.css", "font-awesome.css"],
            "scriptSrcList" => [
                "teaOption.js", "teaChooser.js",
                "toppingOption.js", "toppingChooser.js",
                "pesanan.js", "orderList.js", "orderManager.js"
            ]
        ]);
    }

    public function getAllTea()
    {
        require_once "model/teh.php";
        $tehArray = Teh::getAllTea();
        $result = [];
        foreach ($tehArray as $key => $value) {
            $result[] = array(
                "id" => $value->getId(),
                "nama" => $value->getNama(),
                "gambar" => $value->getGambar(),
                "hargaRegular" => $value->getHargaRegular(),
                "hargaLarge" => $value->getHargaLarge()
            );
        }
        return $result;
    }
    public function getAllTopping()
    {
        require_once "model/topping.php";
        $toppingArray = Topping::getAllTopping();

        $result = [];
        foreach ($toppingArray as $key => $value) {
            $result[] = array(
                "id" => $value->getId(),
                "nama" => $value->getNama(),
                "gambar" => $value->getGambar(),
                "harga" => $value->getHarga()
            );
        }
        return $result;
    }

    public function getConfig($filename)
    {
        // return "config/$filename.json";
        return file_get_contents("config/$filename.json");
    }
}
