<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><?php echo $title; ?></h1>
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

<div class="card" id="BookCard">
    <div class="card-header">
        <h3 class="card-title">Data Buku</h3>

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
            <a href="<?= base_url('create/book') ?>" class="btn btn-primary btn-sm" id="addBtn" data-toggle="modal" data-target="#formModal">
                <i class="fas fa-plus"></i> Tambah Buku
            </a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped" id="bookTable">
        </table>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('js') ?>
<script>
function requestAjax(urlParams, methodParams='GET', dataType='html', dataParams=null, successFunction=null) {
    $.ajax({
        url: urlParams,
        method: methodParams,
        data: dataParams,
        dataType: dataType,
        success: function(data) {
            if(successFunction !== null && typeof successFunction === 'function') {
                successFunction(data);
            } 
            else if(dataType === 'html') {
                $('#bookTable').html(data);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + " : " + error);
        }
    });
}

$(document).ready(function() {
    requestAjax("<?= base_url('list/books/table'); ?>");

    $('#bookTable').on('click', '.deleteBtn', function(e) {
        e.preventDefault();
        const isConfirmed = confirm('Apakah user yakin akan menghapus data ini?');
        if(isConfirmed === true) {
            const urlParams = $(this).closest('form').attr('action');
            requestAjax(urlParams, 'POST', 'json', null, function(response){
                if(response.code == 200) {
                    alert('berhasil hapus data');
                    requestAjax("<?= base_url('list/books/table'); ?>");
                }
            });
        }
    });

    $(document).on('click', '#addBtn', function(e) {
    e.preventDefault();
    const urlParams = "<?= base_url('ajax/create/book') ?>";

    requestAjax(urlParams, 'GET', 'html', null, function(response) {
        $('#formModal .modal-title').html('Form Tambah Buku');
        $('#formModal .modal-body').html(response);
        $('#formModal').modal('show');
     });
    });

    $('#formModal').on('click', '#saveButton', function(e) {
    e.preventDefault();
    const urlParams = "<?= base_url('create/book') ?>";
    const formData = $('#bookForm').serialize();
    console.log(formData);
    requestAjax(urlParams, 'POST', 'json', function(response) {
        console.log(response);
        alert(response.message);
    }); formData
});
});
</script>
<?= $this->endsection() ?>