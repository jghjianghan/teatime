<h1 id="judul">Laporan Jam Ramai <?php $tgl = date_create($_POST['tanggal1']);
                                    $tgl = date_format($tgl, 'd-m-Y');
                                    echo $tgl; ?> - <?php $tgl2 = date_create($_POST['tanggal2']);
                                                    $tgl2 = date_format($tgl2, 'd-m-Y');
                                                    echo $tgl2; ?></h1>

<form method="post" action="manajer/pdfjamramai">
    <input type="hidden" name="tanggal1" value='<?php echo $_POST['tanggal1']; ?>'>
    <input type="hidden" name="tanggal2" value='<?php echo $_POST['tanggal2']; ?>'>
    <button type="submit">Export to PDF</button>
</form><br>

<table id="table-laporan">
    <tr class='first-row'>
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
        echo "<td>$value</td>";
    }
    echo "</tr>";
    echo "<tr>";
    echo "<td>Rata-rata</td>";
    foreach ($result3 as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
    ?>
</table><br>
<h2>Grafik Rata-Rata Transaksi Per Jam <?php echo $_POST['tanggal1'] ?> - <?php echo $_POST['tanggal2'] ?></h2>
<canvas id="line-chart" style="min-width: 600px; height: 400px"></canvas>

<script>
    let meanData = JSON.parse('<?php echo json_encode($result3); ?>');
</script>