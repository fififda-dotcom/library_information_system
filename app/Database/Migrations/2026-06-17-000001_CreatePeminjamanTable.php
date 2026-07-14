<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeminjamanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peminjaman' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'kode_peminjaman' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'id_member' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_book' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal_pinjam' => [
                'type' => 'DATE',
            ],
            'batas_kembali' => [
                'type' => 'DATE',
            ],
            'tanggal_dikembalikan' => [
                'type' => 'DATE',
                'null' => true,         // boleh kosong sebelum dikembalikan
            ],
            'durasi_pinjam' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 3,      // default 3 hari
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['dipinjam', 'dikembalikan'],
                'default'    => 'dipinjam',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_peminjaman', true); // jadikan primary key
        $this->forge->createTable('peminjaman', true);
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman'); // batalkan jika rollback
    }
}