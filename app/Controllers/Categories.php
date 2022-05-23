<?php

namespace App\Controllers;

class Categories extends BaseController
{
    public function __construct()
    {
        # code...
        helper(['form']);
    }
    
    public function index()
    {
        $header['title'] = 'categories';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu');
        echo view('admin/categories');
        echo view('components/footer');
    }

    public function create()
    {
        $header['title'] = 'create';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu');
        echo view('admin/categories_create');
        echo view('components/footer');
    }
}