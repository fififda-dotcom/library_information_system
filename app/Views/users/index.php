<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Daftar Pengguna</h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Pengguna</h3>

        <div class="card-tools"><a href="<?= base_url('create/book')?>" class="btn btn-primary btn-sm"></a><i class="fas fa-plus"></i> Tambah Buku</div>
    </div>
</div>
<?= $this->endsection() ?>