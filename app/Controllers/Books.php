<?php

namespace App\Controllers;

use App\Models\BookCategoryModel;
use App\Models\BookModel;
use App\Models\CategoryModel;

class Books extends BaseController {
    public function __construct() {
        helper(['form']);
    }

    public function index()
    {
        $booksModel = new BookModel();
        $data['books'] = $booksModel->findAll();
        $data['categories'] = $booksModel->getCategories();

        $header['title'] = 'categories';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu');
        echo view('admin/books', $data);
        echo view('components/footer');
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();

        $header['title'] = 'categories';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu');
        echo view('admin/books_create', $data);
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
            $bookCategoryModel = new BookCategoryModel();
            $session = session();

            $img = $this->request->getFile('cover');
            $coverName = $img->getRandomName();

            $data = [
                'isbn' => $this->request->getVar('isbn'),
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'cover' => $coverName,
                'price' => $this->request->getVar('price'),
                'quantity' => $this->request->getVar('quantity'),
            ];

            $img->move('uploads/covers', $coverName);

            $bookModel->save($data);

            $dataBookCategory = array();
            foreach($this->request->getVar('category') as $category) {
                $dataBookCategory[] = array(
                    'isbn' => $this->request->getVar('isbn'),
                    'id_category' => $category
                );
            }

            $bookCategoryModel->insertBatch($dataBookCategory);
            $session->setFlashdata('msg', 'Data berhasil disimpan');
            return redirect()->to('/admin/books');
        } else {
            $session->setFlashdata('msg', $this->validator->getErrors());
            return redirect()->to('/admin/books/create');
        }
    }
}