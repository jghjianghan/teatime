<div id="tea-data">
    <p>Data Tea</p>
    <a><button>Add Tea</button></a>
    <table>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Harga Regular</th>
            <th>Harga Large</th>
            <th>Aksi</th>
        </tr>
        <?php
            $no=1;
            foreach($result as $key => $value){
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".$value->getGambar()."</td>";
                echo "<td>".$value->getNama()."</td>";
                echo "<td>".$value->getHargaRegular()."</td>";
                echo "<td>".$value->getHargaLarge()."</td>";
                echo "<td>
                    <form method='POST' action='tea/update'>
                        <input type='hidden' name='idTeh' value = ".$value->getId().">
                        <input type='submit' value='Update'>
                    </form>
                    <form method='POST' action='index/delete'>
                        <input type='hidden' name='idTeh' value = ".$value->getId().">
                        <input type='submit' value='Delete'>
                    </form>
                    </td>
                ";
                echo "</tr>";
            }

        ?>
    </table>
</div>