<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;

class PengembalianController extends BaseController
{
    // Halaman utama
    public function index()
    {
        $data['title'] = 'Daftar Pengembalian Buku';
        return view('pengembalian/index', $data);
    }

    // Mengambil data tabel via AJAX
        public function ajaxTable()
    {
        $pengembalianModel = new PengembalianModel();

        // Ditambahkan peminjaman.tanggal_harus_kembali AS tgl_harus_kembali ke select
        $data['peminjaman'] = $pengembalianModel->select('
                pengembalian.*, 
                members.name_member, 
                books.title_book, 
                peminjaman.tanggal_peminjaman AS tgl_pinjam, 
                peminjaman.tanggal_harus_kembali AS tgl_harus_kembali, 
                pengembalian.tgl_kembali AS tgl_pengembalian
            ')
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman', 'left')
            ->join('members', 'members.id_member = peminjaman.id_member', 'left')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->findAll();

        return view('pengembalian/_table', $data);
    }

    // Memuat form tambah via AJAX (Hanya menampilkan yang statusnya 'Dipinjam')
    public function ajaxCreate()
    {
        $peminjamanModel = new PeminjamanModel();
        
        $data['list_peminjaman'] = $peminjamanModel->select('
                peminjaman.id_peminjaman, 
                members.name_member, 
                books.title_book, 
                peminjaman.tanggal_peminjaman AS tgl_pinjam
            ')
            ->join('members', 'members.id_member = peminjaman.id_member', 'left')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->where('status', 'Dipinjam')
            ->findAll();

        return view('pengembalian/_create', $data);
    }

    // Menyimpan data pengembalian & update status peminjaman (JSON Response)
    public function store()
    {
        $id_peminjaman = $this->request->getPost('id_peminjaman');
        $tgl_kembali   = $this->request->getPost('tgl_kembali');
        $denda         = $this->request->getPost('denda') ?? 0;

        $pengembalianModel = new PengembalianModel();
        $peminjamanModel   = new PeminjamanModel();

        // Menggunakan Database Transaction agar kedua tabel sinkron
        $db = \Config\Database::connect();
        $db->transStart();

        // 1. Simpan ke tabel pengembalian
        $pengembalianModel->save([
            'id_peminjaman' => $id_peminjaman,
            'tgl_kembali'   => $tgl_kembali,
            'denda'         => $denda
        ]);

        // 2. Update status peminjaman terpilih menjadi 'Dikembalikan'
        $peminjamanModel->update($id_peminjaman, [
            'status' => 'Dikembalikan'
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setJSON([
                'status'  => 'error',
                'code'    => 500,
                'message' => 'Gagal memproses pengembalian buku.'
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Buku berhasil dikembalikan!'
        ]);
    }

    // Memuat form edit via AJAX
    public function ajaxEdit($id)
    {
        $pengembalianModel = new PengembalianModel();
        $data['detail_pengembalian'] = $pengembalianModel->find($id);
        $data['id'] = $id;

        $peminjamanModel = new PeminjamanModel();
        // Mengambil semua daftar peminjaman untuk pilihan select dropdown
        $data['list_peminjaman'] = $peminjamanModel->select('
                peminjaman.id_peminjaman, 
                members.name_member, 
                books.title_book, 
                peminjaman.tanggal_peminjaman AS tgl_pinjam
            ')
            ->join('members', 'members.id_member = peminjaman.id_member', 'left')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->findAll();

        return view('pengembalian/_edit', $data);
    }

    // Mengupdate data pengembalian (JSON Response)
    public function update()
    {
        $id            = $this->request->getPost('id'); // ID Pengembalian
        $id_peminjaman = $this->request->getPost('id_peminjaman');
        $tgl_kembali   = $this->request->getPost('tgl_kembali');
        $denda         = $this->request->getPost('denda') ?? 0;

        $pengembalianModel = new PengembalianModel();

        $isUpdated = $pengembalianModel->update($id, [
            'id_peminjaman' => $id_peminjaman,
            'tgl_kembali'   => $tgl_kembali,
            'denda'         => $denda
        ]);

        if ($isUpdated) {
            return $this->response->setJSON([
                'status'  => 'success',
                'code'    => 200,
                'message' => 'Data pengembalian berhasil diperbarui!'
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'code'    => 500,
                'message' => 'Gagal memperbarui data pengembalian.'
            ]);
        }
    }

    // Menghapus data pengembalian & mengembalikan status peminjaman ke 'Dipinjam' (JSON Response)
    public function delete($id)
    {
        $pengembalianModel = new PengembalianModel();
        $peminjamanModel   = new PeminjamanModel();

        // Cari detail data pengembalian sebelum dihapus untuk mengambil id_peminjaman-nya
        $pengembalian = $pengembalianModel->find($id);

        if ($pengembalian) {
            $id_peminjaman = $pengembalian['id_peminjaman'];

            $db = \Config\Database::connect();
            $db->transStart();

            // 1. Hapus record dari tabel pengembalian
            $pengembalianModel->delete($id);

            // 2. Kembalikan status peminjaman ke 'Dipinjam'
            $peminjamanModel->update($id_peminjaman, [
                'status' => 'Dipinjam'
            ]);

            $db->transComplete();

            if ($db->transStatus() !== false) {
                return $this->response->setJSON([
                    'status'  => 'success',
                    'code'    => 200,
                    'message' => 'Data pengembalian berhasil dihapus!'
                ]);
            }
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'code'    => 500,
            'message' => 'Gagal menghapus data pengembalian.'
        ]);
    }
}