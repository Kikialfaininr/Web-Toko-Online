<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    public function index()
    {
        $data = produk::all();
        return view('produk', compact('data'));
    }

    public function ongkir()
    {
        return view('ongkir');
    }

    public function ongkirsimpan(Request $request)
    {
        $kota_asal = $request->kota_asal;
        $kota_tujuan = $request->kota_tujuan;
        $berat = $request->berat;
        $kurir = $request->kurir;
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=".$kota_asal."&destination=".$kota_tujuan."&weight=".$berat.
                    "&courier=".$kurir."",
            CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: 703ba44af5890fbb1555812fb28fb821"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $ongkir = json_decode($response);
        }

        return view('ongkir',compact('ongkir', 'kota_asal', 'kota_tujuan', 'berat'));
    }
}