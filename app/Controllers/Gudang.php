<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BahanBakuModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class Gudang extends Controller
{
    public function dashboard()
    {    
        return view('gudang/dashboard');
    }

    public function daftarPermintaan()
    {
        $permintaanModel = new PermintaanModel();
        $data['permintaan'] = $permintaanModel
            ->select('permintaan.*, user.name as pemohon_nama')
            ->join('user','user.id = permintaan.pemohon_id')
            ->orderBy('permintaan.created_at', 'DESC')
            ->findAll();

        return view('gudang/daftarpermintaan', $data);
    }

    public function lihatDetail($id)
    {
        $permintaanModel = new PermintaanModel();
        $permintaanDetailModel = new PermintaanDetailModel();

        $data['permintaan'] = $permintaanModel
            ->select('permintaan.*, user.name as pemohon_nama')
            ->join('user','user.id = permintaan.pemohon_id')
            ->find($id);

        if (!$data['permintaan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Permintaan tidak ditemukan');
        }

        $data['detail_bahan'] = $permintaanDetailModel
            ->select('permintaan_detail.*, bahan_baku.nama as nama_bahan, bahan_baku.jumlah as stok_gudang, bahan_baku.satuan')
            ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
            ->where('permintaan_id', $id)
            ->findAll(); 
        
        return view('gudang/detailpermintaan', $data);
    }

    public function setujui()
    {
        $permintaanId = $this->request->getPost('permintaan_id');
        $permintaanModel = new PermintaanModel();
        $permintaanDetailModel = new PermintaanDetailModel();
        $bahanBakuModel = new BahanBakuModel();

        $detailBahan = $permintaanDetailModel->where('permintaan_id', $permintaanId)->findAll();

        foreach ($detailBahan as $item) {
            $bahan = $bahanBakuModel->find($item['bahan_id']);
            if ($bahan) {
                $stokBaru = $bahan['jumlah'] - $item['jumlah_diminta'];
                $bahanBakuModel->update($item['bahan_id'], ['jumlah' => $stokBaru]);
            }      
        }
        $permintaanModel->update($permintaanId, ['status' => 'disetujui']);

        return redirect()->to('/gudang/permintaan')->with('success', 'Permintaan berhasil disetujui dan stok telah diperbarui.');
    }

    public function tolak()
    {
        $permintaanId = $this->request->getPost('permintaan_id');
        $permintaanModel = new PermintaanModel();
        $permintaanModel->update($permintaanId, ['status'=> 'ditolak']);
        return redirect()->to('/gudang/permintaan')->with('success', 'Permintaan telah ditolak.');
    }
}