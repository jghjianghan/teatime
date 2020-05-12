<div id="tea-data">
    <p>Data Tea</p>
    <input class="search" type="text" name="search" id="teaSearch" placeholder="Search..." size=10>
    <button class="clear-btn" id="clear-teaSearch"><i class="fa fa-times"></i></button>
    <button id="addTea" class="addBtn"><span>Add Tea</span></button>
    <table class="adminData" id="teaData">
        <tr class='first-row'>
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
                echo "<td class='adminData'><img src=".$upPrefix."/asset/img/tea/".$value->getGambar()."></td>";
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
                        <button type='button' class='updateTeaBtn' title='Edit'><i class='fa fa-2x fa-pencil'></i></button>
                        <button type='button' class='deleteTeaBtn' title='Delete'><i class='fa fa-2x fa-trash'></i></button>
                    </form>
                    </td>
                ";
                echo "</tr>";
            }

        ?>
    </table>
</div>

<!-- <div class="home-button">
    <form method="POST" action="admin">
        <input type="submit" value="Home">
    </form>
</div> -->

<div class="modal" id="modal-addTea">
    <div>
        <span class='close'>&times;</span>
        <h2>Add Tea</h2>
        <form method="post" action="tea/add" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td>:</td>
                    <td><input type="text" id="nama" name="nama" required autocomplete="off"></td>
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
        <form method="post" action="tea/update" enctype="multipart/form-data">
            <table>
                <input type="hidden" name="idTeh" value="">
                <tr>
                    <td><label for="namaBaru">Nama</label></td>
                    <td>:</td>
                    <td><input type="text" id="namaBaru" name="update-nama" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="regBaru">Harga Regular</label></td>
                    <td>:</td>
                    <td>Rp.<input type="number" id="regBaru" name="update-reg" required></td>
                </tr>
                <tr>
                    <td><label for="largeBaru">Harga Large</label></td>
                    <td>:</td>
                    <td>Rp.<input type="number" id="largeBaru" name="update-large" required></td>
                </tr>
                <tr>
                    <td>Foto Lama</td>
                    <td>:</td>
                    <td><img src=""></td>
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
        Apakah anda yakin ingin menghapus teh <span id="namaTeh-del" style="font-weight: bold;"></span>?<br>
        <form method="post" action="tea/delete">
            <input type="hidden" name="idTeh" value="">
            <input type="submit" value="Ok">
        </form>
    </div>
</div>

<div class="modal" id="response-modal">
    <div>
        <h2></h2>
        <span></span><br>
        <button class="close-ok">Ok</button>
    </div>
</div>