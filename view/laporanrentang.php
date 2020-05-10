<h1 id="judul">Laporan Transaksi Rentang <?php echo $_POST['tanggal1'] ?> - <?php echo $_POST['tanggal2'] ?></h1>
<table id="table-laporan">
    <tr class='first-row'>
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
            if ($value2->getJumlahTopping() && $value2->getNamaTopping()) {
                echo $value2->getJumlahTopping();
                echo " ";
                echo $value2->getNamaTopping();
                echo "<br>";
            }
            else{
                echo "-<br>";
            }
        }
        echo "<br>";
        echo "</td>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td>Total</td>";
    echo "<td>";
    foreach ($result2 as $key => $value) {
        echo "$value $key<br>";
    }
    echo "</td>";
    echo "<td>";
    foreach ($result3 as $key => $value) {
        if ($value !== 0) {
            echo "$value $key<br>";
        }
    }
    echo "</td>";
    echo "</tr>";
    ?>
</table>

<form method="post" action="manajer/pdfrentang">
    <input type="hidden" name="tanggal1" value='<?php echo $_POST['tanggal1']; ?>'>
    <input type="hidden" name="tanggal2" value='<?php echo $_POST['tanggal2']; ?>'>
    <button type="submit" value="Export to PDF">
</form>