<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name_member'    => 'Ahmad Fauzi',
                'email_member'   => 'ahmad.fauzi@email.com',
                'phone_member'   => '081234567890',
                'address_member' => 'Jl. Airlangga No. 10, Surabaya',
                'status_member'  => 'Active',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name_member'    => 'Inas Tsabita',
                'email_member'   => 'inas.tsabita@email.com',
                'phone_member'   => '089876543210',
                'address_member' => 'Jl. Dharmawangsa No. 25, Surabaya',
                'status_member'  => 'Active',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name_member'    => 'Tommy Atmaji',
                'email_member'   => 'tommy.atmaji@email.com',
                'phone_member'   => '085612345678',
                'address_member' => 'Jl. Raya Gubeng No. 42, Surabaya',
                'status_member'  => 'Active',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        // Memasukkan data ke tabel 'members' sesuai nama di fungsi createTable() migration kamu
        $this->db->table('members')->insertBatch($data);
    }
}