<div id="user-data">
    <p>Data User</p>
    <a><button>Add User</button></a>
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