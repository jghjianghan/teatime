<?php
require("library/fpdf/fpdf.php");
require("library/fpdf/fpdfMCT/mc_table.php");
require_once "controller/manajerController.php";

class pdfController
{
    public function __construct()
    {
        $this->mc = new ManajerController();
    }


    public function getPdfHarian()
    {
        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetWidths(array(32,30,30,35,30,30));

        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $exd = date_format($exd, 'd-m-Y');
        $pdf->Cell(190, 7, 'Laporan Harian ' . "$exd", 0, 1);
        $pdf->Ln();

        $heading = array(
            'kode' => 'Kode',
            'waktu' => 'Waktu',
            'namakasir' => 'Nama Kasir',
            'namapemesan' => 'Nama Pemesan',
            'pesanan' => 'Pesanan',
            'hargatotal' => 'Harga total'
        );

        $result = $this->mc->getLaporanHarian();

        $pdf->Row(array('Kode', 'Waktu','Nama Kasir','Nama Pemesan','Pesanan','Harga total'));
        foreach ($result as $key => $value) {
            $kalimat = "";
            foreach ($value->pesanan as $key2 => $value2) {
                $kalimat .= $value2->getJumlahPesanan() . " " . $value2->getNamaTeh() . "\n";
                foreach ($value2->topping as $key2 => $value3) {
                    if ($value3->getJumlahTopping() && $value3->getNamaTopping()) {
                        $kalimat .= $value3->getJumlahTopping() . " " . $value3->getNamaTopping() . "\n";
                    }
                }

                if ($value2->getJumlahEs()) {
                    $kalimat .= $value2->getJumlahEs() . "\n";
                }
                if ($value2->getJumlahGula()) {
                    $kalimat .= $value2->getJumlahGula() . "\n";
                }
                if ($value2->getUkuranGelas()) {
                    $kalimat .= $value2->getUkuranGelas() . "\n";
                }
            }
            $pdf->Row(array( $value->getKode(), $value->getWaktu(), $value->getNamaKasir(),$value->getNamaPemesan(),$kalimat,$value->getTotalHarga()));
        }

        ob_end_clean();
        $pdf->Output();
    }

    public function getPdfKeuangan()
    {
        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetWidths(array(40,40));

        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $exd = date_format($exd, 'd-m-Y');
        $tgl2 = $_POST['tanggal2'];
        $exd2 = date_create($tgl2);
        $exd2 = date_format($exd2, 'd-m-Y');
        $pdf->Cell(190, 7, 'Laporan Keuangan '. "$exd - $exd2", 0, 1);
        $pdf->Ln();

        $heading = array(
            'waktu' => 'Waktu',
            'total' => 'Total',
        );

        $result = $this->mc->getLaporanKeuangan();
        $result2 = $this->mc->getTotalUang();

        $pdf->Row(array('Tanggal dan waktu','Jumlah pemasukan (Rp.)'));
        foreach ($result as $key => $value) {
            $pdf->Row(array($value->getWaktu(),$value->getJumlahHarga()));
        }
        $pdf->Row(array('Total', $result2));

        ob_end_clean();
        $pdf->Output();
    }

    public function getPdfKasir()
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $exd = date_format($exd, 'd-m-Y');
        $tgl2 = $_POST['tanggal2'];
        $exd2 = date_create($tgl2);
        $exd2 = date_format($exd2, 'd-m-Y');
        $pdf->Cell(190, 7, 'Laporan Kasir '. "$exd - $exd2", 0, 1);
        $pdf->Ln();

        $heading = array(
            'waktu' => 'Waktu',
            'kasir' => 'Kasir',
            'total' => 'Total'
        );

        $result = $this->mc->getLaporanKasir();

        $pdf->Cell(45, 10, 'Tanggal', 1);
        $pdf->Cell(45, 10, 'Kasir', 1);
        $pdf->Cell(45, 10, 'Total', 1);
        $pdf->Ln();
        foreach ($result as $key => $value) {
            $pdf->Cell(45, 10, $value->getWaktu(), 1);
            $pdf->Cell(45, 10, $value->getNamaKasir(), 1);
            $pdf->Cell(45, 10, $value->getJumlahHarga(), 1);
            $pdf->Ln();
        }

