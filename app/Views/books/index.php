<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><?php echo $title; ?></h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card" id="Bookcard">
    <div class="card-header">
        <h3 class="card-title">Data Buku</h3>

        <div class="card-tools">
            <a href="<?= base_url('create/book') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Buku
            </a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped" id="bookTable">
            ...
        </table>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('js') ?>
<script>
    // FIX 1: Menggunakan nama parameter 'successCallback' agar sinkron dengan bagian dalam fungsi
    function requestAjax(urlParams, methodParams='GET', dataTypeParams='html', dataParams=null, successCallback=null) {
        $.ajax({
            url: urlParams,
            method: methodParams,
            data: dataParams,
            dataType: dataTypeParams,
            success: function(data) {
                console.log(data);
                // FIX 2: Struktur IF-ELSE dipasang dengan rapi, variabel sinkron, tidak typo
                if (successCallback !== null && typeof successCallback === 'function') {
                    successCallback(data);
                } else {
                    $("#bookTable").html(data);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + " : " + error);
            }
        });
    }

    $(document).ready(function() {
        // Panggil tabel pertama kali saat halaman siap
        requestAjax('<?= base_url('list/books/table'); ?>');

        $('#bookTable').on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            const isConfirmed = confirm('Apakah user yakin akan menghapus data ini?');
            
            if (isConfirmed === true) {
                const urlParams = $(this).closest('form').attr('action');
                requestAjax(urlParams, 'POST', 'json');
            }
        }); 
    }); 
</script>
<?= $this->endsection() ?>