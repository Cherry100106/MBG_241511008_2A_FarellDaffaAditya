<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Gudang extends Controller
{
    public function dashboard()
    {    
        return view('gudang/dashboard');
    }

    public function daftarpermintaan()
    {
        $permintaanModel = new \App\Models\PermintaanModel();
        $data['permintaan'] = $permintaanModel
            ->select('permintaan.*, user.name as pemohon_nama')
            ->join('user','user.id = permintaan.pemohon_id')
            ->orderBy('permintaan.created_at', 'DESC')
            ->findAll();

        return view('gudang/daftarpermintaan', $data);
    }
}