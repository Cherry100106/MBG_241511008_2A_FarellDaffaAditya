<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BahanBakuModel;

class BahanBaku extends Controller
{
    public function index()
    {
        $model = new BahanBakuModel();
        $data['bahan_baku'] = $model->findAll();
        return view('gudang/bahanbaku', $data);
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
        $tglKadaluarsa = new \DateTime($data['tanggal_kadaluarsa']);
        $hariIni = new \DateTime();
        if ($data['jumlah'] == 0) {
            $data['status'] = 'habis';
        }
        else if ($hariIni > $tglKadaluarsa) {
            $data['status'] = 'kadaluarsa';
        }
        else if ($tglKadaluarsa->diff($hariIni)->days <= 3) {
            $data['status'] = 'segera_kadaluarsa';
        }
        else {
            $data['status'] = 'tersedia';
        }
        $model->insert($data);
        return redirect()->to('/gudang/bahanbaku')->with('success', 'Bahan baku berhasil ditambahkan.');
    }
}