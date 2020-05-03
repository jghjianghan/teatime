<h1 id="judul">Laporan Transaksi Rentang <?php echo $_POST['tanggal1'] ?> - <?php echo $_POST['tanggal2'] ?></h1>
<table id="table-laporan">
    <tr>
        <th>Tanggal</th>
        <th>Teh</th>
        <th>Topping</th>
    </tr>
    <?php
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value->getWaktu() . "</td>";
        echo "<td>";
        foreach ($value->teh as $key => $value2) {
            echo $value2->getJumlahTeh();
            echo " ";
            echo $value2->getNamaTeh();
            echo "<br>";
        }
        echo "</td>";
        echo "<td>";
        foreach ($value->topping as $key => $value2) {
            echo $value2->getJumlahTopping();
            echo " ";
            echo $value2->getNamaTopping();
            echo "<br>";
        }
        echo "<br>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>