<h1 id="judul">Laporan Transaksi Harian <?php echo $_POST['tanggal1'];?></h1>
<table id="table-laporan">
    <tr>
        <th>Waktu</th>
        <th>Nama Kasir</th>
        <th>Nama Pemesan</th>
        <th>Pesanan</th>
        <th>Harga Total Pesanan</th>
    </tr>
    <?php
    // foreach ($result as $key => $value) {
    //     echo "<tr>";
    //     echo "<td>" . $value->getWaktu(). "</td>";
    //     echo "<td>" . $value->getEmail() . "</td>";
    //     echo "<td>" . $value->getNamaPemesan() . "</td>";
    //     echo "<td>" . $value->getPesanan() . "</td>";
    //     echo "<td>" . $value->getHargaTotal() . "</td>";
    //     echo "</tr>";
    // }
    ?>
</table>