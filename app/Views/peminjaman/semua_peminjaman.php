<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><?= $title ?></h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-2"></i>Semua Data Peminjaman
        </h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped table-sm mb-0">
            <thead class="thead-light">
                <tr>
                    <th width="50">No.</th>
                    <th>Nama Member</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Harus Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($peminjaman)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 0; ?>
                    <?php foreach ($peminjaman as $p): ?>
                        <?php $no++; ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= esc($p['name_member']) ?></td>
                            <td><?= esc($p['title_book'] ?? $p['judul_buku']) ?></td>
                            <td><?= esc($p['tanggal_peminjaman'] ?? $p['tanggal_pinjam']) ?></td>
                            <td><?= esc($p['tanggal_harus_kembali'] ?? $p['batas_kembali']) ?></td>
                            <td>
                                <?php if ($p['status'] === 'dipinjam'): ?>
                                    <span class="badge badge-warning">Dipinjam</span>
                                <?php else: ?>
                                    <span class="badge badge-success">Dikembalikan</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($p['status'] === 'dipinjam'): ?>
                                    <span class="text-muted">-</span>
                                <?php elseif ((int)$p['denda'] > 0): ?>
                                    <span class="text-danger font-weight-bold">
                                        Rp <?= number_format((int)$p['denda'], 0, ',', '.') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-success">Rp 0</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('ajax/edit/transaction/' . $p['id_peminjaman']) ?>" class="btn btn-info btn-sm editBtn">Edit</a>
                                <form action="<?= base_url('delete/transaction/' . $p['id_peminjaman']) ?>" method="post" style="display: inline;">
                                    <button type="submit" class="btn btn-danger btn-sm deleteBtn" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
