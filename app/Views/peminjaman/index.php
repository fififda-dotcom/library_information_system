<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><?= $title ?></h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- BAGIAN 1: Form Cari Anggota -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user mr-2"></i>Cari Anggota
        </h3>
    </div>
    <div class="card-body">
        <div class="row align-items-end">
            <div class="col-md-4">
                <div class="form-group mb-0">
                    <label for="kode_anggota">Kode Anggota</label>
                    <div class="input-group">
                        <input type="text"
                               id="kode_anggota"
                               class="form-control"
                               placeholder="Masukkan kode anggota...">
                        <div class="input-group-append">
                            <button class="btn btn-primary"
                                    id="btn-cari-anggota"
                                    type="button">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area info anggota (awalnya disembunyikan) -->
        <div id="info-anggota" class="mt-3" style="display:none;">
            <hr>
            <div class="row">
                <!-- Kolom kiri -->
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td width="140"><strong>Kode Anggota</strong></td>
                            <td>: <span id="anggota-kode"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>: <span id="anggota-nama"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>: <span id="anggota-email"></span></td>
                        </tr>
                    </table>
                </div>
                <!-- Kolom kanan -->
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td width="140"><strong>Telepon</strong></td>
                            <td>: <span id="anggota-telepon"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>: <span id="anggota-alamat"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Tgl Bergabung</strong></td>
                            <td>: <span id="anggota-join"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Area pesan error (awalnya disembunyikan) -->
        <div id="info-anggota-error"
             class="alert alert-warning mt-3"
             style="display:none;">
            <i class="fas fa-exclamation-triangle mr-1"></i>
            <span id="pesan-error-anggota"></span>
        </div>
    </div>
</div>

<!-- BAGIAN 2: Tabel Daftar Peminjaman Anggota -->
<div class="card" id="card-peminjaman" style="display:none;">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-book mr-2"></i>Buku yang Dipinjam
        </h3>
        <div class="card-tools">
            <!-- Tombol Cetak Struk Peminjaman khusus per Member -->
            <a href="#" id="btn-cetak-struk" target="_blank" class="btn btn-info btn-sm" style="display: none; margin-right: 5px;">
                <i class="fas fa-print"></i> Cetak Struk PJM
            </a>
            <button class="btn btn-success btn-sm"
                    id="btn-tambah-peminjaman"
                    type="button">
                <i class="fas fa-plus"></i> Tambah Peminjaman
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped table-sm mb-0">
            <thead class="thead-light">
                <tr>
                    <th width="50">No</th>
                    <th>Kode Pinjam</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tbody-peminjaman">
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada data peminjaman.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Pop-up: Form Tambah Peminjaman -->
<div class="modal fade" id="modalTambahPeminjaman" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Peminjaman Buku
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Pesan alert di dalam modal (tersembunyi) -->
                <div id="modal-alert" class="alert" style="display:none;"></div>

                <!-- Input tersembunyi menyimpan id_member yang sedang aktif -->
                <input type="hidden" id="hidden-id-member">

                <div class="form-group">
                    <label for="kode_buku">Kode Buku <span class="text-danger">*</span></label>
                    <input type="text" id="kode_buku" class="form-control"
                           placeholder="Masukkan kode buku..." autocomplete="off">
                    <small class="form-text text-muted">
                        Masukkan kode buku yang akan dipinjam.
                    </small>
                </div>

                <div class="form-group">
                    <label for="tanggal_pinjam">
                        Tanggal Pinjam <span class="text-danger">*</span>
                    </label>
                    <input type="date" id="tanggal_pinjam" class="form-control">
                </div>

                <div class="form-group">
                    <label for="durasi_pinjam">
                        Lama Pinjam (hari) <span class="text-danger">*</span>
                    </label>
                    <input type="number" id="durasi_pinjam" class="form-control"
                           value="3" min="1" max="60">
                    <small class="form-text text-muted">
                        Default 3 hari. Tanggal kembali dihitung otomatis.
                    </small>
                </div>

                <div class="form-group mb-0">
                    <label>Perkiraan Tanggal Kembali</label>
                    <!-- readonly: tidak bisa diedit, hanya tampilkan hasil kalkulasi -->
                    <input type="text" id="preview_batas_kembali"
                           class="form-control" readonly
                           style="background:#f4f6f9;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-success" id="btn-simpan-peminjaman">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Pengembalian Buku -->
<div class="modal fade" id="modalKembalikan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-undo-alt mr-2"></i>Konfirmasi Pengembalian Buku
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="kembalikan-id">
                <table class="table table-sm table-borderless mb-3">
                    <tr>
                        <td width="150"><strong>Kode Buku</strong></td>
                        <td>: <span id="kembalikan-kode-buku"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Judul Buku</strong></td>
                        <td>: <span id="kembalikan-judul"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Batas Kembali</strong></td>
                        <td>: <span id="kembalikan-batas"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Tgl Dikembalikan</strong></td>
                        <td>: <span id="kembalikan-tgl-kembali"></span>
                            &nbsp;
                            <span id="kembalikan-info-terlambat" class="font-weight-bold"></span>
                        </td>
                    </tr>
                </table>
                <hr>
                <div class="form-group mb-0">
                    <label for="input_denda"><strong>Denda (Rp)</strong></label>
                    <input type="number" id="input_denda" class="form-control"
                           value="0" min="0" step="500" placeholder="0">
                    <small class="form-text text-muted">
                        Masukkan nominal denda yang dikenakan. Isi 0 jika tidak ada denda.
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info" id="btn-konfirmasi-kembalikan">
                    <i class="fas fa-check mr-1"></i> Konfirmasi Pengembalian
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>

