<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table            = 'pengembalian';
    protected $primaryKey       = 'id_pengembalian';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'id_peminjaman',
        'tgl_kembali',
        'denda',
    ];

    // Dates
    protected $useTimestamps = false;
}