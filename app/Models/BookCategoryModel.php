<?php

namespace App\Models;

use CodeIgniter\Model;

class BookCategoryModel extends Model
{
    protected $table            = 'tbl_book_category';
    protected $primaryKey       = 'id_book_category';
    
    protected $allowedFields    = [
        'isbn',
        'id_category'
    ];
}
