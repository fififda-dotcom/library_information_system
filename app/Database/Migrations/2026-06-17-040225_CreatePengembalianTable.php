<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengembalianTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_pengembalian' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_peminjaman' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'tgl_kembali' => [
                'type'           => 'DATE',
            ],
            'denda' => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
            ],
        ]);
        $this->forge->addKey('id_pengembalian', true);
        $this->forge->createTable('pengembalian');
    }

    public function down()
    {
        $this->forge->dropTable('pengembalian');
    }
}