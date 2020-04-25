<form method='post' action="">
    Nama :<input type="text" value="<?php echo $nama; ?>" required><br>
    Harga Regular :<input type="number" value="<?php echo $hargaRegular; ?>" required><br>
    Harga Large : <input type="number" value="<?php echo $hargaLarge; ?>" required><br>
    <input type="hidden" name="idTeh" value = <?php echo $idTeh; ?>>
    <input type="submit" value="Update">
</form>