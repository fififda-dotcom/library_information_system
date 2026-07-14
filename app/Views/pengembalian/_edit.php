<form action="<?= base_url('update/pengembalian') ?>" method="post" id="peditPngembalianForm">
    <!-- Form fields will go here -->
    <?= csrf_field() ?>
    <div class="card-body">

        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="form-group">
            <label>Daftar Pinjaman</label>
            <select name="id_peminjaman" class="form-control">
                <option value="">Pilih Pinjaman</option>
                <?php foreach ($list_peminjaman as $peminjaman): ?>
                    <option value="<?= $peminjaman['id_peminjaman'] ?>" <?php if(isset($detail_pengembalian['id_peminjaman']) && $detail_pengembalian['id_peminjaman'] == $peminjaman['id_peminjaman']) echo 'selected'; ?>><?= $peminjaman['name_member'] . ' dengan buku ' . $peminjaman['title_book'] . ' pada tanggal ' . $peminjaman['tgl_pinjam'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" name="tgl_kembali" class="form-control" placeholder="Masukkan tanggal kembali" value="<?= isset($detail_pengembalian) ? $detail_pengembalian['tgl_kembali'] : '' ?>">
        </div>
        <div class="form-group">
            <label>Denda</label>
            <input type="number" name="denda" class="form-control" placeholder="Masukkan denda" value="<?= isset($detail_pengembalian) ? $detail_pengembalian['denda'] : '' ?>">
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
        </div>
    </div>
</form>