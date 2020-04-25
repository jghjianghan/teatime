<div id="topping-data">
    <p>Data Topping</p>
    <a><button>Add Topping</button></a>
    <table>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php
            $no=1;
            foreach($result as $key => $value){
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".$value->getGambar()."</td>";
                echo "<td>".$value->getNama()."</td>";
                echo "<td>".$value->getHarga()."</td>";
                echo "<td>
                    <form method='POST' action='edit'>
                        <input type='hidden' name='idTopping' value = ".$value->getId().">
                        <input type='submit' value='Edit'>
                    </form>
                    <form method='POST' action='index/delete'>
                        <input type='hidden' name='idTopping' value = ".$value->getId().">
                        <input type='submit' value='Delete'>
                    </form>
                    </td>
                ";
                echo "</tr>";
            }

        ?>
    </table>
</div>