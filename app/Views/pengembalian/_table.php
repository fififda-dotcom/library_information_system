<thead>
    <tr>
        <th width="50">No.</th>
        <th>Nama Member</th>
        <th>Judul Buku</th>
        <th>Tanggal Peminjaman</th>
        <th>Tanggal Harus Kembali</th> <!-- Kolom Baru -->
        <th>Tanggal Dikembalikan</th> <!-- Diubah namanya -->
        <th>Denda</th>
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
            <td><?php echo $item['title_book'] ?></td>
            <td><?php echo $item['tgl_pinjam'] ?></td>
            <td><?php echo $item['tgl_harus_kembali'] ?></td> <!-- Data Kolom Baru -->
            <td><?php echo $item['tgl_pengembalian'] ?></td>
            <td><?php echo $item['denda'] ?></td>
            <td>
                <a href="<?= base_url('ajax/edit/pengembalian/' . $item['id_pengembalian']) ?>" class="btn btn-info btn-sm editBtn">Edit</a>
                <form action="<?= base_url('delete/pengembalian/' . $item['id_pengembalian']) ?>" method="post" style="display: inline;">
                    <button type="submit" class="btn btn-danger btn-sm deleteBtn">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>