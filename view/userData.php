<div id="user-data">
    <p>Data User</p>
    <a><button>Add User</button></a>
    <table>
        <tr>
            <th>No</th>
            <th>Posisi</th>
            <th>Email</th>
            <th>Nama Lengkap</th>
            <th>Tanggal lahir</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php
            $no=1;
            foreach($result as $key => $value){
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".$value->getPosisi()."</td>";
                echo "<td>".$value->getEmail()."</td>";
                echo "<td>".$value->getNama()."</td>";
                echo "<td>".$value->getTtl()."</td>";
                echo "<td>".$value->getAlamat()."</td>";
                echo "<td>
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