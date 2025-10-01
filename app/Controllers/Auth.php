<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session = session();
            $session->set([
                'isLoggedIn' => true,
                'user_id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'] 
            ]);
            // Redirect berdasarkan role
            if ($user['role'] === 'gudang') {
                return redirect()->to('/gudang/dashboard');
            } else {
                return redirect()->to('/dapur/dashboard');
            }
        } else {
            session()->setFlashdata('error', 'Email atau password salah.');
            return redirect()->to('/auth/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth/login');
    }
}