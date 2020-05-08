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

    public function addTransaction()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        if(
            isset($post['totalHarga']) && $post['totalHarga']!="" && 
            isset($post['namaPemesan']) && $post['namaPemesan']!="" && 
            isset($post['idKasir']) && $post['idKasir']!="" && 
            isset($post['orderList'])
        ){
            $totalHarga = $this->db->escapeString($post['totalHarga']);
            $namaPemesan = $this->db->escapeString($post['namaPemesan']);
            $idKasir = $this->db->escapeString($post['idKasir']);
            
            $kode = date("Ymd").$this->getOrderNumber();
            
            $query = "
                INSERT INTO transaksi (kode, waktu, totalHarga, namaPemesan, idKasir)
                VALUES ('$kode', '".date("YmdHis")."', $totalHarga, '$namaPemesan', $idKasir)
            ";
            $success = $this->db->executeNonSelectQuery($query);
            
            if ($success !== TRUE){
                $this->db->executeNonSelectQuery("DELETE FROM transaksi WHERE kode = $kode");
                return json_encode(array("status"=>"Fail", "message"=>"Cannot insert transaction record"));
            }
            foreach ($post['orderList'] as $order){
                //insert order
                $gula = $this->db->escapeString($order['gula']);
                $es = $this->db->escapeString($order['es']);
                $ukuran = $this->db->escapeString($order['ukuran']);
                $jumlah = $this->db->escapeString($order['jumlah']);
                $harga = $this->db->escapeString($order['harga']);
                $jumlah = $this->db->escapeString($order['jumlah']);
                $idTeh = $this->db->escapeString($order['idTeh']);
                $query = "
                    INSERT INTO pesanan (banyakGula, banyakEs, ukuran, jumlah, harga, fkTeh, fkKode)
                    VALUES ('$gula', '$es', '$ukuran', $jumlah, $harga, $idTeh, '$kode')
                ";
                $pesananId = $this->db->insertAndGetId($query);
                if (!is_int($pesananId)){
                    $this->db->executeNonSelectQuery("DELETE FROM pesanan WHERE fkKode = $kode");
                    $this->db->executeNonSelectQuery("DELETE FROM transaksi WHERE kode = $kode");
                    return json_encode(array("status"=>"Fail", "message"=>"Cannot insert order record"));
                }

                //insert topping
                foreach($order['topping'] as $topping){
                    $idTopping = $this->db->escapeString($topping['id']);
                    $jumlahTopping = $this->db->escapeString($topping['jumlah']);
                    $query = "
                        INSERT INTO topping_pesanan (fkTopping, fkPesanan, jumlahTopping)
                        VALUES ('$idTopping', '$pesananId', '$jumlahTopping')
                    ";
                    $success = $this->db->executeNonSelectQuery($query);
                    if ($success !== TRUE){
                        $this->db->executeNonSelectQuery("DELETE FROM topping_pesanan WHERE fkPesanan IN (SELECT id FROM pesanan WHERE fkKode = $kode)");
                        $this->db->executeNonSelectQuery("DELETE FROM pesanan WHERE fkKode = $kode");
                        $this->db->executeNonSelectQuery("DELETE FROM transaksi WHERE kode = $kode");
                        return json_encode(array("status"=>"Fail", "message"=>"An error occured while accessing database"));
                    }
                }
            }
            return json_encode(array("status"=>"Success", "message"=>"Transaction recorded"));
        } else {
            return json_encode(array("status"=>"error", "message"=>"Missing variable!"));
        }
    }

    public function getOrderNumber()
    {
        $num = $this->db->executeSelectQuery("SELECT MAX(kode) as 'lastCode' FROM transaksi WHERE waktu LIKE '".date("Y-m-d")." %'")[0]['lastCode'];
        return sprintf("%04d",($num==null)?1:intval(substr($num, 8))+1);
    }
}
