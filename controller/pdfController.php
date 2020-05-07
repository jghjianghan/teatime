<?php
require("library/fpdf/fpdf.php");
require("controller/manajerController.php");

class pdfController
{
    $test = new ManajerController();

    public function getPdfHarian()
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(190, 7, 'Laporan Harian', 0, 1);
        $pdf->Ln();

        $result = $test->getLaporanHarian();

        $heading = array(
            'kode' => 'Kode',
            'waktu' => 'Waktu',
            'namakasir' => 'Nama Kasir',
            'namapemesan' => 'Nama Pemesan',
            'pesanan' => 'Pesanan',
            'hargatotal' => 'Harga total'
        );
        $header = 

        foreach ($header as $item) {
            $pdf->Cell(45, 10, $heading[$item['Field']], 1);
        }

        $rsl  = 

        foreach ($rsl as $row) {
            $pdf->Ln();
            foreach ($row as $column)
                $pdf->Cell(45, 10, $column, 1);
        }
        $pdf->Output();
    }
}