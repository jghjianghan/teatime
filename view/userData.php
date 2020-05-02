<div id="user-data">
    <p>Data User</p>
    <button id="addUser">Add User</button><br><br>
    <table class="adminData">
        <tr class="adminData">
            <th class="adminData">No</th>
            <th class="adminData">Posisi</th>
            <th class="adminData">Email</th>
            <th class="adminData">Nama Lengkap</th>
            <th class="adminData">Tanggal lahir</th>
            <th class="adminData">Alamat</th>
            <th class="adminData">Aksi</th>
        </tr>
        <?php
            $no=1;
            foreach($result as $key => $value){
                echo "<tr class='adminData'>";
                echo "<td class='adminData'>".$no++."</td>";
                echo "<td class='adminData'>".$value->getPosisi()."</td>";
                echo "<td class='adminData'>".$value->getEmail()."</td>";
                echo "<td class='adminData'>".$value->getNama()."</td>";
                echo "<td class='adminData'>".$value->getTtl()."</td>";
                echo "<td class='adminData'>".$value->getAlamat()."</td>";
                echo "<td class='adminData'>
                    <form method='POST' action='edit'>
                        <input type='hidden' name='emailUser' value = ".$value->getEmail().">
                        <input type='submit' value='Edit'>
                    </form>    
                    <form method='POST' action='reset'>
                        <input type='hidden' name='emailUser' value = ".$value->getEmail().">
                        <input type='submit' value='Reset'>
                    </form>
                    <form method='POST' action='index/delete'>
                        <input type='hidden' name='emailUser' value = ".$value->getEmail().">
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

<div class="modal" id="modal-addUser">
    <div>
        <span class='close'>&times;</span>
        <h2>Add User</h2>
        <form method="post" action="user/add">
            <table>
                <tr>
                    <td>Posisi</td>
                    <td>:</td>
                    <td>
                        <input type="radio" id="admin" name="posisi" value="admin">
                        <label for="admin">Admin</label>
                        <input type="radio" id="manager" name="posisi" value="manager">
                        <label for="manager">Manager</label>
                        <input type="radio" id="kasir" name="posisi" value="kasir">
                        <label for="kasir">Kasir</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td>:</td>
                    <td><input type="text" id="email" name="email" required></td>
                </tr>
                <tr>
                    <td><label for="nama">Nama Lengkap</label></td>
                    <td>:</td>
                    <td><input type="text" id="nama" name="nama" required></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td><input type="date" id="ttl" name="ttl" required></td>
                </tr>
                <tr>
                    <td><label for="alamat">Alamat</label></td>
                    <td>:</td>
                    <td><textarea id="alamat" rows="4" cols="35" name="alamat" required></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="Tambahkan"></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div class="modal" id="modal-pass">
    <div>
        <h2><span id='response-message'></span></h2>
        Password Untuk <span id="namaUser"></span>: <span id="pass"></span><br>
        Berikan passwordnya pada user<br>
        <button class="close-ok">Ok</button>
    </div>
</div>

<div class="modal" id="modal-edit">
    <div>
        <span class='close'>&times;</span>
        <h2>Edit User</h2>
        <form id="edit_User" method="post" action="user/edit">
            <table>
                <tr>
                    <td>Posisi</td>
                    <td>:</td>
                    <td>
                        <input type="radio" id="edit-admin" name="posisi" value="admin">
                        <label for="edit-admin">Admin</label>
                        <input type="radio" id="edit-manager" name="posisi" value="manager">
                        <label for="edit-manager">Manager</label>
                        <input type="radio" id="edit-kasir" name="posisi" value="kasir">
                        <label for="edit-kasir">Kasir</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="edit-email">Email</label></td>
                    <td>:</td>
                    <td><input type="text" id="edit-email" name="email" value="" required></td>
                </tr>
                <tr>
                    <td><label for="edit-nama">Nama Lengkap</label></td>
                    <td>:</td>
                    <td><input type="text" id="edit-nama" name="nama" value="" required></td>
                </tr>
                <tr>
                    <td><label for="edit-ttl">Tanggal Lahir</label></td>
                    <td>:</td>
                    <td><input type="date" id="edit-ttl" name="ttl" value="" required></td>
                </tr>
                <tr>
                    <td><label for="edit-alamat">Alamat</label></td>
                    <td>:</td>
                    <td><textarea id="edit-alamat" rows="4" cols="35" name="alamat" value="" required></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" id="edit" value="Ubah"></input></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div class="modal" id="modal-res">
    <div>
        <h2><span id='response-message'></span></h2>
        Password Baru Untuk <span id="namaUser-res"></span>: <span id="res-pass"></span><br>
        Berikan passwordnya pada user<br>
        <button class="close-ok">Ok</button>
    </div>
</div>

<div class="modal" id="modal-del">
    <div>
        <span class='close'>&times;</span>
        Apakah anda yakin ingin menghapus akun dengan nama <span id="namaUser-del"></span>?<br>
        <form method="post" action="user/delete">
            <input type='hidden' name='idUser' value = "">
            <input type='hidden' name='posisi' value = "">
            <input type="submit" value="Ok">
        </form>
    </div>
</div>