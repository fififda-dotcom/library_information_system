<thead>
    <tr>
        <th width="50">No.</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Tanggal Bergabung</th>
        <th width="150">Aksi</th>
    </tr>
</thead>
<tbody>
    <?php $no = 0; ?>
    <?php foreach ($members as $member): ?>
        <?php $no++; ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= esc($member['code_member']) ?></td>
            <td><?= esc($member['name_member']) ?></td>
            <td><?= esc($member['email_member']) ?></td>
            <td><?= esc($member['phone_member']) ?></td>
            <td><?= esc($member['address_member']) ?></td>
            <td><?= esc($member['join_date']) ?></td>
            <td>
                <a href="<?= base_url('edit/member/' . $member['id_member']) ?>" class="btn btn-info btn-sm">Edit</a>
                <form action="<?= base_url('delete/member/' . $member['id_member']) ?>" method="post" style="display:inline;">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger btn-sm deleteBtn">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
