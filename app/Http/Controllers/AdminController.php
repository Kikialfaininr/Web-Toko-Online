<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahproduk = DB::select('select count(id_produk) as jumlahproduk from produk');
        $jumlahpesanan = DB::select('select count(id_pesanan) as jumlahpesanan from pesanan');
        return view('admin', compact('jumlahproduk', 'jumlahpesanan'));
    }
}
