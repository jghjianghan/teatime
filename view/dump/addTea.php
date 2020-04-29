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