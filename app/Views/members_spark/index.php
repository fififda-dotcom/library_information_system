<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><?php echo $title; ?></h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Member Spark</h3>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="card-tools">
            <a href="<?= base_url('create/member-spark') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Member Spark
            </a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="50">No.</th>
                    <th>Kode</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Tanggal Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; ?>
                <?php foreach($members_spark as $member): ?>
                    <?php $no++; ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $member['code_member'] ?></td>
                        <td><?php echo $member['name_member'] ?></td>
                        <td><?php echo $member['email_member'] ?></td>
                        <td><?php echo $member['phone_member'] ?></td>
                        <td><?php echo $member['address_member'] ?></td>
                        <td><?php echo $member['join_date'] ?></td>
                        <td>
                            <a href="<?= base_url('edit/member-spark/' . $member['id_member']) ?>" class="btn btn-info btn-sm">Edit</a>
                            <form action="<?= base_url('delete/member-spark/' . $member['id_member']) ?>" method="post" style="display: inline;">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus Member Spark ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>