<div id="tea-data">
    <p>Data Tea</p>
    <a href="add-tea"><button>Add Tea</button></a>
    <table class="adminData">
        <tr>
            <th class='adminData'>No</th>
            <th class='adminData'>Foto</th>
            <th class='adminData'>Nama</th>
            <th class='adminData'>Harga Regular</th>
            <th class='adminData'>Harga Large</th>
            <th class='adminData'>Aksi</th>
        </tr>
        <?php
            $no=1;
            foreach($result as $key => $value){
                echo "<tr class='adminData'>";
                echo "<td class='adminData'>".$no++."</td>";
                echo "<td class='adminData'>".$value->getGambar()."</td>";
                echo "<td class='adminData'>".$value->getNama()."</td>";
                echo "<td class='adminData'>".$value->getHargaRegular()."</td>";
                echo "<td class='adminData'>".$value->getHargaLarge()."</td>";
                echo "<td class='adminData'>
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
<div class="home-button">
    <form method="POST" action="admin">
        <input type="submit" value="Home">
    </form>
</div>