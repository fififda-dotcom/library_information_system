<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><?= $title ?></h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Edit Member</h3>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('update/member') ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="form-group">
                <label>Kode Member</label>
                <input type="text" name="kode" class="form-control" value="<?= $detail_member['code_member'] ?>">
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="<?= $detail_member['name_member'] ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $detail_member['email_member'] ?>">
            </div>
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="telepon" class="form-control" value="<?= $detail_member['phone_member'] ?>">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"><?= $detail_member['address_member'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Tanggal Bergabung</label>
                <input type="date" name="tanggal_bergabung" class="form-control" value="<?= $detail_member['join_date'] ?>">
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"
                    onclick="return confirm('Yakin akan mengupdate data ini?')">Update</button>
                <a href="<?= base_url('list/members') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>