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
                        <input type='button' value='Edit'>
                    </form>    
                    <form method='POST' action='reset'>
                        <input type='hidden' name='emailUser' value = ".$value->getEmail().">
                        <input type='button' value='Reset'>
                    </form>
                    <form method='POST' action='index/delete'>
                        <input type='hidden' name='emailUser' value = ".$value->getEmail().">
                        <input type='button' value='Delete'>
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
        <form id="add_User" method="post" action="user/add">
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
                    <td><button id="tambahkan">Tambahkan</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div class="modal" id="modal-pass">
    <div>
        <h2>Success!</h2>
        Password Untuk <span id="namaUser"></span>: <span id="pass"></span><br>
        Berikan passwordnya pada user<br>
        <button id="ok-btn">Ok</button>
    </div>
</div>