const BASE_URL = '<?= base_url() ?>/';

document.getElementById('btn-cari-anggota')
.addEventListener('click', cariAnggota);

document.getElementById('kode_anggota')
.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        cariAnggota();
    }
});

function cariAnggota() {

    let kode = document.getElementById('kode_anggota').value.trim();

    if (!kode) {
        alert('Masukkan kode anggota');
        return;
    }

    document.getElementById('info-anggota').style.display = 'none';
    document.getElementById('info-anggota-error').style.display = 'none';
    document.getElementById('btn-cetak-struk').style.display = 'none'; // Sembunyikan tombol cetak struk

    fetch(BASE_URL + 'peminjaman/get-anggota', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'kode_anggota=' + encodeURIComponent(kode)
    })
    .then(response => response.json())
    .then(data => {

        console.log(data);

        if (data.success) {

            let member = data.member;

            document.getElementById('anggota-kode').textContent    = member.code_member || '-';
            document.getElementById('anggota-nama').textContent    = member.name_member || '-';
            document.getElementById('anggota-email').textContent   = member.email_member || '-';
            document.getElementById('anggota-telepon').textContent = member.phone_member || '-';
            document.getElementById('anggota-alamat').textContent  = member.address_member || '-';
            document.getElementById('anggota-join').textContent    = member.join_date || '-';

            document.getElementById('info-anggota').style.display = 'block';

            // Menyimpan ID Anggota untuk form tambah pinjam
            document.getElementById('hidden-id-member').value = member.id_member;
            // Menampilkan card tabel peminjaman
            document.getElementById('card-peminjaman').style.display = 'block';
            // Merender daftar peminjaman anggota
            renderTabel(data.peminjaman);

            // Arahkan link tombol cetak ke ID member yang aktif dan tampilkan
            const btnCetak = document.getElementById('btn-cetak-struk');
            btnCetak.href = BASE_URL + 'laporan/cetak-struk/' + member.id_member;
            btnCetak.style.display = 'inline-block';
        } else {

            document.getElementById('pesan-error-anggota').textContent = data.message;
            document.getElementById('info-anggota-error').style.display = 'block';

        }

    })
    .catch(error => {
        console.error(error);

        document.getElementById('pesan-error-anggota').textContent =
            'Terjadi kesalahan saat mengambil data anggota';

        document.getElementById('info-anggota-error').style.display = 'block';
    });

    // Set tanggal hari ini sebagai default di form
document.getElementById('tanggal_pinjam').value = new Date().toISOString().split('T')[0];
updatePreviewBatasKembali();

// Hitung dan tampilkan prakiraan tanggal kembali secara real-time
function updatePreviewBatasKembali() {
    const tanggal = document.getElementById('tanggal_pinjam').value;
    const durasi  = parseInt(document.getElementById('durasi_pinjam').value) || 3;
    if (tanggal) {
        const batas = new Date(tanggal);
        batas.setDate(batas.getDate() + durasi);
        // Format tanggal ke Bahasa Indonesia
        document.getElementById('preview_batas_kembali').value =
            batas.toLocaleDateString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });
    }
}

// Perbarui preview setiap kali tanggal atau durasi berubah
document.getElementById('tanggal_pinjam').addEventListener('change', updatePreviewBatasKembali);
document.getElementById('durasi_pinjam').addEventListener('input', updatePreviewBatasKembali);

// Ketika klik tombol "Tambah Peminjaman", buka modal
document.getElementById('btn-tambah-peminjaman').addEventListener('click', function() {
    document.getElementById('kode_buku').value      = '';
    document.getElementById('tanggal_pinjam').value = new Date().toISOString().split('T')[0];
    document.getElementById('durasi_pinjam').value  = 3;
    document.getElementById('modal-alert').style.display = 'none';
    updatePreviewBatasKembali();
    $('#modalTambahPeminjaman').modal('show'); // Bootstrap 4 modal
});

// Ketika klik tombol "Simpan" di dalam modal
document.getElementById('btn-simpan-peminjaman').addEventListener('click', function() {
    const kode_buku      = document.getElementById('kode_buku').value.trim();
    const tanggal_pinjam = document.getElementById('tanggal_pinjam').value;
    const durasi_pinjam  = document.getElementById('durasi_pinjam').value;
    const id_member      = document.getElementById('hidden-id-member').value;

    // Validasi: semua field wajib harus diisi
    if (!kode_buku || !tanggal_pinjam || !durasi_pinjam) {
        showModalAlert('danger', 'Semua field wajib diisi.');
        return; // hentikan eksekusi, jangan kirim ke server
    }

    // Kirim data ke server
    fetch(BASE_URL + 'peminjaman/store', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ kode_buku, tanggal_pinjam, durasi_pinjam, id_member })
    })
    .then(r => r.json())
    .then(function(res) {
        if (res.success) {
            $('#modalTambahPeminjaman').modal('hide'); // tutup modal
            renderTabel(res.peminjaman);     // perbarui tabel
            showToast('success', res.message);
        } else {
            showModalAlert('danger', res.message);
        }
    });
});

