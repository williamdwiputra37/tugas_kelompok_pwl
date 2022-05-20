<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminGuard implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) 
    {
        if(session()->get('role') != 'admin') {
            return redirect()->to('error-permission');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) 
    {
        // Do something here
    }
}