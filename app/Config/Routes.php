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

    //ROUTES UNTUK BAHAN BAKU (CRUD)
    $routes->get('bahanbaku', 'BahanBaku::index'); // Daftar bahan baku
    $routes->get('bahanbaku/tambah', 'BahanBaku::tambah'); // Menampilkan form tambah bahan baku
    $routes->post('bahanbaku/store', 'BahanBaku::store'); // Proses Menyimpan data baru (Create)
    $routes->post('bahanbaku/update', 'BahanBaku::update'); // Proses Update Stok (Update)
    $routes->get('bahanbaku/edit/(:num)', 'BahanBaku::edit/$1'); // Menampilkan form edit bahan baku
});
// Rute untuk Petugas Dapur (Client)
$routes->group('dapur', ['filter' => 'auth:dapur'], function($routes){
    $routes->get('dashboard', 'Dapur::dashboard'); // Tampilan dashboard client
});