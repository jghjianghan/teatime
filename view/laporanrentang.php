<h1 id="judul">Laporan Transaksi Rentang <?php echo $_POST['tanggal1']?> - <?php echo $_POST['tanggal2']?></h1>
<table id="table-laporan">
    <tr>
        <th>Tanggal</th>
        <th>Teh</th>
        <th>Topping</th>
    </tr>
    <?php
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value->getWaktu(). "</td>";
        echo "<td>" . $value->getTeh() . "</td>";
        echo "<td>" . $value->getTopping() . "</td>";
        echo "</tr>";
    }
    ?>
</table>