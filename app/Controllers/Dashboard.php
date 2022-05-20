<?php

namespace App\Controllers;

class Dashboard extends BaseController {
    public function index()
    {
        $header['title'] = 'Dashboard';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu_user');
        echo view('user/dashboard');
        echo view('components/footer');
    }
}