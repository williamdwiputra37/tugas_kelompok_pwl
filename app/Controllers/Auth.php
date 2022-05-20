<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function __construct()
    {
        # code...
        helper(['form']);
    }

    public function register()
    {
        return view('auth/register');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function store_register()
    {
        helper(['form']);
        $rules = [
            'nama'      => 'required',
            'email'     => 'required|valid_email|is_unique[tbl_user.email]',
            'password'  => 'required|min_length[8]',
            'repassword' => 'required|matches[password]',
        ];

        if ($this->validate($rules)) {
            $userModel = new UserModel();
            $data = [
                'nama'      => $this->request->getVar('nama'),
                'email'     => $this->request->getVar('email'),
                'no_hp'     => $this->request->getVar('no_hp'),
                'alamat'    => $this->request->getVar('alamat'),
                'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role'      => 'user'
            ];
            $userModel->save($data);
            return redirect()->to('/auth/register');
        } else {
            $data['validation'] = $this->validator;
            echo view('auth/register', $data);
        }
    }

    public function auth_login() 
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $userModel->where('email', $email)->first();

        if($data) {
            $pass = $data['password'];
            $authPass = password_verify($password, $pass);
            if($authPass) {
                $ses_data = [
                    'id' => $data['id_user'],
                    'nama' => $data['nama'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                if($data['role'] == 'admin') {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/dashboard');
                }
            } else {
                $session->setFlashdata('msg', 'Password incorrect!');
                return redirect()->to('/auth/login');
            }
        } else {
            $session->setFlashdata('msg', 'User does not exists!');
            return redirect()->to('/auth/login');
        }
    }

    public function logout()
    {
        $session = session();
        $ses_data = [
            'id',
            'nama',
            'email',
            'role',
            'isLoggedIn'
        ];
        $session->remove($ses_data);
        return redirect()->to('/auth/login');
    }
}
