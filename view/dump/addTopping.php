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