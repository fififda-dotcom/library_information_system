<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDendaToPeminjamanTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('peminjaman', [
            'denda' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
                'null'       => false,
                'after'      => 'tanggal_dikembalikan', // letakkan setelah kolom ini
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('peminjaman', 'denda');
    }
}