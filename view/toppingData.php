<div id="topping-data">
    <p>Data Topping</p>
    <a href="add-topping"><button>Add Topping</button></a>
    <table class="adminData">
        <tr>
            <th class='adminData'>No</th>
            <th class='adminData'>Foto</th>
            <th class='adminData'>Nama</th>
            <th class='adminData'>Harga</th>
            <th class='adminData'>Aksi</th>
        </tr>
        <?php
            $no=1;
            foreach($result as $key => $value){
                echo "<tr class='adminData'>";
                echo "<td class='adminData'>".$no++."</td>";
                echo "<td class='adminData'>".$value->getGambar()."</td>";
                echo "<td class='adminData'>".$value->getNama()."</td>";
                echo "<td class='adminData'>".$value->getHarga()."</td>";
                echo "<td class='adminData'>
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
<div class="home-button">
    <form method="POST" action="admin">
        <input type="submit" value="Home">
    </form>
</div>