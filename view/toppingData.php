<div id="topping-data">
    <p>Data Topping</p>
    <button id="addTopping">Add Topping</button>
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
                        <input type='submit' value='Update'>
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

<div class="modal" id="modal-addTopping">
    <div>
        <span class='close'>&times;</span>
        <h2>Add Topping</h2>
        <form method="post" action="topping/add">
            <table>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td>:</td>
                    <td><input type="text" id="nama" name="nama" required></td>
                </tr>
                <tr>
                    <td><label for="harga">Harga</label></td>
                    <td>:</td>
                    <td>Rp.<input type="number" id="harga" name="harga" required></td>
                </tr>
                <tr>
                    <td><label for="foto">Foto</label></td>
                    <td>:</td>
                    <td><input type="file" id="foto" name="foto"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="Tambah"></td>
                </tr>
            </table>
        </form>
    </div>
</div>