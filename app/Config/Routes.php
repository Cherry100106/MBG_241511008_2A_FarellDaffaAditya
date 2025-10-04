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
    $routes->get('permintaan', 'Gudang::daftarPermintaan'); // Daftar permintaan dari dapur
    $routes->get('permintaan/detail/(:num)', 'Gudang::lihatDetail/$1'); // Detail permintaan
    $routes->post('permintaan/setujui', 'Gudang::setujui'); // Proses setujui permintaan
    $routes->post('permintaan/tolak', 'Gudang::tolak'); // Proses tolak permintaan

    //ROUTES UNTUK BAHAN BAKU (CRUD)
    $routes->get('bahanbaku', 'BahanBaku::index'); // Daftar bahan baku
    $routes->get('bahanbaku/tambah', 'BahanBaku::tambah'); // Menampilkan form tambah bahan baku
    $routes->post('bahanbaku/store', 'BahanBaku::store'); // Proses Menyimpan data baru (Create)
    $routes->post('bahanbaku/update', 'BahanBaku::update'); // Proses Update Stok (Update)
    $routes->get('bahanbaku/edit/(:num)', 'BahanBaku::edit/$1'); // Menampilkan form edit bahan baku
    $routes->post('bahanbaku/delete', 'BahanBaku::delete'); // Proses Hapus bahan baku (Delete)
});
// Rute untuk Petugas Dapur (Client)
$routes->group('dapur', ['filter' => 'auth:dapur'], function($routes){
    $routes->get('dashboard', 'Dapur::dashboard'); // Tampilan dashboard client
    $routes->get('permintaan', 'Dapur::permintaan'); // Form buat permintaan bahan
    $routes->post('permintaan/store', 'Dapur::store_permintaan'); // Proses simpan permintaan
});