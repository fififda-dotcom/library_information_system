<?php

namespace App\Controllers;
use App\Models\MemberModel;

class MemberController extends BaseController
{
    public function index(): string
    {
        $memberModel = new MemberModel();
        $data['members'] = $memberModel->findAll();
        $data['title']   = 'Daftar Member';

        return view('members/index', $data);
    }

    public function ajaxTable() 
    {
        $memberModel = new MemberModel(); 
        $data['members'] = $memberModel->findAll(); 
        return view('members/_table', $data); 
    }

    public function ajaxCreate() 
    {
        return view('members/_create');
    }

    public function create()
    {
        $data['title'] = 'Tambah Member';
        return view('members/create', $data);
    }

    public function store()
    {
        $memberModel = new MemberModel();
        $isSaved = $memberModel->save([
            'code_member'    => $this->request->getPost('kode'),
            'name_member'    => $this->request->getPost('nama'),
            'email_member'   => $this->request->getPost('email'),
            'phone_member'   => $this->request->getPost('telepon'),
            'address_member' => $this->request->getPost('alamat'),
            'join_date'      => $this->request->getPost('tanggal_bergabung'),
        ]);

        if ($this->request->isAJAX()) {
            if ($isSaved) {
                return $this->response->setJSON(['status' => 'success', 'code' => 200, 'message' => 'Member berhasil disimpan!']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'code' => 500, 'message' => 'Gagal menyimpan member. Silakan coba lagi.']);
            }
        }

        if ($isSaved) {
            session()->setFlashdata('success', 'Member berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan member. Silakan coba lagi.');
        }

        return redirect()->to('/list/members');
    }

    public function edit($id)
    {
        $memberModel = new MemberModel();
        $data['title']         = 'Edit Member';
        $data['detail_member'] = $memberModel->find($id);
        $data['id']            = $id;

        return view('members/edit', $data);
    }

    public function update()
    {
        $id          = $this->request->getPost('id');
        $memberModel = new MemberModel();

        $isUpdated = $memberModel->update($id, [
            'code_member'    => $this->request->getPost('kode'),
            'name_member'    => $this->request->getPost('nama'),
            'email_member'   => $this->request->getPost('email'),
            'phone_member'   => $this->request->getPost('telepon'),
            'address_member' => $this->request->getPost('alamat'),
            'join_date'      => $this->request->getPost('tanggal_bergabung'),
        ]);

        if ($isUpdated) {
            session()->setFlashdata('success', 'Member berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui member. Silakan coba lagi.');
        }

        return redirect()->to('/list/members');
    }

    public function delete($id)
    {
        $memberModel = new MemberModel();
        $isDeleted   = $memberModel->delete($id);

        if ($this->request->isAJAX()) {
            if ($isDeleted) {
                return $this->response->setJSON(['status' => 'success', 'code' => 200, 'message' => 'Member berhasil dihapus!']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'code' => 500, 'message' => 'Gagal menghapus member. Silakan coba lagi.']);
            }
        }

        if ($isDeleted) {
            session()->setFlashdata('success', 'Member berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus member. Silakan coba lagi.');
        }

        return redirect()->to('/list/members');
    }
}