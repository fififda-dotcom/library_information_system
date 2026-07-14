<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\MemberModel;
use App\Models\BookModel;

class PeminjamanController extends BaseController
{
    // Tampilkan halaman utama peminjaman
    public function index(): string
    {
        $data['title'] = 'Peminjaman Buku';
        return view('peminjaman/index', $data);
    }

    // AJAX: Cari anggota berdasarkan kode yang dikirim dari form
    public function getAnggota()
    {
        // 1. Ambil kode yang dikirim dari form (method POST)
        $kode = $this->request->getPost('kode_anggota');

        // 2. Gunakan MemberModel untuk mencari di tabel 'members'
        $memberModel = new MemberModel();
        $member      = $memberModel->where('code_member', $kode)->first();

        // 3. Kalau tidak ketemu, kirim respons gagal
        if (!$member) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Anggota tidak ditemukan.'
            ]);
        }

        // 4. Kalau ketemu, kirim data anggota dalam format JSON
        $peminjamanModel = new PeminjamanModel();
        $peminjaman      = $peminjamanModel->getByMember($member['id_member']);

        return $this->response->setJSON([
            'success'    => true,
            'member'     => $member,
            'peminjaman' => $peminjaman,
        ]);
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

// Proses pengembalian buku
public function kembalikan($id_peminjaman)
{
    $peminjamanModel = new PeminjamanModel();
    $data            = $peminjamanModel->find($id_peminjaman);

    if (!$data) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Data peminjaman tidak ditemukan.'
        ]);
    }

    // Denda diinput langsung oleh petugas saat proses pengembalian
    $denda          = (int) $this->request->getPost('denda');
    $tanggalKembali = date('Y-m-d');

    // Hitung keterlambatan hanya untuk keperluan pesan informasi
    $hariTerlambat = (int) floor(
        (strtotime($tanggalKembali) - strtotime($data['batas_kembali'])) / 86400
    );

    $isUpdated = $peminjamanModel->update($id_peminjaman, [
        'status'               => 'dikembalikan',
        'tanggal_dikembalikan' => $tanggalKembali,
        'denda'                => $denda,
    ]);

    if ($isUpdated) {
        $peminjaman = $peminjamanModel->getByMember($data['id_member']);

        $message = $denda > 0
            ? "Buku berhasil dikembalikan. Denda Rp "
              . number_format($denda, 0, ',', '.')
              . ($hariTerlambat > 0 ? " (terlambat {$hariTerlambat} hari)." : '.')
            : 'Buku berhasil dikembalikan' . ($hariTerlambat <= 0 ? ' tepat waktu.' : '.');

        return $this->response->setJSON([
            'success'    => true,
            'message'    => $message,
            'denda'      => $denda,
            'peminjaman' => $peminjaman,
        ]);
    }

    return $this->response->setJSON([
        'success' => false,
        'message' => 'Gagal memproses pengembalian.'
    ]);
}

// Tampilkan semua data peminjaman
public function semua(): string
{
    $peminjamanModel = new PeminjamanModel();
    $data['peminjaman'] = $peminjamanModel->select('peminjaman.*, members.name_member, books.title_book')
        ->join('members', 'members.id_member = peminjaman.id_member', 'left')
        ->join('books', 'books.id_book = peminjaman.id_book', 'left')
        ->orderBy('peminjaman.id_peminjaman', 'DESC')
        ->findAll();
    $data['title'] = 'Daftar Semua Peminjaman';

    return view('peminjaman/semua_peminjaman', $data);
}
}