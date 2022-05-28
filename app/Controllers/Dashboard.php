<?php

namespace App\Controllers;

use App\Models\BookModel;

class Dashboard extends BaseController {
    public function index()
    {
        $booksModel = new BookModel();
        $data['books'] = $booksModel->findAll();
        $data['categories'] = $booksModel->getCategories();

        $header['title'] = 'Dashboard';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu_user');
        echo view('user/dashboard', $data);
        echo view('components/footer');
    }
}