<?php
require("library/fpdf/fpdf.php");
require("library/fpdf/fpdfMCT/mc_table.php") ;
require_once "controller/manajerController.php";

class pdfController
{
    public function __construct()
    {
        $this->mc = new ManajerController();
    }


    public function getPdfHarian()
    {
        $pdf = new PDF_MC_Table('L', 'mm', array(500, 650));
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(190, 7, 'Laporan Harian', 0, 1);
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

        $pdf->Cell(30, 10, 'Kode', 1);
        $pdf->Cell(30, 10, 'Waktu', 1);
        $pdf->Cell(30, 10, 'Nama Kasir', 1);
        $pdf->Cell(30, 10, 'Nama Pemesan', 1);
        $pdf->Cell(30, 10, 'Pesanan', 1);
        $pdf->Cell(30, 10, 'Harga total', 1);
        $pdf->Ln();
        foreach ($result as $key => $value) {
            $pdf->Cell(30, 10, $value->getKode(), 1);
            $pdf->Cell(30, 10, $value->getWaktu(), 1);
            $pdf->Cell(30, 10, $value->getNamaKasir(), 1);
            $pdf->Cell(30, 10, $value->getNamaPemesan(), 1);
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
            $pdf->MultiCell(0, 10, $kalimat);
            $pdf->Cell(30, 10, $value->getTotalHarga(), 1);
            $pdf->Ln();
        }

        ob_end_clean();
        $pdf->Output();
    }

    public function getPdfKeuangan()
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(190, 7, 'Laporan Keuangan', 0, 1);
        $pdf->Ln();

        $heading = array(
            'waktu' => 'Waktu',
            'total' => 'Total',
        );

        $result = $this->mc->getLaporanKeuangan();
        $result2 = $this->mc->getTotalUang();

        $pdf->Cell(70, 10, 'Tanggal dan waktu', 1);
        $pdf->Cell(70, 10, 'Jumlah uang pemasukan', 1);
        $pdf->Ln();
        foreach ($result as $key => $value) {
            $pdf->Cell(70, 10, $value->getWaktu(), 1);
            $pdf->Cell(70, 10, $value->getJumlahHarga(), 1);
            $pdf->Ln();
        }
        $pdf->Cell(70, 10, 'Total', 1);
        $pdf->Cell(70, 10, $result2, 1);

        ob_end_clean();
        $pdf->Output();
    }

    public function getPdfKasir()
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(190, 7, 'Laporan Kasir', 0, 1);
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
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(190, 7, 'Laporan Kasir', 0, 1);
        $pdf->Ln();

        $heading = array(
            'tanggal' => 'Tanggal',
            'teh' => 'Teh',
            'toping' => 'Topping'
        );

        $result = $this->mc->getLaporanRentang();
        $result2 = $this->mc->getTotalPesananTehRentang();
        $result3 = $this->mc->getTotalPesananToppingRentang();

        $pdf->Cell(45, 10, 'Tanggal', 1);
        $pdf->Cell(45, 10, 'Teh', 1);
        $pdf->Cell(45, 10, 'Topping', 1);
        $pdf->Ln();
        foreach ($result as $key => $value) {
            $pdf->Cell(45, 10, $value->getWaktu(), 1);
            $pdf->Ln();
            $kalimat1 = "";
            $kalimat2 = "";
            foreach ($value->teh as $key => $value2) {
                $kalimat1 .= $value2->getJumlahTeh() . " ";
                $kalimat1 .= $value2->getNamaTeh() . "\n";
            }
            $pdf->MultiCell(0, 10, $kalimat1);
            foreach ($value->topping as $key => $value2) {
                if ($value2->getJumlahTopping() && $value2->getNamaTopping()) {
                    $kalimat2 .= $value2->getJumlahTopping() . " ";
                    $kalimat2 .= $value2->getNamaTopping() . "\n";
                } else {
                    $kalimat2 .= "-\n";;
                }
            }
            $pdf->MultiCell(0, 10, $kalimat2);
            $pdf->Ln();
        }
        $pdf->Cell(45, 10, 'Total', 1);
        $kalimat3 = "";
        foreach ($result2 as $key => $value2) {
            $kalimat3 .= "$value2 $key" . "\n";
        }
        $pdf->MultiCell(0, 10, $kalimat3);
        $kalimat4 = "";
        foreach ($result3 as $key => $value3) {
            if ($value3 !== 0) {
                $kalimat4 .= "$value3 $key\n";
            }
        }
        $pdf->MultiCell(0, 10, $kalimat4);

        ob_end_clean();
        $pdf->Output();
    }

    public function getPdfJamRamai()
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(190, 7, 'Laporan Kasir', 0, 1);
        $pdf->Ln();

        $heading = array(
            'waktu' => 'Waktu',
            'kasir' => 'Kasir',
            'total' => 'Total'
        );

        $result = $this->mc->getLaporanKasir();
        $result2 = $this->mc->getTotalJamRamai();
        $result3 = $this->mc->getRataJamRamai();

        $pdf->Cell(25, 10, 'Tanggal/jam', 1);
        $pdf->Cell(15, 10, '10:00-11:00', 1);
        $pdf->Cell(15, 10, '11:00-12:00', 1);
        $pdf->Cell(15, 10, '12:00-13:00', 1);
        $pdf->Cell(15, 10, '13:00-14:00', 1);
        $pdf->Cell(15, 10, '14:00-15:00', 1);
        $pdf->Cell(15, 10, '15:00-16:00', 1);
        $pdf->Cell(15, 10, '16:00-17:00', 1);
        $pdf->Cell(15, 10, '17:00-18:00', 1);
        $pdf->Cell(15, 10, '18:00-19:00', 1);
        $pdf->Cell(15, 10, '19:00-20:00', 1);
        $pdf->Cell(15, 10, '20:00-21:00', 1);
        $pdf->Ln();
        foreach ($result as $key => $value) {
            $pdf->Cell(15, 10, $value->getWaktu());
            for ($i = 10; $i <= 20; $i++) {
                if (array_key_exists("$i", $value->jam)) {
                    $pdf->Cell(15, 10, $value->jam["$i"]->getTotal());
                } else {
                    $pdf->Cell(15, 10, "-");
                }
            }
            $pdf->Ln();
        }
        $pdf->Cell(15, 10, "Total");
        foreach ($result2 as $key => $value) {
            $pdf->Cell(15, 10, $value);
        }
        $pdf->Ln();
        $pdf->Cell(15, 10, "Rata-rata");
        foreach ($result3 as $key => $value) {
            $pdf->Cell(15, 10, $value);
        }

        ob_end_clean();
        $pdf->Output();
    }
}
