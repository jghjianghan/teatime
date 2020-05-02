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
                    <form method='POST' action=''>
                        <input type='hidden' name='idTopping' value = ".$value->getId().">
                        <input type='hidden' name='namaTopping' value = ".$value->getNama().">
                        <input type='hidden' name='gambarTopping' value = ".$value->getGambar().">
                        <input type='hidden' name='hargaTopping' value = ".$value->getHarga().">
                        <input type='button' class='updateToppingBtn' value='Update'>
                        <input type='button' class='deleteToppingBtn' value='Delete'>
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

<div class="modal" id="modal-updateTopping">
    <div>
        <span class='close'>&times;</span>
        <h2>Update Topping</h2>
        <form method="post" action="topping/update">
            <table>
                <tr>
                    <td><label for="namaBaru">Nama</label></td>
                    <td>:</td>
                    <td><input type="text" id="namaBaru" name="nama" required></td>
                </tr>
                <tr>
                    <td><label for="hargaBaru">Harga</label></td>
                    <td>:</td>
                    <td>Rp.<input type="number" id="hargaBaru" name="harga" required></td>
                </tr>
                <tr>
                    <td>Foto Lama</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td><label for="fotoBaru">Foto</label></td>
                    <td>:</td>
                    <td><input type="file" id="fotoBaru" name="foto"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="Ubah"></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div class="modal" id="modal-delTopping">
    <div>
        <span class='close'>&times;</span>
        Apakah anda yakin ingin menghapus topping <span id="namaTopping-del"></span>?<br>
        <form method="post" action="topping/delete">
            <input type="hidden" name="idTopping" value="">
            <input type="submit" value="Ok">
        </form>
    </div>
</div>