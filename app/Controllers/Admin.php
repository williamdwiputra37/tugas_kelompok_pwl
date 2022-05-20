<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function __construct()
    {
        # code...
        helper(['form']);
    }
    
    public function index()
    {
        $header['title'] = 'Dashboard';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu');
        echo view('admin/dashboard');
        echo view('components/footer');
    }
}
