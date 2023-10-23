<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Yajra\DataTables\Facades\DataTables;
use Redirect;
use Session;
use DB;
use Image;

class AdminProdukController extends Controller
{
    public function index(Request $request)
    {
        if ($request){
            $data = produk::where('nama_produk', 'LIKE', '%' .$request->search. '%')->get();
        } else{
            $data = DB::select('select * from produk order by created_at DESC');
        }
        return view('adminproduk', compact('data', 'request'));
    }

    public function data()
    {
        return DataTables::of(produk::query())->toJson();
    }

    public function adminproduk(Request $request)
    {
        return view('adminproduk', compact('data', 'request'));
    }

    public function adminongkir()
    {
        return view('adminongkir');
    }

    public function adminongkirsimpan(Request $request)
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

        return view('adminongkir',compact('ongkir', 'kota_asal', 'kota_tujuan', 'berat'));
    }

    public function simpan(Request $request)
    {
        $request->validate( [
            'foto' => 'mimes:jpg,jpeg,png',        
            ]
        );

        $file = $request->file('foto');
        $name = 'FT'.date('Ymdhis').'.'.$request->file('foto')->getClientOriginalExtension();

        $resize_foto = Image::make($file->getRealPath());
        $resize_foto->resize(200, 200, function($constraint){
            $constraint->aspectRatio();
        })->save('storage/img/produk/'.$name);
        
        $data = DB::select('select * from produk where nama_produk = "'.$request->nama_produk.'"');
        if (empty($data)){ 
        $data = new produk();
            $data->foto = $name;
            $data->nama_produk = $request->nama_produk;
            $data->berat = $request->berat;
            $data->stok = $request->stok;
            $data->harga = $request->harga;
            $data->alamat = $request->alamat;
        $data->save();
        Session::flash('sukses', 'Data berhasil ditambahkan');
        return Redirect('/adminproduk');
        } else {
            Session::flash('gagal', 'Maaf nama produk sudah ada');
            return Redirect('/adminproduk');
        }
    }

    public function edit(Request $request, $id)
    {
        $data = produk::where('id_produk', $id)->first(); 
        return view('/editproduk', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate( [
            'foto' => 'mimes:jpg,jpeg,png',
            'nama_produk' => 'required',
            'berat' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'alamat' => 'required',
        ]
        );

        $file = $request->file('foto');  
        $name = 'FT'.date('Ymdhis').'.'.$request->file('foto')->getClientOriginalExtension();

        $resize_foto = Image::make($file->getRealPath());
        $resize_foto->resize(200, 200, function($constraint){
            $constraint->aspectRatio();
        })->save('storage/img/produk/'.$name);

        $data = produk::where('id_produk', $id)->first();
            $data->foto = $name;
            $data->nama_produk = $request->nama_produk;
            $data->berat = $request->berat;
            $data->stok = $request->stok;
            $data->harga = $request->harga;
            $data->alamat = $request->alamat;
        $data->save();
        Session::flash('sukses', 'Data berhasil diubah');
        return Redirect('/adminproduk');
    }

    public function hapus(Request $request, $id)
    {
        $data = produk::where('id_produk', $id)->first();
            unlink('storage/img/produk/'.$data->foto);
        $data->delete();
        Session::flash('sukses', 'Data berhasil dihapus');
        return Redirect('/adminproduk');
    }
}