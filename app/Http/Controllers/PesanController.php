<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Pesanan;
use Session;

class PesanController extends Controller
{
    public function index()
    {
        $pesanan = pesanan::all();
        return view('pesanan', compact('pesanan'));
    }

    public function pesanan()
    {
        return DataTables::of(pesanan::query())->toJson();
    }

    public function adminpesanan(Request $request)
    {
        $pesanan = pesanan::all();
        return view('adminpesanan', compact('pesanan', 'request'));
    }

    public function ongkir()
    {
        return view('pesanan');
    }

    public function ongkirpesan(Request $request)
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

        return view('pesanan',compact('ongkir', 'kota_asal', 'kota_tujuan', 'berat'));
    }
    
    public function simpanpesanan(Request $request)
    {
        $tanggal = Carbon::now();
        
        if (empty($pesanan)){
        $pesanan = new pesanan();
            $pesanan->id_pesanan = $request->id_pesanan;
            $pesanan->id_produk = $request->id_produk;
            $pesanan->nama_produk = $request->nama_produk;
            $pesanan->harga = $request->harga;
            $pesanan->berat = $request->berat;
            $pesanan->alamat = $request->alamat;
            $pesanan->tanggal = $tanggal;
            $pesanan->jumlah_pesanan = $request->jumlah_pesanan;
            $pesanan->jumlah_harga = $request->harga*$request->jumlah_pesanan;
        $pesanan->save();
        Session::flash('sukses', 'Produk berhasil dipesan');
        return Redirect('/pesanan');
        } else {
            Session::flash('gagal', 'Maaf pesanan gagal');
            return Redirect('/produk');
        }
    } 


}