document.getElementById('btn-konfirmasi-kembalikan').addEventListener('click', function() {
    const id    = document.getElementById('kembalikan-id').value;
    const denda = parseInt(document.getElementById('input_denda').value) || 0;
    $('#modalKembalikan').modal('hide');
    kembalikanBuku(id, denda);
});

// Render (gambar ulang) isi tabel peminjaman dari array data
function renderTabel(peminjaman) {
    const tbody = document.getElementById('tbody-peminjaman');

    if (!peminjaman || peminjaman.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted">Belum ada data peminjaman.</td></tr>';
        return;
    }

    let html = '';
    peminjaman.forEach(function(p, i) {
        const badge = p.status === 'dipinjam'
            ? '<span class="badge badge-warning">Dipinjam</span>'
            : '<span class="badge badge-success">Dikembalikan</span>';

        // Tombol kembalikan hanya muncul kalau status masih "dipinjam"
        const aksi = p.status === 'dipinjam'
            ? `<button class="btn btn-xs btn-info btn-kembalikan"
                       data-id="${p.id_peminjaman}"
                       data-code="${p.code_book}"
                       data-judul="${p.title_book}"
                       data-batas="${p.batas_kembali}">
                   <i class="fas fa-undo-alt"></i> Kembalikan
               </button>`
            : '-';

        const denda = parseInt(p.denda) || 0;
        let dendaCell;

        if (p.status === 'dipinjam') {
            dendaCell = '<span class="text-muted">-</span>';
        } else if (denda > 0) {
            dendaCell = `<span class="text-danger font-weight-bold">Rp ${denda.toLocaleString('id-ID')}</span>`;
        } else {
            dendaCell = '<span class="text-success">Rp 0</span>';
        }

        html += `<tr>
            <td>${i + 1}</td>
            <td>${p.kode_peminjaman}</td>
            <td>${p.code_book}</td>
            <td>${p.title_book}</td>
            <td>${badge}</td>
            <td>${dendaCell}</td>
            <td>${aksi}</td>
        </tr>`;
    });

    tbody.innerHTML = html;

    // Pasang event listener pada setiap tombol "Kembalikan" yang baru dibuat
    document.querySelectorAll('.btn-kembalikan').forEach(btn => {
        btn.addEventListener('click', function() {
            const batasKembali = this.dataset.batas;
            const today        = new Date().toISOString().split('T')[0];

            // Isi data ke dalam modal
            document.getElementById('kembalikan-id').value               = this.dataset.id;
            document.getElementById('kembalikan-kode-buku').textContent  = this.dataset.code;
            document.getElementById('kembalikan-judul').textContent      = this.dataset.judul;
            document.getElementById('kembalikan-batas').textContent      = batasKembali;
            document.getElementById('kembalikan-tgl-kembali').textContent = today;
            document.getElementById('input_denda').value                 = 0;

            // Hitung keterlambatan untuk info petugas (bukan untuk menentukan denda)
            const diffHari = Math.floor((new Date(today) - new Date(batasKembali)) / 86400000);
            const infoEl   = document.getElementById('kembalikan-info-terlambat');
            if (diffHari > 0) {
                infoEl.textContent = `(Terlambat ${diffHari} hari)`;
                infoEl.className   = 'font-weight-bold text-danger';
            } else {
                infoEl.textContent = '(Tepat waktu)';
                infoEl.className   = 'font-weight-bold text-success';
            }

            $('#modalKembalikan').modal('show');
        });
    });
}

function kembalikanBuku(id_peminjaman, denda) {
    fetch(BASE_URL + 'peminjaman/kembalikan/' + id_peminjaman, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'denda=' + encodeURIComponent(denda)
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            renderTabel(res.peminjaman);
            showToast('success', res.message);
        } else {
            alert(res.message);
        }
    });
}

// Tampilkan pesan alert di dalam modal
function showModalAlert(type, pesan) {
    const el = document.getElementById('modal-alert');
    el.className      = 'alert alert-' + type;
    el.textContent    = pesan;
    el.style.display  = 'block';
}

// Tampilkan notifikasi pop-up kecil di pojok kanan atas
function showToast(type, pesan) {
    const warna = type === 'success' ? '#28a745' : '#dc3545';
    const div   = document.createElement('div');
    div.style.cssText = `
        position: fixed; top: 20px; right: 20px; z-index: 9999;
        background: ${warna}; color: #fff;
        padding: 12px 20px; border-radius: 6px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2); font-size: 14px;
    `;
    div.innerHTML = `<i class="fas fa-check-circle mr-2"></i>${pesan}`;
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 3000); // hilangkan setelah 3 detik
}
}

</script>
<?= $this->endSection() ?>