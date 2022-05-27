<?php

namespace App\Controllers;

use App\Models\BookModel;

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

    public function save_book()
    {
        helper(['form']);
        $session = session();

        $rules = [
            'title' => 'required|max_length[255]',
            'cover' => 'uploaded[cover]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
            'price' => 'required',
            'quantity' => 'required',
        ];

        if ($this->validate($rules)) {
            $bookModel = new BookModel();
            $session = session();

            $img = $this->request->getFile('cover');
            $coverName = $img->getRandomName();

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'cover' => $coverName,
                'price' => $this->request->getVar('price'),
                'quantity' => $this->request->getVar('quantity'),
            ];

            $img->move('uploads/covers', $coverName);

            $bookModel->save($data);
            $session->setFlashdata('msg', 'Data berhasil disimpan');
            return redirect()->to('/admin/books');
        } else {
            $session->setFlashdata('msg', $this->validator->getErrors());
            return redirect()->to('/admin/books/create');
        }
    }
}