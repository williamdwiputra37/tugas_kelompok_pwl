<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Categories extends BaseController
{
    public function __construct()
    {
        # code...
        helper(['form']);
    }

    public function index()
    {
        $pager = \Config\Services::pager();
        $categoryModel = new CategoryModel();

        $data['category'] = $categoryModel->paginate(5, 'category');
        $data['pager'] = $categoryModel->pager;
        $data['page'] = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $header['title'] = 'categories';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu');
        echo view('admin/categories', $data);
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

    public function edit($id = null)
    {
        $categoryModel = new CategoryModel();
        $data['category'] = $categoryModel->find($id);

        $header['title'] = 'edit';
        echo view('components/header', $header);
        echo view('components/top_menu');
        echo view('components/side_menu');
        echo view('admin/categories_edit', $data);
        echo view('components/footer');
    }

    public function save_category()
    {
        helper(['form']);
        $session = session();

        $rules = [
            'name' => 'required|is_unique[tbl_category.name]',
        ];

        if ($this->validate($rules)) {
            $categoryModel = new CategoryModel();
            $data = [
                'name' => $this->request->getVar('name'),
            ];
            $categoryModel->save($data);
            $session->setFlashdata('msg', 'Category created successfully!');
            return redirect()->to('/admin/categories');
        } else {
            $session->setFlashdata('msg', 'Something wrong!');
            return redirect()->to('/admin/categories/create');
        }
    }

    public function update_category()
    {
        helper(['form']);
        $session = session();

        $rules = [
            'name' => 'required',
        ];

        if ($this->validate($rules)) {
            $categoryModel = new CategoryModel();
            $id = $this->request->getVar('id');
            $data = [
                'name' => $this->request->getVar('name'),
            ];
            $categoryModel->update($id, $data);
            $session->setFlashdata('msg', 'Category updated successfully!');
            return redirect()->to('/admin/categories');
        } else {
            $session->setFlashdata('msg', 'Something wrong!');
            return redirect()->to('/admin/categories/edit/' . $this->request->getVar('id'));
        }
    }

    public function delete_category($id = null)
    {
        $session = session();

        $categoryModel = new CategoryModel();
        $categoryModel->delete($id);

        $session->setFlashdata('msg', 'Category deleted successfully!');
        return redirect()->to('/admin/categories');
    }
}
