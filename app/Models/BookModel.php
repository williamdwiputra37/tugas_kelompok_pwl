<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'tbl_book';
    protected $primaryKey = 'id_book';

    protected $allowedFields = [
        'title',
        'description',
        'cover',
        'price',
        'quantity',
    ];
}
