<form action="<?= base_url('create/peminjaman') ?>" method="post" id="peminjamanForm">
    <!-- Form fields will go here -->
    <?= csrf_field() ?>
    <div class="card-body">

        <div class="form-group">
            <label>Daftar Member</label>
            <select name="member_id" class="form-control">
                <option value="">Pilih Member</option>
                <?php foreach ($list_members as $member): ?>
                    <option value="<?= $member['id_member'] ?>"><?= $member['name_member'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Daftar Buku</label>
            <select name="book_id" class="form-control">
                <option value="">Pilih Buku</option>
                <?php foreach ($list_books as $book): ?>
                    <option value="<?= $book['id_book'] ?>"><?= $book['title_book'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Peminjaman</label>
            <input type="date" name="loan_date" class="form-control" placeholder="Masukkan tanggal peminjaman">
        </div>

        <div class="form-group">
            <label>Tanggal Pengembalian</label>
            <input type="date" name="return_date" class="form-control" placeholder="Masukkan tanggal pengembalian">
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
        </div>
    </div>
</form>