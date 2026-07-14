<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><?= $title; ?></h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- The Modal -->
<div class="modal" id="formModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="card" id="pengembalianCard">
    <div class="card-header">
        <h3 class="card-title">Riwayat Pengembalian</h3>

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
            <a href="<?= base_url('ajax/create/pengembalian') ?>" class="btn btn-primary btn-sm" id="addBtn" data-toggle="modal" data-target="#formModal">
                <i class="fas fa-plus"></i> Tambah Pengembalian
            </a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped" id="pengembalianTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Member</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data akan di-load lewat AJAX -->
            </tbody>
        </table>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('js') ?>
<script>
    function requestAjax(urlParams, methodParams='GET', dataType='html', successFunction=null, dataParams=null) {
        $.ajax({
            url: urlParams,
            method: methodParams,
            data: dataParams,
            dataType: dataType, //html or json
            success: function(data) {
                if(successFunction != null && typeof successFunction === 'function') successFunction(data);
                else $("#pengembalianTable").html(data);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
            }
        });
    }

    $(document).ready(function() {
        // 1. Load data tabel pengembalian pertama kali
        requestAjax("<?= base_url('list/pengembalian/table'); ?>");

        // 2. Handler tombol Tambah Pengembalian
        $('#pengembalianCard').on('click', '#addBtn', function(e) {
            e.preventDefault();
            const urlParams = $(this).attr('href');
            requestAjax(urlParams, 'GET', 'html', function(response) {
                $('#formModal .modal-title').html('Form Tambah Pengembalian');
                $('#formModal .modal-body').html(response);
                $('#formModal').modal('show');
            });
        });

        // 3. Handler tombol Edit Pengembalian
        $('#pengembalianTable').on('click', '.editBtn', function(e) {
            e.preventDefault();
            const urlParams = $(this).attr('href');
            requestAjax(urlParams, 'GET', 'html', function(response) {
                $('#formModal .modal-title').html('Form Edit Pengembalian');
                $('#formModal .modal-body').html(response);
                $('#formModal').modal('show');
            });
        });

        // 4. Handler Submit Form (Tambah & Edit)
        $(document).on('submit', '#pengembalianForm', function(e) {
            e.preventDefault();

            const form = $(this);
            const actionUrl = form.attr('action');
            const formData = form.serialize();

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#formModal').modal('hide');
                        requestAjax("<?= base_url('list/pengembalian/table'); ?>");
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Submit Error: " + status + ": " + error);
                    alert("Terjadi kesalahan server saat menyimpan data.");
                }
            });
        });

        // 5. Handler tombol Hapus Pengembalian
        $('#pengembalianTable').on('click', '.deleteBtn', function(e) {
            e.preventDefault();

            if (confirm("Apakah Anda yakin ingin menghapus data pengembalian ini?")) {
                const form = $(this).closest('form');
                const actionUrl = form.attr('action');

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            requestAjax("<?= base_url('list/pengembalian/table'); ?>");
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Delete Error: " + status + ": " + error);
                        alert("Terjadi kesalahan server saat menghapus data.");
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>