<div id="tea-data">
    <p>Data Tea</p>
    <button id="addTea">Add Tea</button>
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
                    <form method='POST' action=''>
                        <input type='hidden' name='idTeh' value = ".$value->getId().">
                        <input type='hidden' name='namaTeh' value = '".$value->getNama()."'>
                        <input type='hidden' name='gambarTeh' value = '".$value->getGambar()."'>
                        <input type='hidden' name='regular' value = '".$value->getHargaRegular()."'>
                        <input type='hidden' name='large' value = '".$value->getHargaLarge()."'>
                        <input type='button' class='updateTeaBtn' value='Update'>
                        <input type='button' class='deleteTeaBtn' value='Delete'>
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

<div class="modal" id="modal-addTea">
    <div>
        <span class='close'>&times;</span>
        <h2>Add Tea</h2>
        <form method="post" action="tea/add">
            <table>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td>:</td>
                    <td><input type="text" id="nama" name="nama" required></td>
                </tr>
                <tr>
                    <td><label for="reg">Harga Regular</label></td>
                    <td>:</td>
                    <td>Rp.<input type="number" id="reg" name="reg" required></td>
                </tr>
                <tr>
                    <td><label for="large">Harga Large</label></td>
                    <td>:</td>
                    <td>Rp.<input type="number" id="large" name="large"></td>
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

<div class="modal" id="modal-updateTea">
    <div>
        <span class='close'>&times;</span>
        <h2>Update Tea</h2>
        <form method="post" action="tea/update">
            <table>
                <tr>
                    <td><label for="namaBaru">Nama</label></td>
                    <td>:</td>
                    <td><input type="text" id="namaBaru" name="nama" required></td>
                </tr>
                <tr>
                    <td><label for="regBaru">Harga Regular</label></td>
                    <td>:</td>
                    <td>Rp.<input type="number" id="regBaru" name="reg" required></td>
                </tr>
                <tr>
                    <td><label for="largeBaru">Harga Large</label></td>
                    <td>:</td>
                    <td>Rp.<input type="number" id="largeBaru" name="large"></td>
                </tr>
                <tr>
                    <td>Foto Lama</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td><label for="fotoBaru">Foto Baru</label></td>
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

<div class="modal" id="modal-delTea">
    <div>
        <span class='close'>&times;</span>
        Apakah anda yakin ingin menghapus teh <span id="namaTeh-del"></span>?<br>
        <form method="post" action="tea/delete">
            <input type="hidden" name="idTeh" value="">
            <input type="submit" value="Ok">
        </form>
    </div>
</div>
