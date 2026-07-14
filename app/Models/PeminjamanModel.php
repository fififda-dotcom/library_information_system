<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table      = 'peminjaman';       // nama tabel di database
    protected $primaryKey = 'id_peminjaman';    // kolom kunci utama

    // Daftar kolom yang boleh disimpan/diupdate
    // PENTING: kolom yang tidak ada di sini tidak akan tersimpan
    protected $allowedFields = [
        'kode_peminjaman',
        'id_member',
        'id_book',
        'tanggal_pinjam',
        'batas_kembali',
        'tanggal_dikembalikan',
        'durasi_pinjam',
        'status',
        'denda',
    ];

    protected $useTimestamps = true; // aktifkan created_at dan updated_at otomatis

    // Ambil semua peminjaman milik satu anggota (JOIN dengan tabel books)
    public function getByMember(int $idMember): array
{
    return $this->db->table('peminjaman')
        ->select('peminjaman.*, books.code_book, books.title_book, books.author_book')
        ->join('books', 'books.id_book = peminjaman.id_book', 'left')
        ->where('peminjaman.id_member', $idMember)
        ->orderBy('peminjaman.id_peminjaman', 'DESC')
        ->get()
        ->getResultArray();
}

// Buat kode peminjaman unik berurutan per hari
// Contoh hasil: PJM202606170001, PJM202606170002, dst.
public function generateCode()
{
    $prefix = 'PJM' . date('Ymd');  // contoh: PJM20260617

    // Cari kode terakhir dengan awalan hari ini
    $last = $this->db->table('peminjaman')
        ->like('kode_peminjaman', $prefix, 'after')
        ->orderBy('id_peminjaman', 'DESC')
        ->limit(1)
        ->get()
        ->getRowArray();

    $seq = 1;
    if ($last) {
        // Ambil 4 digit terakhir kode lalu tambah 1
        $seq = (int) substr($last['kode_peminjaman'], -4) + 1;
    }

    // str_pad: pastikan 4 digit, tambah nol di depan jika perlu
    // Contoh: 1 → "0001", 12 → "0012"
    return $prefix . str_pad($seq, 4, '0', STR_PAD_LEFT);
}

// Simpan data peminjaman baru
public function store()
{
    // 1. Ambil semua data dari form
    $kode_buku      = $this->request->getPost('kode_buku');
    $id_member      = $this->request->getPost('id_member');
    $tanggal_pinjam = $this->request->getPost('tanggal_pinjam');
    $durasi_pinjam  = (int) $this->request->getPost('durasi_pinjam') ?: 3;

    // 2. Cek apakah buku ada di database
    $bookModel = new BookModel();
    $book      = $bookModel->where('code_book', $kode_buku)->first();
    if (!$book) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Buku tidak ditemukan.'
        ]);
    }

    // 3. Cek apakah buku sedang dipinjam (status 'dipinjam').
    //    Jika statusnya sudah 'dikembalikan', buku BOLEH dipinjam lagi
    //    oleh siapa saja — termasuk anggota yang sama.
    $peminjamanModel = new PeminjamanModel();
    $sedangDipinjam  = $peminjamanModel
        ->where('id_book', $book['id_book'])
        ->where('status', 'dipinjam')
        ->first();

    if ($sedangDipinjam) {
        // Bedakan pesan: apakah peminjam aktif adalah anggota yang sama?
        $pesanBlokir = ($sedangDipinjam['id_member'] == $id_member)
            ? 'Buku ini masih Anda pinjam dan belum dikembalikan.'
            : 'Buku sedang dipinjam oleh anggota lain.';

        return $this->response->setJSON([
            'success' => false,
            'message' => $pesanBlokir
        ]);
    }

    // 4. Hitung tanggal batas kembali (tanggal pinjam + durasi hari)
    $batas_kembali = date('Y-m-d', strtotime($tanggal_pinjam . ' +' . $durasi_pinjam . ' days'));

    // 5. Simpan ke database
    $isSaved = $peminjamanModel->save([
        'kode_peminjaman' => $peminjamanModel->generateCode(),
        'id_member'       => $id_member,
        'id_book'         => $book['id_book'],
        'tanggal_pinjam'  => $tanggal_pinjam,
        'batas_kembali'   => $batas_kembali,
        'durasi_pinjam'   => $durasi_pinjam,
        'status'          => 'dipinjam',
    ]);

    if ($isSaved) {
        // Ambil data terbaru untuk diperbarui di tabel
        $peminjaman = $peminjamanModel->getByMember($id_member);
        return $this->response->setJSON([
            'success'    => true,
            'message'    => 'Peminjaman berhasil disimpan.',
            'peminjaman' => $peminjaman
        ]);
    }

    return $this->response->setJSON([
        'success' => false,
        'message' => 'Gagal menyimpan peminjaman.'
    ]);
}

}