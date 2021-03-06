<?php
require_once "controller/services/mysqlDB.php";
require_once "controller/services/view.php";
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

    //main-menu manajer
    public function view()
    {
        $isFirstTime = $this->db->executeSelectQuery("SELECT isFirstTime FROM manager WHERE id = " . $_SESSION['id'])[0]['isFirstTime'];
        $styleList = ["style.css"];
        $scriptList = ["manajerHome.js", "tanggal.js"];
        if ($isFirstTime == 1) {
            $scriptList[] = "changePassNotif.js";
            $styleList[] = "changePassNotif.css";
        }

        return View::createView('manajer.php', [
            "styleSrcList" => $styleList,
            "scriptSrcList" => $scriptList,
            "title" => "Report",
            "selectedIdx" => $this->getSelectedIdx()
        ]);
    }
    private function getSelectedIdx()
    {
        if (isset($_COOKIE['reportIdx'])) {
            return $_COOKIE['reportIdx'];
        } else {
            setcookie("reportIdx", "0", time() + 3600);
            return "0";
        }
    }
    public function setSelectedIdx()
    {
        setcookie("reportIdx", null, time() - 3600);
        if (isset($_POST['index-laporan'])){
            setcookie("reportIdx", $_POST['index-laporan'], time() + 3600);
        } else {
            setcookie("reportIdx", "0", time() + 3600);
        }
    }

    //laporan harian
    public function viewHarian()
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $show = intval($_POST['select-show']);
        
        $start = ($_POST['page'] - 1)*$show;  
        $query = "
                SELECT COUNT(*) as ttl
                FROM transaksi
                WHERE waktu LIKE '" . date_format($exd, 'Y-m-d') . " %'
        ";
        $result = $this->db->executeSelectQuery($query);
        $pageCount = ceil($result[0]['ttl'] / $show);

        $result = $this->getLaporanHarianLimit($start, $show);
        $result2 = $this->getTotalPesananHarian();
        $result3 = $this->getTotalUangHarian();
        return View::createView('laporanharian.php', [
            "result" => $result,
            "result2" => $result2,
            "result3" => $result3,
            "start" => $start,
            "show" => $show,
            "pageCount" => $pageCount,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "scriptSrcList" => ['showChooser.js'],
            "title" => "Daily Report"
        ]);
    }

    public function getLaporanHarian()
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);

        $query = "
                SELECT pesanan.id, pesanan.jumlah, topping.nama as namaTopping, topping_pesanan.jumlahTopping, transaksi.kode, transaksi.waktu, transaksi.namaPemesan, transaksi.totalHarga, kasir.nama as namaKasir, 
                       pesanan.banyakGula, pesanan.banyakEs, pesanan.ukuran, teh.nama as namaTeh
                FROM topping_pesanan RIGHT OUTER JOIN pesanan
                ON topping_pesanan.fkPesanan = pesanan.id
                LEFT OUTER JOIN topping
                ON topping_pesanan.fkTopping = topping.id
                INNER JOIN transaksi
                ON pesanan.fkKode = transaksi.kode
                INNER JOIN kasir
                ON transaksi.idKasir = kasir.id
                INNER JOIN teh
                ON pesanan.fkTeh = teh.id
                WHERE transaksi.waktu LIKE '" . date_format($exd, 'Y-m-d') . " %'
                ORDER BY transaksi.waktu, transaksi.kode
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

    public function getLaporanHarianLimit($start, $show)
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);

        $query = "
        SELECT pesanan.id, pesanan.jumlah, topping.nama as namaTopping, topping_pesanan.jumlahTopping, t1.kode, t1.waktu, t1.namaPemesan, t1.totalHarga, kasir.nama as namaKasir, 
        pesanan.banyakGula, pesanan.banyakEs, pesanan.ukuran, teh.nama as namaTeh
        FROM (
        SELECT *
        FROM transaksi
        WHERE transaksi.waktu LIKE '" . date_format($exd, 'Y-m-d') . " %'
        LIMIT " . $start . "," . $show . "
        ) as t1 
        INNER JOIN pesanan ON pesanan.fkKode = t1.kode
        LEFT OUTER JOIN topping_pesanan
        ON topping_pesanan.fkPesanan = pesanan.id
        LEFT OUTER JOIN topping
        ON topping_pesanan.fkTopping = topping.id
        INNER JOIN kasir
        ON t1.idKasir = kasir.id
        INNER JOIN teh
        ON pesanan.fkTeh = teh.id
        ORDER BY t1.waktu, t1.kode
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

    public function getTotalPesananHarian()
    {
        $arr = $this->getLaporanHarian();
        $result = [];

        foreach ($arr as $key => $value) {
            foreach ($value->pesanan as $key2 => $value2) {
                if (!array_key_exists($value2->getNamaTeh(), $result)) {
                    $result[$value2->getNamaTeh()] = 0;
                }
                $result[$value2->getNamaTeh()] += $value2->getJumlahPesanan();
                foreach ($value2->topping as $key3 => $value3) {
                    if (!array_key_exists($value3->getNamaTopping(), $result)) {
                        $result[$value3->getNamaTopping()] = 0;
                    }
                    $result[$value3->getNamaTopping()] += $value3->getJumlahTopping();
                }
            }
        }

        return $result;
    }

    public function getTotalUangHarian()
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);

        $query = "
                SELECT sum(transaksi.totalHarga) as total
                FROM transaksi
                WHERE transaksi.waktu LIKE '" . date_format($exd, 'Y-m-d') . " %'
            ";

        $query_result = $this->db->executeSelectQuery($query);

        return $query_result[0]['total'];
    }

    //laporan jam ramai
    public function viewJamRamai()
    {
        $result = $this->getLaporanJamRamai();
        $result2 = $this->getTotalJamRamai();
        $result3 = $this->getRataJamRamai();
        return View::createView('laporanjamramai.php', [
            "result" => $result,
            "result2" => $result2,
            "result3" => $result3,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "scriptSrcList" => ['chart.js', 'jamChart.js'],
            "title" => "Popular Hours Report"
        ]);
    }

    private function getLaporanJamRamai()
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

    public function getTotalJamRamai()
    {
        $arr = $this->getLaporanJamRamai();
        $result = [];
        for ($i = 10; $i <= 20; $i++) {
            $result[$i] = 0;
        }
        foreach ($arr as $key => $value) {
            for ($i = 10; $i <= 20; $i++) {
                if (array_key_exists($i, $value->jam)) {
                    $result[$i] += $value->jam[$i]->getTotal();
                }
            }
        }

        return $result;
    }

    public function getRataJamRamai()
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $tgl2 = $_POST['tanggal2'];
        $exd2 = date_create($tgl2);
        $counter = date_diff($exd, $exd2);
        $val = $counter->format("%a") + 1;

        $arr = $this->getTotalJamRamai();

        for ($i = 10; $i <= 20; $i++) {
            $arr[$i] = $arr[$i] / $val;
        }
        return $arr;
    }

    //laporan kasir populer
    public function viewKasir()
    {
        $result = $this->getLaporanKasir();
        return View::createView('laporankasir.php', [
            "result" => $result,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Mainstreamed Cashiers Report"
        ]);
    }

    public function getLaporanKasir()
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
                GROUP BY date(transaksi.waktu),kasir.nama
        ";
        $query_result = $this->db->executeSelectQuery($query);

        $result = [];

        foreach ($query_result as $key => $value) {
            $result[] = new Kasir($value['waktu'], $value['nama'], $value['total']);
        }

        return $result;
    }

    //Laporan keuangan
    public function viewKeuangan()
    {
        $result = $this->getLaporanKeuangan();
        $result2 = $this->getTotalUang();
        return View::createView('laporankeuangan.php', [
            "result" => $result,
            "result2" => $result2,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Incomes Report"
        ]);
    }

    public function getLaporanKeuangan()
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

    public function getTotalUang()
    {
        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $tgl2 = $_POST['tanggal2'];
        $exd2 = date_create($tgl2);

        $query = "
        SELECT sum(transaksi.totalHarga) as total
        FROM transaksi
        WHERE transaksi.waktu >= '" . date_format($exd, 'Y-m-d') . " 00:00:00' AND transaksi.waktu <= '" . date_format($exd2, 'Y-m-d') . " 23:59:59'
            ";

        $query_result = $this->db->executeSelectQuery($query);

        return $query_result[0]['total'];
    }

    //Laporan hari berentang
    public function viewRentang()
    {
        $result = $this->getLaporanRentang();
        $result2 = $this->getTotalPesananTehRentang();
        $result3 = $this->getTotalPesananToppingRentang();
        return View::createView('laporanrentang.php', [
            "result" => $result,
            "result2" => $result2,
            "result3" => $result3,
            "uplevel" => 1,
            "styleSrcList" => ['style2.css'],
            "title" => "Ranged Report"
        ]);
    }

    public function getLaporanRentang()
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
            FROM topping_pesanan RIGHT OUTER JOIN pesanan
                ON topping_pesanan.fkPesanan = pesanan.id
                LEFT OUTER JOIN topping
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

    public function getTotalPesananTehRentang()
    {
        $arr = $this->getLaporanRentang();
        $result = [];

        foreach ($arr as $key => $value) {
            foreach ($value->teh as $key2 => $value2) {
                if (!array_key_exists($value2->getNamaTeh(), $result)) {
                    $result[$value2->getNamaTeh()] = 0;
                }
                $result[$value2->getNamaTeh()] += $value2->getJumlahTeh();
            }
        }

        return $result;
    }

    public function getTotalPesananToppingRentang()
    {
        $arr = $this->getLaporanRentang();
        $result = [];

        foreach ($arr as $key => $value) {
            foreach ($value->topping as $key2 => $value2) {
                if (!array_key_exists($value2->getNamaTopping(), $result)) {
                    $result[$value2->getNamaTopping()] = 0;
                }
                $result[$value2->getNamaTopping()] += $value2->getJumlahTopping();
            }
        }

        return $result;
    }
}
