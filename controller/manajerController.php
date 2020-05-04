<?php
require_once "controller/services/mysqlDB.php";
require_once "controller/services/view.php";
require_once "model/user.php";
require_once "model/teh.php";
require_once "model/topping.php";
require_once "model/transaksi.php";
require_once "model/pairtransaksi.php";
require_once "model/pairtransaksi2.php";
require_once "model/pesanan.php";
require_once "model/hari.php";
require_once "model/jam.php";
require_once "model/kasir.php";
require_once "model/keuangan.php";
require_once "model/harirentang.php";

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
            $arrTransaksi[$value['kode']]->pesanan[$value['id']]->addTopping($value['namaTopping'], $value['jumlahTopping']);
        }

        return $arrTransaksi;
    }

    public function viewJamRamai()
    {
        $result = $this->getJamRamai();
        return View::createView('laporanjamramai.php', [
            "result" => $result,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Popular Hours Report"
        ]);
    }

    private function getJamRamai()
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $tgl2 = $_POST['tanggal2'];
        $exd2 = date_create($tgl2);

        $query = "
                SELECT date(transaksi.waktu) as hari, hour(transaksi.waktu) as jam, count(transaksi.kode) as total
                FROM transaksi
                WHERE transaksi.waktu >= '" . date_format($exd, 'Y-m-d') . " 00:00:00' AND transaksi.waktu <= '" . date_format($exd2, 'Y-m-d') . " 23:59:59'
                GROUP BY date(transaksi.waktu), hour(transaksi.waktu)
        ";
        $query_result = $this->db->executeSelectQuery($query);

        $arrHari = [];

        foreach ($query_result as $key => $value) {
            if (!array_key_exists($value['hari'], $arrHari)) {
                $arrHari[$value['hari']] = new Hari($value['hari']);
            }
            if (!array_key_exists($value['jam'], $arrHari[$value['hari']]->jam)) {
                $jam = new Jam($value['jam']);
                $arrHari[$value['hari']]->addJam($jam);
            }
            $arrHari[$value['hari']]->jam[$value['jam']]->addTrans($value['total']);
        }
        
        return $arrHari;
    }

    public function viewKasir()
    {
        $result = $this->getKasir();
        return View::createView('laporankasir.php', [
            "result" => $result,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Mainstreamed Cashiers Report"
        ]);
    }

    private function getKasir()
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $tgl2 = $_POST['tanggal2'];
        $exd2 = date_create($tgl2);

        $query = "
                SELECT date(transaksi.waktu) as waktu, kasir.nama, sum(transaksi.totalHarga) as total
                FROM transaksi INNER JOIN kasir
                ON transaksi.IdKasir = kasir.id               
                WHERE transaksi.waktu >= '" . date_format($exd, 'Y-m-d') . " 00:00:00' AND transaksi.waktu <= '" . date_format($exd2, 'Y-m-d') . " 23:59:59'
                GROUP BY kasir.nama
        ";
        $query_result = $this->db->executeSelectQuery($query);

        $result = [];

        foreach ($query_result as $key => $value) {
            $result[] = new Kasir($value['waktu'], $value['nama'], $value['total']);
        }

        return $result;
    }

    public function viewKeuangan()
    {
        $result = $this->getKeuangan();
        return View::createView('laporankeuangan.php', [
            "result" => $result,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Incomes Report"
        ]);
    }

    private function getKeuangan()
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $tgl2 = $_POST['tanggal2'];
        $exd2 = date_create($tgl2);

        $query = "
            SELECT date(transaksi.waktu) as waktu, sum(transaksi.totalHarga) as total
            FROM transaksi
            WHERE transaksi.waktu >= '" . date_format($exd, 'Y-m-d') . " 00:00:00' AND transaksi.waktu <= '" . date_format($exd2, 'Y-m-d') . " 23:59:59'
            GROUP BY date(transaksi.waktu)
        ";
        $query_result = $this->db->executeSelectQuery($query);

        $result = [];

        foreach ($query_result as $key => $value) {
            $result[] = new Keuangan($value['waktu'], $value['total']);
        }

        return $result;
    }

    public function viewRentang()
    {
        $result = $this->getRentang();
        return View::createView('laporanrentang.php', [
            "result" => $result,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Ranged Report"
        ]);
    }

    private function getRentang()
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $tgl2 = $_POST['tanggal2'];
        $exd2 = date_create($tgl2);

        $query = "
            SELECT date(transaksi.waktu) as hari, teh.nama as teh, sum(pesanan.jumlah) as jumlahTeh
            FROM transaksi INNER JOIN pesanan
            ON transaksi.kode = pesanan.fkKode
            INNER JOIN teh 
            ON teh.id = pesanan.fkTeh
            WHERE transaksi.waktu >= '" . date_format($exd, 'Y-m-d') . " 00:00:00' AND transaksi.waktu <= '" . date_format($exd2, 'Y-m-d') . " 23:59:59' 
            GROUP BY date(transaksi.waktu), teh.nama
        ";

        $query_result = $this->db->executeSelectQuery($query);

        $arrHarian = [];

        foreach ($query_result as $key => $value) {
            if (!array_key_exists($value['hari'], $arrHarian)) {
                $arrHarian[$value['hari']] = new HariRentang($value['hari']);
            }
            $arrHarian[$value['hari']]->addTeh($value['teh'], $value['jumlahTeh']);
        }

        $query = "
            SELECT date(transaksi.waktu) as hari, topping.nama as topping, sum(topping_pesanan.jumlahTopping) as jumlahTopping
            FROM topping_pesanan INNER JOIN pesanan
                ON topping_pesanan.fkPesanan = pesanan.id
                INNER JOIN topping
                ON topping_pesanan.fkTopping = topping.id
                INNER JOIN transaksi
                ON pesanan.fkKode = transaksi.kode           
            WHERE transaksi.waktu >= '" . date_format($exd, 'Y-m-d') . " 00:00:00' AND transaksi.waktu <= '" . date_format($exd2, 'Y-m-d') . " 23:59:59'
            GROUP BY  date(transaksi.waktu), topping.nama 
        ";

        $query_result = $this->db->executeSelectQuery($query);

        foreach ($query_result as $key => $value) {
            $arrHarian[$value['hari']]->addTopping($value['topping'], $value['jumlahTopping']);
        }

        return $arrHarian;
    }
}
