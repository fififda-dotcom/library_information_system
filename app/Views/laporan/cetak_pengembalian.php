<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }

        .header-laporan {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header-laporan h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header-laporan p {
            margin: 4px 0 0 0;
            font-size: 12px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background-color: #343a40;
            color: #fff;
            padding: 8px;
            text-align: left;
            border: 1px solid #999;
            font-size: 11px;
        }

        table td {
            padding: 6px 8px;
            border: 1px solid #ccc;
            font-size: 11px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tombol-cetak {
            text-align: right;
            margin-bottom: 15px;
        }

        .tombol-cetak button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 20px;
            font-size: 13px;
            border-radius: 4px;
            cursor: pointer;
        }

        .tombol-cetak button {
            margin: 0 5px;
        }

        .tombol-cetak button:hover {
            background-color: #c82333;
        }

        .tombol-cetak button.btn-kembali {
            background-color: #6c757d;
        }

        .tombol-cetak button.btn-kembali:hover {
            background-color: #5a6268;
        }

        @media print {
            .tombol-cetak {
                display: none;
            }

            body {
                margin: 10px;
            }

            table th {
                background-color: #343a40 !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    <!-- Tombol Cetak -->
    <div class="tombol-cetak">
        <button onclick="window.print()">Cetak / Simpan PDF</button>
        <button class="btn-kembali" onclick="window.close()">&#10006; Tutup</button>
    </div>

    <!-- HEADER -->
    <div class="header-laporan">
        <h2>Laporan Data Pengembalian Buku</h2>
        <p>Library Information System</p>
        <p>Dicetak pada: <?= date('d F Y, H:i') ?> WIB</p>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pinjam</th>
                <th>Nama Member</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Dikembalikan</th>
                <th>Denda</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 0; ?>
            <?php foreach($pengembalian as $p): ?>
                <?php $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= esc($p['kode_peminjaman']) ?></td>
                    <td><?= esc($p['name_member']) ?></td>
                    <td><?= esc($p['title_book'] ?? $p['judul_buku']) ?></td>
                    <td><?= esc($p['tanggal_pinjam']) ?></td>
                    <td><?= esc($p['tanggal_dikembalikan']) ?></td>
                    <td>
                        <?php if ((int)$p['denda'] > 0): ?>
                            Rp <?= number_format((int)$p['denda'], 0, ',', '.') ?>
                        <?php else: ?>
                            Rp 0
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>

</body>
</html>
