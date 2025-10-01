<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Gudang extends Controller
{
    public function dashboard()
    {    
        return view('gudang/dashboard');
    }
}