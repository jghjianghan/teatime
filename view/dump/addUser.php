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