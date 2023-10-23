@extends('layouts.app')
@extends('layouts.alert')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6" style="margin: 70px 0px 0px 0px;">
            <div class="card">
                <div class="card-header" style="background: #777B7E; color: white;">
                    <h5>Rincian Pesanan</h5>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            @foreach($pesanan as $no => $value)
                            <tr>
                                <td>Produk</td>
                                <td>:</td>
                                <td>{{$value->nama_produk}}</td>
                            </tr>
                            <tr>
                                <td>harga</td>
                                <td>:</td>
                                <td>Rp {{number_format($value->harga)}}</td>
                            </tr>
                            <tr>
                                <td>Berat</td>
                                <td>:</td>
                                <td>{{$value->berat}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{$value->alamat}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{$value->tanggal}}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Pesanan</td>
                                <td>:</td>
                                <td>{{$value->jumlah_pesanan}}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Harga</td>
                                <td>:</td>
                                <td><strong>Rp {{number_format($value->jumlah_harga)}}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection