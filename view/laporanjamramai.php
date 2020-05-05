<h1 id="judul">Laporan Jam Ramai <?php echo $_POST['tanggal1'] ?> - <?php echo $_POST['tanggal2'] ?></h1>
<table id="table-laporan">
    <tr>
        <th>Tanggal/Jam</th>
        <th>10:00-11:00</th>
        <th>11:00-12:00</th>
        <th>12:00-13:00</th>
        <th>13:00-14:00</th>
        <th>14:00-15:00</th>
        <th>15:00-16:00</th>
        <th>16:00-17:00</th>
        <th>17:00-18:00</th>
        <th>18:00-19:00</th>
        <th>19:00-20:00</th>
        <th>20:00-21:00</th>
    </tr>
    <?php
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value->getWaktu() . "</td>";
        for ($i = 10; $i <= 20; $i++) {
            if (array_key_exists("$i", $value->jam)) {
                echo "<td>";
                echo $value->jam["$i"]->getTotal();
                echo "</td>";
            } else {
                echo "<td>-</td>";
            }
        }
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td>Total</td>";
    foreach ($result2 as $key => $value) {
        for ($i = 10; $i <= 20; $i++) {
            if (array_key_exists("$i", $value)) {
                echo "<td>";
                echo $value["$i"];
                echo "</td>";
            } else {
                echo "<td>-</td>";
            }
        }
    }
    echo "</tr>";
    ?>
</table>