<?php
require_once "controller/services/mysqlDB.php";
require_once "controller/services/view.php";
require_once "model/user.php";
require_once "model/teh.php";
require_once "model/topping.php";
require_once "model/transaksi.php";
require_once "model/pairtransaksi.php";
require_once "model/pesanan.php";

class ManajerController
{
    protected $db;

    public function __construct()
    {
        $this->db = new MySQLDB("localhost", "root", "", "teatime");
    }
    public function view()
    {
        return View::createView('manajer.php', [
            "styleSrcList" => ["style.css"],
            "scriptSrcList" => ["tanggal.js"],
            "title" => "Report"
        ]);
    }

    public function viewHarian()
    {
        $result = $this->getLaporanHarian();
        return View::createView('laporanharian.php', [
            "result" => $result,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Daily Report"
        ]);
    }

    private function getLaporanHarian()
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);

        $query = "
                SELECT pesanan.id, pesanan.jumlah, topping.nama as namaTopping, topping_pesanan.jumlahTopping, transaksi.kode, transaksi.waktu, transaksi.namaPemesan, transaksi.totalHarga, kasir.nama as namaKasir, 
                       pesanan.banyakGula, pesanan.banyakEs, pesanan.ukuran, teh.nama as namaTeh
                FROM topping_pesanan INNER JOIN pesanan
                ON topping_pesanan.fkPesanan = pesanan.id
                INNER JOIN topping
                ON topping_pesanan.fkTopping = topping.id
                INNER JOIN transaksi
                ON pesanan.fkKode = transaksi.kode
                INNER JOIN kasir
                ON transaksi.idKasir = kasir.id
                INNER JOIN teh
                ON pesanan.fkTeh = teh.id
                WHERE transaksi.waktu LIKE '" . date_format($exd, 'Y-m-d') . " %'
            ";
        $query_result = $this->db->executeSelectQuery($query);

        $arrTransaksi = [];

        foreach ($query_result as $key => $value) {
            if (!array_key_exists($value['kode'], $arrTransaksi)) {
                $arrTransaksi[$value['kode']] = new Transaksi($value['kode'], $value['waktu'], $value['totalHarga'], $value['namaPemesan'], $value['namaKasir']);
            }
            if (!array_key_exists($value['id'], $arrTransaksi[$value['kode']]->pesanan)) {
                $pesanan = new Pesanan($value['id'], $value['jumlah'], $value['namaTeh'], $value['ukuran'], $value['banyakEs'], $value['banyakGula']);
                $arrTransaksi[$value['kode']]->addPesanan($pesanan);
            }
            $arrTransaksi[$value['kode']]->pesanan[$value['id']]->addTopping($value['namaTopping'],$value['jumlahTopping']);
        }

        return $arrTransaksi;
    }

    public function viewJamRamai()
    {
        // $result = $this->getJamRamai();
        return View::createView('laporanjamramai.php', [
            // "result" = $result,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Popular Hours Report"
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

    public function viewKasir()
    {
        // $result = $this->getKasir();
        return View::createView('laporankasir.php', [
            // "result" = $result,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Mainstreamed Cashiers Report"
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

    public function viewKeuangan()
    {
        // $result = $this->getKeuangan();
        return View::createView('laporankeuangan.php', [
            // "result" = $result,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Incomes Report"
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

    public function viewRentang()
    {
        // $result = $this->getRentang();
        return View::createView('laporanrentang.php', [
            // "result" = $result,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Ranged Report"
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
