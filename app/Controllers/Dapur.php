<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BahanBakuModel;

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
}