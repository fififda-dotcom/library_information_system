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
        <h3 class="card-title">Data Peminjaman Buku</h3>
        <div class="card-tools">
            <a href="<?= base_url('/laporan/cetak-peminjaman') ?>" target="_blank" class="btn btn-danger btn-sm">
                <i class="fas fa-file-pdf"></i> Cetak PDF
            </a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table id="tabelLaporanPeminjaman" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="50">No.</th>
                    <th>Kode Pinjam</th>
                    <th>Nama Member</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Status</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; ?>
                <?php foreach($peminjaman as $p): ?>
                    <?php $no++; ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= esc($p['kode_peminjaman']) ?></td>
                        <td><?= esc($p['name_member']) ?></td>
                        <td><?= esc($p['title_book'] ?? $p['judul_buku']) ?></td>
                        <td><?= esc($p['tanggal_pinjam']) ?></td>
                        <td><?= esc($p['batas_kembali']) ?></td>
                        <td>
                            <?php if ($p['status'] === 'dipinjam'): ?>
                                <span class="badge badge-warning">Dipinjam</span>
                            <?php else: ?>
                                <span class="badge badge-success">Dikembalikan</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('laporan/cetak-struk/' . $p['id_member']) ?>" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-print"></i> Struk PJM
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<link rel="stylesheet" href="<?= base_url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">

<script src="<?= base_url('adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

<script>
    $(document).ready(function () {
        $('#tabelLaporanPeminjaman').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data",
                "zeroRecords": "Data tidak ditemukan",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>