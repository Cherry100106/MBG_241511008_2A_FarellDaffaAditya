<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BahanBakuModel;

class BahanBaku extends Controller
{
    public function index()
    {
        return view('gudang/bahanbaku');
    }

    public function tambah()
    {
        $model = new BahanBakuModel();
        $data = [
            'nama'               => $this->request->getPost('nama'),
            'kategori'           => $this->request->getPost('kategori'),
            'jumlah'             => $this->request->getPost('jumlah'),
            'satuan'             => $this->request->getPost('satuan'),
            'tanggal_masuk'      => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status'             => 'tersedia'
        ];
        $model->insert($data);
        return redirect()->to('/gudang/bahanbaku')->with('success', 'Bahan baku berhasil ditambahkan.');
    }
}