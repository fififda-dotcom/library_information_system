<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            width: 76mm; /* Standar lebar kertas struk termal */
            margin: 0 auto;
            padding: 10px;
            color: #000;
        }
        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }
        .header h3 { margin: 0; font-size: 13px; }
        .header p { margin: 2px 0; font-size: 10px; }
        .info { margin-bottom: 8px; border-bottom: 1px dashed #000; padding-bottom: 8px; }
        .info table { width: 100%; }
        .info td { font-size: 10px; padding: 1px 0; }
        table.items {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 1px dashed #000;
            margin-bottom: 8px;
        }
        table.items th {
            text-align: left;
            border-bottom: 1px dashed #000;
            padding: 4px 0;
            font-size: 10px;
        }
        table.items td { padding: 5px 0; font-size: 10px; line-height: 1.2; }
        .footer { text-align: center; font-size: 9px; margin-top: 10px; }
        .tombol-aksi { text-align: center; margin-bottom: 15px; }
        .tombol-aksi button {
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 4px 10px;
            font-size: 11px;
            border-radius: 3px;
            cursor: pointer;
            margin: 0 3px;
        }
        .tombol-aksi button.btn-print { background-color: #dc3545; }
        @media print {
            .tombol-aksi { display: none; }
            body { width: 100%; padding: 0; }
        }
    </style>
</head>
<body>

    <div class="tombol-aksi">
        <button class="btn-print" onclick="window.print()">Cetak</button>
        <button onclick="window.close()">Tutup</button>
    </div>

    <div class="header">
        <h3>PERPUSTAKAAN JAYA</h3>
        <p>Library Information System</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="70">Kode Member</td>
                <td>: <?= esc($member['code_member']) ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: <?= esc($member['name_member']) ?></td>
            </tr>
            <tr>
                <td>Waktu Cetak</td>
                <td>: <?= date('d/m/Y H:i') ?> WIB</td>
            </tr>
        </table>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Buku / Kode</th>
                <th width="80" style="text-align: right;">Batas Kembali</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peminjaman as $p): ?>
                <tr>
                    <td>
                        <strong><?= esc($p['title_book']) ?></strong><br>
                        (<?= esc($p['code_book']) ?>) - <?= esc(ucfirst($p['status'])) ?>
                    </td>
                    <td valign="top" style="text-align: right;">
                        <?= date('d/m/Y', strtotime($p['batas_kembali'])) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Harap kembalikan buku tepat waktu.<br>Terima kasih atas kunjungan Anda!</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>