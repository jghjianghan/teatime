<h1 id="judul">Laporan Keuangan Rentang <?php echo $_POST['tanggal1']?> - <?php echo $_POST['tanggal2']?></h1>
<table id="table-laporan">
    <tr class='first-row'>
        <th>Tanggal</th>
        <th>Total pendapatan</th>
    </tr>
    <?php
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value->getWaktu(). "</td>";
        echo "<td>Rp. " . $value->getJumlahHarga() . "</td>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td>Total</td>";
    echo "<td>Rp. $result2</td>";
    echo "</tr>";
    ?>
</table>