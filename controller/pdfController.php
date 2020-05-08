<?php
require("library/fpdf/fpdf.php");
require_once "controller/manajerController.php";

class pdfController
{
    public function __construct()
    {
        $this->mc = new ManajerController();
    }


    public function getPdfHarian()
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

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
        // $header = 

        // foreach ($header as $item) {
        //     $pdf->Cell(45, 10, $heading[$item['Field']], 1);
        // }

        $result = $this->mc->getLaporanHarian();


        foreach ($result as $key => $value) {
            $pdf->Cell(45, 10, $value->getKode(), 1);
            $pdf->Cell(45, 10, $value->getWaktu(), 1);
            $pdf->Cell(45, 10, $value->getNamaKasir(), 1);
            $pdf->Cell(45, 10, $value->getPemesan(), 1);
            foreach ($value->pesanan as $key2 => $value2) {
                $pdf->Write(45, 10, $value2->getJumlahPesanan(), 1);
                $pdf->Write(45, 10, $value2->getNamaTeh(), 1);
                foreach ($value2->topping as $key2 => $value3) {
                    if ($value3->getJumlahTopping() && $value3->getNamaTopping()) {
                        $pdf->Cell(45, 10, $value3->getJumlahTopping(), 1);
                        $pdf->Ln();
                        $pdf->Cell(45, 10, $value3->getNamaTopping(), 1);
                        $pdf->Ln();
                    }
                }
            }
            $pdf->Cell(45, 10, $value->getJumlahEs(), 1);
            $pdf->Ln();
        }
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

        foreach ($result as $key => $value) {
            $pdf->Cell(45, 10, $value->getWaktu(), 1);
            $pdf->Cell(45, 10, $value->getJumlahHarga(), 1);
            $pdf->Ln();
        }
        ob_end_clean();
        $pdf->Output();
    }
}
