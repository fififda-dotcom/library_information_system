<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table            = 'members';
    protected $primaryKey       = 'id_member';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'code_member',
        'name_member',
        'email_member',
        'phone_member',
        'address_member',
        'join_date',
    ];

    protected $useTimestamps = false;
}