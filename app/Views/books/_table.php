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
        
<thead>
    <tr>
        <th width="50">No.</th>
        <th>Judul Buku</th>
        <th>Kode Buku</th>
        <th>ISBN</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Tahun Terbit</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </tr>
</thead>

<tbody>
    <?php $no=0; ?>
    <?php foreach($books as $book): ?>
        <?php $no++; ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $book['title_book'] ?></td>
            <td><?php echo $book['code_book'] ?></td>
            <td><?php echo $book['isbn_book'] ?></td>
            <td><?php echo $book['author_book'] ?></td>
            <td><?php echo $book['publisher_book'] ?></td>
            <td><?php echo $book['published_year'] ?></td>
            <td><?php echo $book['description_book'] ?></td>

            <td>
                <a href="<?= base_url('edit/book/' . $book['id_book']) ?>"
                   class="btn btn-info btn-sm">Edit</a>

                <form action="<?= base_url('delete/book/' . $book['id_book']) ?>"
                      method="post"
                      style="display: inline;">

                    <button type="submit"
                            class="btn btn-danger btn-sm deleteBtn"
                            >
                        Hapus
                    </button>

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>