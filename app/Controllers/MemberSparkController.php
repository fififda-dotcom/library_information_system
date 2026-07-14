<?php

namespace App\Controllers;
use App\Models\MemberSparkModel;

class MemberSparkController extends BaseController
{
    public function index(): string
    {
        $memberSparkModel       = new MemberSparkModel();
        $data['members_spark']  = $memberSparkModel->findAll();
        $data['title']          = 'Daftar Member Spark';

        return view('members_spark/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Member Spark';
        return view('members_spark/create', $data);
    }

    public function store()
    {
        $memberSparkModel = new MemberSparkModel();
        $isSaved = $memberSparkModel->save([
            'code_member'    => $this->request->getPost('kode'),
            'name_member'    => $this->request->getPost('nama'),
            'email_member'   => $this->request->getPost('email'),
            'phone_member'   => $this->request->getPost('telepon'),
            'address_member' => $this->request->getPost('alamat'),
            'join_date'      => $this->request->getPost('tanggal_bergabung'),
        ]);

        if ($isSaved) {
            session()->setFlashdata('success', 'Member Spark berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan Member Spark. Silakan coba lagi.');
        }

        return redirect()->to('/list/members-spark');
    }

    public function edit($id)
    {
        $memberSparkModel             = new MemberSparkModel();
        $data['title']                = 'Edit Member Spark';
        $data['detail_member_spark']  = $memberSparkModel->find($id);
        $data['id']                   = $id;

        return view('members_spark/edit', $data);
    }

    public function update()
    {
        $id               = $this->request->getPost('id');
        $memberSparkModel = new MemberSparkModel();

        $isUpdated = $memberSparkModel->update($id, [
            'code_member'    => $this->request->getPost('kode'),
            'name_member'    => $this->request->getPost('nama'),
            'email_member'   => $this->request->getPost('email'),
            'phone_member'   => $this->request->getPost('telepon'),
            'address_member' => $this->request->getPost('alamat'),
            'join_date'      => $this->request->getPost('tanggal_bergabung'),
        ]);

        if ($isUpdated) {
            session()->setFlashdata('success', 'Member Spark berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui Member Spark. Silakan coba lagi.');
        }

        return redirect()->to('/list/members-spark');
    }

    public function delete($id)
    {
        $memberSparkModel = new MemberSparkModel();
        $isDeleted        = $memberSparkModel->delete($id);

        if ($isDeleted) {
            session()->setFlashdata('success', 'Member Spark berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus Member Spark. Silakan coba lagi.');
        }

        return redirect()->to('/list/members-spark');
    }
}