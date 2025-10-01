<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Rute publik
$routes->get('/', 'Auth::login');
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/auth/logout', 'Auth::logout');

// Rute untuk Petugas Gudang (Admin)
$routes->group('gudang', ['filter' => 'auth:gudang'], function($routes){
    $routes->get('dashboard', 'Gudang::dashboard'); // Tampilan dashboard admin
    $routes->get('bahanbaku', 'BahanBaku::index'); // Daftar bahan baku
    $routes->post('bahanbaku/tambah', 'BahanBaku::tambah'); // Proses tambah bahan baku
});
// Rute untuk Petugas Dapur (Client)
$routes->group('dapur', ['filter' => 'auth:dapur'], function($routes){
    $routes->get('dashboard', 'Dapur::dashboard'); // Tampilan dashboard client
});