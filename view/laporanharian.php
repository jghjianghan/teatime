<h1 id="judul">Laporan Transaksi Harian <?php echo $_POST['tanggal1'];?></h1>
<table id="table-laporan">
    <tr>
        <th>Kode</th>
        <th>Waktu</th>
        <th>Nama Kasir</th>
        <th>Nama Pemesan</th>
        <th>Pesanan</th>
        <th>Harga Total Pesanan</th>
    </tr>
    <?php
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value->getKode(). "</td>";
        echo "<td>" . $value->getWaktu() . "</td>";
        echo "<td>" . $value->getNamaKasir() . "</td>";
        echo "<td>" . $value->getNamaPemesan() . "</td>";
        echo "<td>" . $value->getPesanan() . "</td>";
        echo "<td>" . $value->getTotalHarga() . "</td>";
        echo "</tr>";
    }
    ?>
</table>