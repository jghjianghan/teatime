<h1 id="laporan-manajerial">Laporan Manajerial</h1>
<form id="form-laporan" method="post" action="manajer/manajer">
    <fieldset id="main-laporan">
        <legend>Pilih jenis laporan</legend>
        <ul>
            <li>
                <select name="select-laporan">
                    <option value="detail-trans-harian">Detail transaksi harian</option>
                    <option value="trans-rentang">Transaksi rentang </option>
                    <option value="uang-masuk">Uang yang masuk</option>
                    <option value="performa-kasir">Performa kasir</option>
                    <option value="jam-ramai">Jam ramai</option>
                </select>
            </li><br>
            <li>
                Pilih tanggal:
                <input type="date" name="tanggal1"> <span class="hide" id='tanggalKedua'>- <input type="date" name="tanggal2"></span>
            </li><br>
            <li>
                <input type="submit" id="submit" value="Lihat Laporan">
            </li><br>
        </ul>
    </fieldset>
</form>