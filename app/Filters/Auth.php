<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    /**
     * Jalankan sebelum Controller
     * Cek apakah user sudah login
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }
        if (!empty($arguments)) {
            $requiredRole = $arguments[0];
            $userRole = session()->get('role');
            if ($userRole !== $requiredRole) {
                if ($userRole === 'gudang') {
                    return redirect()->to('/gudang/dashboard');
                } elseif ($userRole === 'dapur') {
                    return redirect()->to('/dapur/dashboard');
                } else {
                    return redirect()->to('/auth/login');
                }
            }
        }
    }
    

    /**
     * Jalankan setelah Controller
     * Kita tidak menggunakan ini untuk filter otentikasi
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}