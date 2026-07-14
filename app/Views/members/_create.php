<form action="<?= base_url('create/member') ?>" method="post" id="memberForm">
    <?= csrf_field() ?>
    <div class="card-body">
        <div class="form-group">
            <label>Kode Member</label>
            <input type="text" name="kode" class="form-control" placeholder="Masukkan kode member">
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email">
        </div>
        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" name="telepon" class="form-control" placeholder="Masukkan no. telepon">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" placeholder="Masukkan alamat"></textarea>
        </div>
        <div class="form-group">
            <label>Tanggal Bergabung</label>
            <input type="date" name="tanggal_bergabung" class="form-control" value="<?= date('Y-m-d') ?>">
        </div>

        <button type="submit" class="btn btn-primary" id="saveButton">
             Simpan
        </button>
    </div>
</form>
