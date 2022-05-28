<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'tbl_book';
    protected $primaryKey = 'id_book';

    protected $allowedFields = [
        'isbn',
        'title',
        'description',
        'cover',
        'price',
        'quantity',
    ];

    public function getCategories()
    {
        $builder = $this->db->table('tbl_book');
        $builder->join('tbl_book_category', 'tbl_book.isbn = tbl_book_category.isbn');
        $builder->join('tbl_category', 'tbl_book_category.id_category = tbl_category.id_category');
        $builder->select('tbl_category.name');
        $query = $builder->get();
        return $query->getResult();
    }
}
