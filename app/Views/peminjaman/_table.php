<thead>
    <tr>
        <th width="50">No.</th>
        <th>Nama Member</th>
        <th>Judul Buku</th>
        <th>Tanggal Peminjaman</th>
        <th>Tanggal Harus Kembali</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    <?php $no=0; ?>
    <?php foreach($peminjaman as $item): ?>
        <?php $no++; ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $item['name_member'] ?></td>
            <td><?php echo $item['judul_buku'] ?></td>
            <td><?php echo $item['tanggal_peminjaman'] ?></td>
            <td><?php echo $item['tanggal_harus_kembali'] ?></td>
            <td>
                <a href="<?= base_url('ajax/edit/transaction/' . $item['id_peminjaman']) ?>" class="btn btn-info btn-sm editBtn">Edit</a>
                <form action="<?= base_url('delete/transaction/' . $item['id_peminjaman']) ?>" method="post" style="display: inline;">
                    <button type="submit" class="btn btn-danger btn-sm deleteBtn">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>