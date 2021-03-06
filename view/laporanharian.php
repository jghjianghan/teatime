<h1 id="judul">Laporan Transaksi Harian <?php $tgl = date_create($_POST['tanggal1']);
                                        $tgl = date_format($tgl, 'd-m-Y');
                                        echo $tgl;
                                        ?></h1>

<form method="post" action="manajer/pdfharian" target='_blank'>
    <input type="hidden" name="tanggal1" value='<?php echo $_POST['tanggal1']; ?>'>
    <button type="submit" class="addBtn"><span>Export to PDF</span></button>
</form><br>

<form id="form" method="post" style="padding: 10px 0;">
    <input type="hidden" name="select-laporan" value="detail-trans-harian">
    <input type="hidden" name="tanggal1" value='<?php echo $_POST['tanggal1']; ?>'>
    <input type="hidden" name="page" value='<?php echo $_POST['page']; ?>'>
    Show: <select name="select-show" data-show='<?php echo $show; ?>'>
        <option value="2">2</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="30">30</option>
        <option value="50">50</option>
        <option value="<?php echo $show * $pageCount;?>">All</option>
    </select>
</form>

<table id="table-laporan">
    <tr class='first-row'>
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

<form method="POST" action="" id='pagination'>
    <?php
    for ($i = 0; $i / $show < $pageCount; $i += $show) {
        echo "<input type='submit' name='page' value='" . ($i / $show + 1) . "'>";
    }
    ?>
    <input type="hidden" name="select-laporan" value="detail-trans-harian">
    <input type="hidden" name="select-show" value="<?php echo $show;?>">
    <input type="hidden" name="tanggal1" value='<?php echo $_POST['tanggal1']; ?>'>
</form>