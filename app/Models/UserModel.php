<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'tbl_user';

    protected $allowedFields = [
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
        'role'
    ];
}