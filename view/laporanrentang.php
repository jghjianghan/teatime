<h1 id="judul">Laporan Transaksi Rentang <?php $tgl = date_create($_POST['tanggal1']);
                                            $tgl = date_format($tgl, 'd-m-Y');
                                            echo $tgl; ?> - <?php $tgl2 = date_create($_POST['tanggal2']);
                                                            $tgl2 = date_format($tgl2, 'd-m-Y');
                                                            echo $tgl2; ?></h1>

<form method="post" action="manajer/pdfrentang" target='_blank'>
    <input type="hidden" name="tanggal1" value='<?php echo $_POST['tanggal1']; ?>'>
    <input type="hidden" name="tanggal2" value='<?php echo $_POST['tanggal2']; ?>'>
    <button type="submit" class="addBtn"><span>Export to PDF</span></button>
</form><br>

<table id="table-laporan">
    <tr class='first-row'>
        <th>Tanggal</th>
        <th>Teh</th>
        <th>Topping</th>
    </tr>
    <?php
    $tgl = date_create($_POST['tanggal1']);
    foreach ($result as $key => $value) {
        echo "<tr>";
        if($value->getWaktu()){
            echo "<td>" . $value->getWaktu() . "</td>";
        }else{
            
        }        
        echo "<td>";
        foreach ($value->teh as $key => $value2) {
            echo $value2->getJumlahTeh();
            echo " ";
            echo $value2->getNamaTeh();
            echo "<br>";
        }
        echo "</td>";
        echo "<td>";
        $exist = false;
        foreach ($value->topping as $key => $value2) {
            if ($value2->getJumlahTopping() && $value2->getNamaTopping()) {
                $exist = true;
                echo $value2->getJumlahTopping();
                echo " ";
                echo $value2->getNamaTopping();
                echo "<br>";
            }
        }
        if (!$exist){
            echo "-<br>";
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