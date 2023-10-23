<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        return produk::all();
    }

    public function simpan(Request $request)
    {
        $data = new produk();
            $data->foto = $request->foto;
            $data->nama_produk = $request->nama_produk;
            $data->berat = $request->berat;
            $data->stok = $request->stok;
            $data->harga = $request->harga;
            $data->alamat = $request->alamat;
        $data->save();
        return "Data berhasil di simpan";
    }

    public function edit(Request $request, $id)
    {
        $data = produk::where('id_produk', $id)->first();
            $data->nama_produk = $request->nama_produk;
            $data->berat = $request->berat;
            $data->stok = $request->stok;
            $data->harga = $request->harga;
            $data->alamat = $request->alamat;
        $data->save();
        return "Data berhasil di update";
    }

    public function delete($id)
    {
        $data = produk::where('id_produk', $id)->first();
        $data->delete();
    return "Data berhasil di hapus";
    }
}
