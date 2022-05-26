<?php

namespace App\Controllers;

class Books extends BaseController {
    public function __construct() {
        helper(['form']);
    }

    public function index()
    {
        $header['title'] = 'categories';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu');
        echo view('admin/books');
        echo view('components/footer');
    }

    public function create()
    {
        $header['title'] = 'categories';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu');
        echo view('admin/books_create');
        echo view('components/footer');
    }
}