        ob_end_clean();
        $pdf->Output();
    }

    public function getPdfRentang()
    {
        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetWidths(array(45,45,45));

        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $exd = date_format($exd, 'd-m-Y');
        $tgl2 = $_POST['tanggal2'];
        $exd2 = date_create($tgl2);
        $exd2 = date_format($exd2, 'd-m-Y');
        $pdf->Cell(190, 7, 'Laporan Rentang '. "$exd - $exd2", 0, 1);
        $pdf->Ln();

        $heading = array(
            'tanggal' => 'Tanggal',
            'teh' => 'Teh',
            'toping' => 'Topping'
        );

        $result = $this->mc->getLaporanRentang();
        $result2 = $this->mc->getTotalPesananTehRentang();
        $result3 = $this->mc->getTotalPesananToppingRentang();

        $pdf->Row(array('Tanggal', 'Teh', 'Topping'));
        foreach ($result as $key => $value) {
            $kalimat1 = "";
            $kalimat2 = "";
            foreach ($value->teh as $key => $value2) {
                $kalimat1 .= $value2->getJumlahTeh() . " ";
                $kalimat1 .= $value2->getNamaTeh() . "\n";
            }
            foreach ($value->topping as $key => $value2) {
                if ($value2->getJumlahTopping() && $value2->getNamaTopping()) {
                    $kalimat2 .= $value2->getJumlahTopping() . " ";
                    $kalimat2 .= $value2->getNamaTopping() . "\n";
                } else {
                    $kalimat2 .= "-\n";;
                }
            }
            $pdf->Row(array($value->getWaktu(),$kalimat1,$kalimat2));
        }
        $kalimat3 = "";
        foreach ($result2 as $key => $value2) {
            $kalimat3 .= "$value2 $key" . "\n";
        }
        $kalimat4 = "";
        foreach ($result3 as $key => $value3) {
            if ($value3 !== 0) {
                $kalimat4 .= "$value3 $key\n";
            }
        }
        $pdf->Row(array('Total', $kalimat3, $kalimat4));

        ob_end_clean();
        $pdf->Output();
    }

    public function getPdfJamRamai()
    {
        $pdf = new FPDF('L');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $tgl = $_POST['tanggal1'];
        $exd = date_create($tgl);
        $exd = date_format($exd, 'd-m-Y');
        $tgl2 = $_POST['tanggal2'];
        $exd2 = date_create($tgl2);
        $exd2 = date_format($exd2, 'd-m-Y');
        $pdf->Cell(190, 7, 'Laporan Jam Ramai '. "$exd - $exd2", 0, 1);
        $pdf->Ln();

        $heading = array(
            'waktu' => 'Waktu',
            'kasir' => 'Kasir',
            'total' => 'Total'
        );

        $result = $this->mc->getLaporanKasir();
        $result2 = $this->mc->getTotalJamRamai();
        $result3 = $this->mc->getRataJamRamai();

        $pdf->Cell(35, 10, 'Tanggal/jam', 1);
        $pdf->Cell(20, 10, '10-11', 1);
        $pdf->Cell(20, 10, '11-12', 1);
        $pdf->Cell(20, 10, '12-13', 1);
        $pdf->Cell(20, 10, '13-14', 1);
        $pdf->Cell(20, 10, '14-15', 1);
        $pdf->Cell(20, 10, '15-16', 1);
        $pdf->Cell(20, 10, '16-17', 1);
        $pdf->Cell(20, 10, '17-18', 1);
        $pdf->Cell(20, 10, '18-19', 1);
        $pdf->Cell(20, 10, '19-20', 1);
        $pdf->Cell(20, 10, '20-21', 1);
        $pdf->Ln();
        foreach ($result as $key => $value) {
            $pdf->Cell(35, 10, $value->getWaktu(),1);
            for ($i = 10; $i <= 20; $i++) {
                if (array_key_exists($i, $value->jam)) {
                    $pdf->Cell(20, 10, $value->jam[$i]->getTotal(),1);
                } else {
                    $pdf->Cell(20, 10, "-", 1);
                }
            }
            $pdf->Ln();
        }
        $pdf->Cell(35, 10, "Total",1);
        foreach ($result2 as $key => $value) {
            $pdf->Cell(20, 10, $value, 1);
        }
        $pdf->Ln();
        $pdf->Cell(35, 10, "Rata-rata",1);
        foreach ($result3 as $key => $value) {
            $pdf->Cell(20, 10, round($value,3), 1);
        }

        ob_end_clean();
        $pdf->Output();
    }
}
