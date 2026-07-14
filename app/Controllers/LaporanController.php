<?php

namespace App\Controllers;
use App\Models\BookModel;
use App\Models\PeminjamanModel;

class LaporanController extends BaseController
{
    public function buku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Laporan Data Buku';

        return view('laporan/buku', $data);
    }

    public function cetakBuku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Laporan Data Buku';

        return view('laporan/cetak_buku', $data);
    }

    public function labelBuku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Cetak Label Buku';

        return view('laporan/label_buku', $data);
    }

    public function cetakLabelBuku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Cetak Label Buku';

        return view('laporan/cetak_label_buku', $data);
    }

    public function cetakLabelSatu($id)
    {
        $bookModel = new BookModel();
        $data['book'] = $bookModel->find($id);
        $data['title'] = 'Cetak Label Buku';

        return view('laporan/cetak_label_satu', $data);
    }

    public function member()
    {
        $memberModel = new \App\Models\MemberModel();
        $data['members'] = $memberModel->findAll();
        $data['title'] = 'Laporan Data Member';

        return view('laporan/member', $data);
    }

    public function cetakMember()
    {
        $memberModel = new \App\Models\MemberModel();
        $data['members'] = $memberModel->findAll();
        $data['title'] = 'Laporan Data Member';

        return view('laporan/cetak_member', $data);
    }

    public function peminjaman()
    {
        $peminjamanModel = new PeminjamanModel();
        $data['peminjaman'] = $peminjamanModel->select('peminjaman.*, members.name_member, books.title_book')
            ->join('members', 'members.id_member = peminjaman.id_member', 'left')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->orderBy('peminjaman.id_peminjaman', 'DESC')
            ->findAll();
        $data['title'] = 'Laporan Peminjaman Buku';

        return view('laporan/peminjaman', $data);
    }

    public function cetakPeminjaman()
    {
        $peminjamanModel = new PeminjamanModel();
        $data['peminjaman'] = $peminjamanModel->select('peminjaman.*, members.name_member, books.title_book')
            ->join('members', 'members.id_member = peminjaman.id_member', 'left')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->orderBy('peminjaman.id_peminjaman', 'DESC')
            ->findAll();
        $data['title'] = 'Laporan Peminjaman Buku';

        return view('laporan/cetak_peminjaman', $data);
    }

    public function pengembalian()
    {
        $peminjamanModel = new PeminjamanModel();
        $data['pengembalian'] = $peminjamanModel->select('peminjaman.*, members.name_member, books.title_book')
            ->join('members', 'members.id_member = peminjaman.id_member', 'left')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->where('peminjaman.status', 'dikembalikan')
            ->orderBy('peminjaman.tanggal_dikembalikan', 'DESC')
            ->findAll();
        $data['title'] = 'Laporan Pengembalian Buku';

        return view('laporan/pengembalian', $data);
    }

    public function cetakPengembalian()
    {
        $peminjamanModel = new PeminjamanModel();
        $data['pengembalian'] = $peminjamanModel->select('peminjaman.*, members.name_member, books.title_book')
            ->join('members', 'members.id_member = peminjaman.id_member', 'left')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->where('peminjaman.status', 'dikembalikan')
            ->orderBy('peminjaman.tanggal_dikembalikan', 'DESC')
            ->findAll();
        $data['title'] = 'Laporan Pengembalian Buku';

        return view('laporan/cetak_pengembalian', $data);
    }

    public function cetakStruk($id_member)
    {
        $memberModel = new \App\Models\MemberModel();
        $peminjamanModel = new \App\Models\PeminjamanModel();

        $data['member'] = $memberModel->find($id_member);
        $data['peminjaman'] = $peminjamanModel->select('peminjaman.*, books.title_book, books.code_book')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->where('peminjaman.id_member', $id_member)
            ->orderBy('peminjaman.id_peminjaman', 'DESC')
            ->findAll();
        $data['title'] = 'Struk Peminjaman Buku';

        return view('laporan/cetak_struk', $data);
    }

    public function denda()
    {
        $peminjamanModel = new PeminjamanModel();
        $data['denda'] = $peminjamanModel->select('peminjaman.*, members.name_member, books.title_book')
            ->join('members', 'members.id_member = peminjaman.id_member', 'left')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->where('peminjaman.denda >', 0)
            ->orderBy('peminjaman.tanggal_dikembalikan', 'DESC')
            ->findAll();
        $data['title'] = 'Laporan Denda Keterlambatan';

        return view('laporan/denda', $data);
    }

    public function cetakDenda()
    {
        $peminjamanModel = new PeminjamanModel();
        $data['denda'] = $peminjamanModel->select('peminjaman.*, members.name_member, books.title_book')
            ->join('members', 'members.id_member = peminjaman.id_member', 'left')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->where('peminjaman.denda >', 0)
            ->orderBy('peminjaman.tanggal_dikembalikan', 'DESC')
            ->findAll();
        $data['title'] = 'Laporan Denda Keterlambatan';

        return view('laporan/cetak_denda', $data);
    }
}