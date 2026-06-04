<form action="<?= base_url('create/book') ?>" method="post" id="bookForm">
    <!-- Form fields will go here -->
        <?= csrf_field() ?>
        <div class="card-body">
        
        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku">
        </div>
        <div class="form-group">
            <label>Kode Buku</label>
            <input type="text" name="kode" class="form-control" placeholder="Masukkan kode buku">
        </div>
        <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control" placeholder="Masukkan ISBN buku">
        </div>
        <div class="form-group">
            <label>Penulis</label>
            <input type="text" name="penulis" class="form-control" placeholder="Masukkan nama penulis">
        </div>
        <div class="form-group">
            <label>Penerbit</label>
            <input type="text" name="penerbit" class="form-control" placeholder="Masukkan nama penerbit">
        </div>
        <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="text" name="tahun_terbit" class="form-control" placeholder="Masukkan tahun terbit">
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" placeholder="Masukkan keterangan buku">
        </div>

        <button type="submit" class="btn btn-primary" id="saveButton">
             Simpan
        </button>
        </div>
        </div>
</form>