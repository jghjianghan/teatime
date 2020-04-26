<h1 id="judul">Laporan Transaksi Harian <?php echo $_POST['tanggal']?></h1>
<table id="table-laporan">
    <tr>
        <th>Waktu</th>
        <th>Nama Kasir</th>
        <th>Nama Pemesan</th>
        <th>Pesanan</th>
        <th>Harga Total Pesanan</th>
    </tr>
    <?php
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $value->getGambar() . "</td>";
        echo "<td>" . $value->getNama() . "</td>";
        echo "<td>" . $value->getHargaRegular() . "</td>";
        echo "<td>" . $value->getHargaLarge() . "</td>";
        echo "</tr>";
    }

    ?>
</table>