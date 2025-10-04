<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BahanBakuModel;
use Exception;

class BahanBaku extends Controller
{
    public function index()
    {
        $model = new BahanBakuModel();
        date_default_timezone_set('Asia/Jakarta');
        $hariIni = new \DateTime('today');
        
        $data['bahan_baku'] = $model->findAll();
        
        foreach ($data['bahan_baku'] as &$bahan) {
            try {
                $tglKadaluarsa = new \DateTime($bahan['tanggal_kadaluarsa']);
                
                $newStatus = '';
                if ($bahan['jumlah'] <= 0) {
                    $newStatus = 'habis';
                } else if ($hariIni > $tglKadaluarsa) {
                    $newStatus = 'kadaluarsa';
                } else {
                    $interval = $hariIni->diff($tglKadaluarsa);
                    if ($interval->days <= 3) {
                        $newStatus = 'segera_kadaluarsa';
                    } else {
                        $newStatus = 'tersedia';
                    }
                }
                
                if ($newStatus !== $bahan['status']) {
                    $model->update($bahan['id'], ['status' => $newStatus]);
                    $bahan['status'] = $newStatus;
                }
            } catch (Exception $e) {
                log_message('error', 'Error parsing date for item ID ' . $bahan['id'] . ': ' . $e->getMessage());
                continue;
            }
        }
        
        return view('gudang/bahanbaku', $data);
    }

    public function tambah()
    {
        return view('gudang/tambahbahanbaku');
    }

    public function store()
    {
        $model = new BahanBakuModel();
        
        $data = [
            'nama'               => $this->request->getPost('nama'),
            'kategori'           => $this->request->getPost('kategori'),
            'jumlah'             => $this->request->getPost('jumlah'),
            'satuan'             => $this->request->getPost('satuan'),
            'tanggal_masuk'      => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
        ];
        
        date_default_timezone_set('Asia/Jakarta');
        $tglKadaluarsa = new \DateTime($data['tanggal_kadaluarsa']);
        $hariIni = new \DateTime('today');
        
        if ($data['jumlah'] <= 0) {
            $data['status'] = 'habis';
        } else if ($hariIni > $tglKadaluarsa) {
            $data['status'] = 'kadaluarsa';
        } else {
            $interval = $hariIni->diff($tglKadaluarsa);
            if ($interval->days <= 3) {
                $data['status'] = 'segera_kadaluarsa';
            } else {
                $data['status'] = 'tersedia';
            }
        }
        
        $model->insert($data);
        
        return redirect()->to('/gudang/bahanbaku')->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new BahanBakuModel();
        $data['bahan'] = $model->find($id);

        if (!$data['bahan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data bahan baku tidak ditemukan untuk id: ' . $id);
        }

        return view('gudang/editbahanbaku', $data);
    }

    public function update()
    {
        $model = new BahanBakuModel();
        $id = $this->request->getPost('id');
        $newJumlah = $this->request->getPost('jumlah');

        if ($newJumlah < 0) {
            return redirect()->back()->withInput()->with('error', 'Jumlah stok tidak boleh kurang dari nol.');
        }

        $model->update($id, ['jumlah' => $newJumlah]);
        
        return redirect()->to('/gudang/bahanbaku')->with('success', 'Stok berhasil diperbarui.');
    }

    public function delete()
    {
        $model = new BahanBakuModel();
        $id = $this->request->getPost('id');
        $bahan = $model->find($id);
        if (!$bahan) {
            return redirect()->to('/gudang/bahanbaku')->with('error', 'Data bahan baku tidak ditemukan.');
        }
        if ($bahan['status'] == 'kadaluarsa') {
            $model->delete($id);
            return redirect()->to('/gudang/bahanbaku')->with('success', 'Bahan baku berhasil dihapus.');
        } else {
            return redirect()->to('/gudang/bahanbaku')->with('error', 'Gagal menghapus! Hanya bahan baku berstatus "kadaluarsa" yang boleh dihapus.');
        }
    }
}