<div id="user-data">
    <p>Data User</p>
    <input class="search" type="text" name="search" id="userSearch" placeholder="Search..." size=10>
    <button id="addUser" class="addBtn"><span>Add User</span></button>
    <table class="adminData" id="userData">
        <tr class="adminData first-row">
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
                    <form method='POST' action=''>
                        <input type='hidden' name='idUser' value = ".$value->getId().">
                        <input type='hidden' name='posisi' value = ".$value->getPosisi().">
                        <input type='hidden' name='email' value = ".$value->getemail().">
                        <input type='hidden' name='nama' value = '".$value->getNama()."'>
                        <input type='hidden' name='ttl' value = '".$value->getTtlRaw()."'>
                        <input type='hidden' name='alamat' value = '".$value->getAlamat()."'>
                        <button type='button' class='editBtn' title='Edit'><i class='fa fa-2x fa-pencil'></i></button>
                        <button type='button' class='resetBtn' title='Reset'><i class='fa fa-2x fa-refresh'></i></button>
                        <button type='button' class='deleteBtn' title='Delete'><i class='fa fa-2x fa-trash'></i></button>
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

<div class="modal" id="modal-addUser">
    <div>
        <span class='close'>&times;</span>
        <h2>Add User</h2>
        <form id="add_User" method="post" action="">
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
                    <td><input type="email" id="email" name="email" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="nama">Nama Lengkap</label></td>
                    <td>:</td>
                    <td><input type="text" id="nama" name="nama" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="ttl">Tanggal Lahir</label></td>
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
                    <td><button id="tambahkan">Tambahkan</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div class="modal" id="modal-pass">
    <div>
        <h2><span id='response-message'></span></h2>
        <span id="response-content"></span>
        <button class="close-ok">Ok</button>
    </div>
</div>

<div class="modal" id="modal-edit">
    <div>
        <span class='close'>&times;</span>
        <h2>Edit User</h2>
        <form id="edit_User" method="post" action="user/edit">
            <table>
                <input type="hidden" name="idUser" value="">
                <input type="hidden" name="posisi" value="">
                <tr>
                    <td><label for="edit-email">Email</label></td>
                    <td>:</td>
                    <td><input type="email" id="edit-email" name="edit-email" value="<?php ?>" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="edit-nama">Nama Lengkap</label></td>
                    <td>:</td>
                    <td><input type="text" id="edit-nama" name="edit-nama" value="" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="edit-ttl">Tanggal Lahir</label></td>
                    <td>:</td>
                    <td><input type="date" id="edit-ttl" name="edit-ttl" value="" required></td>
                </tr>
                <tr>
                    <td><label for="edit-alamat">Alamat</label></td>
                    <td>:</td>
                    <td><textarea id="edit-alamat" rows="4" cols="35" name="edit-alamat" value="" required></textarea></td>
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
        Password baru untuk <span id="namaUser-res"></span>: <span id="res-pass" style='font-weight:bold;'></span><br>
        Berikan passwordnya pada user<br>
        <button class="close-ok">Ok</button>
    </div>
</div>

<div class="modal" id="modal-del">
    <div>
        <span class='close'>&times;</span>
        Apakah anda yakin ingin menghapus akun dengan nama <span id="namaUser-del" style='font-weight:bold;'></span>?<br>
        <form method="post" action="user/delete">
            <input type='hidden' name='idUser' value = "">
            <input type='hidden' name='posisi' value = "">
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