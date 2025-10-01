<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Dapur extends Controller
{
    public function dashboard()
    {
        return view('dapur/dashboard');
    }
}