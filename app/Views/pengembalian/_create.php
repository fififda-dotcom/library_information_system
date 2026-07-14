<form action="<?= base_url('create/pengembalian') ?>" method="post" id="pengembalianForm">
    <?= csrf_field() ?>
    <div class="card-body">

        <div class="form-group">
            <label>Daftar Pinjaman</label>
            <select name="id_peminjaman" class="form-control">
                <option value="">Pilih Pinjaman</option>
                <?php foreach ($list_peminjaman as $peminjaman): ?>
                    <option value="<?= $peminjaman['id_peminjaman'] ?>">
                        <?= $peminjaman['name_member'] . ' dengan buku ' . $peminjaman['title_book'] . ' pada tanggal ' . $peminjaman['tgl_pinjam'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" name="tgl_kembali" class="form-control" placeholder="Masukkan tanggal kembali">
        </div>

        <div class="form-group">
            <label>Denda</label>
            <input type="number" name="denda" class="form-control" placeholder="Masukkan denda" value="0">
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
        </div>
    </div>
</form>