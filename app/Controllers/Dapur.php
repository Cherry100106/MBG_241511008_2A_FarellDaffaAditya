<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BahanBakuModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class Dapur extends Controller
{
    public function dashboard()
    {
        $model = new BahanBakuModel();
        $bahan_baku = $model->findAll();
        $bahanTersedia = [];
        foreach ($bahan_baku as $item) {
            if ($item['jumlah'] > 0 && $item['status'] !== 'kadaluarsa') {
                $bahanTersedia[] = $item;
            }
        }
        $data['bahan_baku'] = $bahanTersedia;
        return view('dapur/dashboard',$data);
    }

     public function permintaan()
    {
        $bahanBakuModel = new BahanBakuModel();
        $data['bahan_tersedia'] = $bahanBakuModel
            ->where('jumlah >', 0)
            ->where('status !=', 'kadaluarsa')
            ->findAll();
            
        return view('dapur/buatpermintaan', $data);
    }

     public function store_permintaan()
    {
        $permintaanModel = new PermintaanModel();
        $permintaanDetailModel = new PermintaanDetailModel();
        $permintaanData = [
            'pemohon_id'   => session()->get('user_id'),
            'tgl_masak'    => $this->request->getPost('tgl_masak'),
            'menu_makan'   => $this->request->getPost('menu_makan'),
            'jumlah_porsi' => $this->request->getPost('jumlah_porsi'),
            'status'       => 'menunggu',
            'created_at'  => date('Y-m-d H:i:s')
        ];
        $permintaanModel->insert($permintaanData);
        $permintaanId = $permintaanModel->getInsertID();
        $bahanIds = $this->request->getPost('bahan_id');
        $jumlahDiminta = $this->request->getPost('jumlah_diminta');

        if (!empty($bahanIds)) {
            foreach ($bahanIds as $key => $bahanId) {
                $detailData = [
                    'permintaan_id'  => $permintaanId,
                    'bahan_id'       => $bahanId,
                    'jumlah_diminta' => $jumlahDiminta[$key]
                ];
                $permintaanDetailModel->insert($detailData);
            }
        }

        return redirect()->to('/dapur/dashboard')->with('success', 'Permintaan bahan baku berhasil dikirim.');
    }
}