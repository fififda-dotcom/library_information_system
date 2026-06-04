<?php

namespace App\Controllers;
use App\Models\BookModel;

class BookController extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Daftar Buku';
        return view('books/index', $data);
    }
    

   public function ajaxTable() 
{
    $bookModel = new BookModel(); 
    $data['books'] = $bookModel->findAll(); 
    return view('books/_table', $data); 
}

 public function create()
    {
        $data['title'] = 'Tambah Data Buku';
        return view('books/create', $data);
    }
    
    public function ajaxCreate() 
    {
        return view ('books/_create');
    }

    public function store()
    {

        if($this->request->isAJAX()) {
            $title = $this->request->getPost('judul');
            $code = $this->request->getPost('kode');
            $isbn = $this->request->getPost('isbn');
            $author = $this->request->getPost('penulis');
            $publisher = $this->request->getPost('penerbit');
            $published_year = $this->request->getPost('tahun_terbit');
            $description = $this->request->getPost('keterangan');

            $bookModel = new BookModel();
            $isSaved = $bookModel->save([
            'code_book' => $code,
            'isbn_book' => $isbn,
            'title_book' => $title,
            'author_book' => $author,
            'publisher_book' => $publisher,
            'published_year' => $published_year,
            'description_book' => $description,
        ]);

        if($isSaved) {
            return $this->response->setJSON(['status' => 'success', 'code' => 200, 'message' => 'Buku berhasil disimpan!']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'code' => 500, 'message' => 'Gagal menyimpan buku. Silakan coba lagi.']);
        }
    } 

    return redirect()->to('/list/books');
} 

    public function edit($id) 
{
    $data['title'] = 'Edit Buku';
        $bookModel = new BookModel();
        $data['detail_buku'] = $bookModel->find($id);
        $data['id'] = $id;
        
        return view('books/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $title = $this->request->getPost('judul');
        $code = $this->request->getPost('kode');
        $isbn = $this->request->getPost('isbn');
        $author = $this->request->getPost('penulis');
        $publisher = $this->request->getPost('penerbit');
        $published_year = $this->request->getPost('tahun_terbit');
        $description = $this->request->getPost('keterangan');

        $bookModel = new BookModel();
        $detailBook = [
            'code_book' => $code,
            'isbn_book' => $isbn,
            'title_book' => $title,
            'author_book' => $author,
            'publisher_book' => $publisher,
            'published_year' => $published_year,
            'description_book' => $description,
        ];
        $isUpdated = $bookModel->update($id, $detailBook);

        if($isUpdated) {
            session()->setFlashdata('success', 'Buku berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui buku. Silakan coba lagi.');
        }

        return redirect()->to('/list/books');
    }

    public function delete($id)
    {
        if ($this->request->isAJAX()) 
        {
            $bookModel = new BookModel();
            $isDeleted = $bookModel->delete($id);
            
            if ($isDeleted) {
                return $this->response->setJSON(['status' => 'success', 'code' => 200, 'message' => 'Buku berhasil dihapus!']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'code' => 500, 'message' => 'Gagal menghapus buku. Silakan coba lagi.']);
            }
        }
        return redirect()->to('/list/books');
    }
}