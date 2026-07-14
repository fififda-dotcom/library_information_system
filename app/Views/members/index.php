<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><?= $title ?></h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- The Modal -->
<div class="modal" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Form Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <!-- Form akan dimuat secara dinamis lewat AJAX -->
      </div>
    </div>
  </div>
</div>

<div class="card" id="MemberCard">
    <div class="card-header">
        <h3 class="card-title">Data Member</h3>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card-tools">
            <button class="btn btn-primary btn-sm" id="addBtn">
                <i class="fas fa-plus"></i> Tambah Member
            </button>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped" id="memberTable">
            <!-- Data tabel akan diisi lewat AJAX -->
        </table>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
function requestAjax(urlParams, methodParams='GET', dataType='html', dataParams=null, successFunction=null) {
    $.ajax({
        url: urlParams,
        method: methodParams,
        data: dataParams,
        dataType: dataType,
        success: function(data) {
            if (successFunction !== null && typeof successFunction === 'function') {
                successFunction(data);
            } else if (dataType === 'html') {
                $('#memberTable').html(data);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + " : " + error);
            alert("Terjadi kesalahan saat memuat data.");
        }
    });
}

$(document).ready(function() {
    // Load data tabel saat halaman siap
    requestAjax("<?= base_url('list/members/table'); ?>");

    // Handler untuk tombol delete
    $('#memberTable').on('click', '.deleteBtn', function(e) {
        e.preventDefault();
        const isConfirmed = confirm('Apakah Anda yakin ingin menghapus data member ini?');
        if (isConfirmed) {
            const urlParams = $(this).closest('form').attr('action');
            requestAjax(urlParams, 'POST', 'json', null, function(response){
                if (response.code == 200) {
                    alert('Berhasil hapus data');
                    requestAjax("<?= base_url('list/members/table'); ?>");
                } else {
                    alert('Gagal hapus data: ' + response.message);
                }
            });
        }
    });

    // Handler untuk tombol Tambah Member
    $('#addBtn').on('click', function(e) {
        e.preventDefault();
        const urlParams = "<?= base_url('ajax/create/member') ?>";

        requestAjax(urlParams, 'GET', 'html', null, function(response) {
            $('#formModal .modal-title').text('Form Tambah Member');
            $('#formModal .modal-body').html(response);
            $('#formModal').modal('show');
        });
    });

    // Handler tombol simpan di modal
    $('#formModal').on('click', '#saveButton', function(e) {
        e.preventDefault();
        const urlParams = "<?= base_url('create/member') ?>";
        const formData = $('#memberForm').serialize();

        requestAjax(urlParams, 'POST', 'json', formData, function(response) {
            alert(response.message);
            if (response.code == 200) {
                $('#formModal').modal('hide');
                requestAjax("<?= base_url('list/members/table'); ?>");
            }
        });
    });
});
</script>
<?= $this->endSection() ?>