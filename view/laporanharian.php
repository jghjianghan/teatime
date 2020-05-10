<h1 id="judul">Laporan Transaksi Harian <?php echo $_POST['tanggal1']; ?></h1>
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
        echo "<td>" . $value->getKode() . "</td>";
        echo "<td>" . $value->getWaktu() . "</td>";
        echo "<td>" . $value->getNamaKasir() . "</td>";
        echo "<td>" . $value->getNamaPemesan() . "</td>";
        echo "<td>";
        foreach ($value->pesanan as $key2 => $value2) {
            echo $value2->getJumlahPesanan();
            echo " ";
            echo $value2->getNamaTeh();
            echo "<br>";
            foreach ($value2->topping as $key2 => $value3) {
                if ($value3->getJumlahTopping() && $value3->getNamaTopping()) {
                    echo $value3->getJumlahTopping();
                    echo " ";
                    echo $value3->getNamaTopping();
                    echo "<br>";
                }
            }
            echo $value2->getJumlahEs();
            echo " ice<br>";
            echo $value2->getJumlahGula();
            echo " sugar<br>";
            echo $value2->getUkuranGelas();
            echo "<br><br>";
        };
        echo "</td>";
        echo "<td>Rp. " . $value->getTotalHarga() . "</td>";
        echo "</tr>";
    };
    echo "<tr>";
    echo "<td> </td>";
    echo "<td> </td>";
    echo "<td> </td>";
    echo "<td>Total</td>";
    echo "<td>";
    foreach ($result2 as $key => $value) {
        if ($value !== 0) {
            echo "$value $key<br>";
        }
    }
    echo "</td>";
    echo "<td>Rp. $result3</td>";
    echo "</tr>";
    ?>
</table>

<form method="post" action="manajer/pdfharian">
    <input type="hidden" name="tanggal1" value='<?php echo $_POST['tanggal1']; ?>'>
    <button type="submit">Export to PDF</button>
</form>
