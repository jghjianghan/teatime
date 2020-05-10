<h1 id="judul">Laporan Performa Kasir <?php echo $_POST['tanggal1']?> - <?php echo $_POST['tanggal2']?></h1>
<table id="table-laporan">
    <tr>
        <th>Tanggal</th>
        <th>Kasir</th>
        <th>Total</th>
    </tr>
    <?php
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value->getWaktu(). "</td>";
        echo "<td>" . $value->getNamaKasir() . "</td>";
        echo "<td>" . $value->getJumlahHarga() . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<form method="post" action="manajer/pdfkasir">
    <input type="hidden" name="tanggal1" value='<?php echo $_POST['tanggal1']; ?>'>
    <input type="hidden" name="tanggal2" value='<?php echo $_POST['tanggal2']; ?>'>
    <button type="submit">Export to PDF</button>
</form>