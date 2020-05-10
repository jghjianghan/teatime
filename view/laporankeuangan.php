<h1 id="judul">Laporan Keuangan Rentang <?php $tgl = date_create($_POST['tanggal1']);
                                        $tgl = date_format($tgl, 'd-m-Y');
                                        echo $tgl; ?> - <?php $tgl2 = date_create($_POST['tanggal2']);
                                                        $tgl2 = date_format($tgl2, 'd-m-Y');
                                                        echo $tgl2; ?></h1>

<form method="post" action="manajer/pdfkeuangan">
    <input type="hidden" name="tanggal1" value='<?php echo $_POST['tanggal1']; ?>'>
    <input type="hidden" name="tanggal2" value='<?php echo $_POST['tanggal2']; ?>'>
    <button type="submit">Export to PDF</button>
</form><br>

<table id="table-laporan">
    <tr class='first-row'>
        <th>Tanggal</th>
        <th>Total pendapatan</th>
    </tr>
    <?php
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value->getWaktu() . "</td>";
        echo "<td>Rp. " . $value->getJumlahHarga() . "</td>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td>Total</td>";
    echo "<td>Rp. $result2</td>";
    echo "</tr>";
    ?>
</table>