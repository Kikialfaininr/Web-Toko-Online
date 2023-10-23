@extends('layouts.app-admin')
@section('content')
<section class="content">
    <div class="inner">
        <div class="card rounded" style="margin: 80px 60px 10px 300px; color: white; ">
            <div class="card-header" style="background: #777B7E;">
                <h3>Dashboard</h3>
            </div>
            <div class="card-body" style="background: #999DA0;">
                <h4 class="card-title">Dashboard Admin</h4>
                <h6 class="card-text">Dashboard sebagai pusat kontrol untuk mengatur produk pada toko online jam tangan
                    Seiko</h6>
                <a href="{{url('/home')}}" class="btn" style="background: white; color: #999DA0;">Seiko Toko Online</a>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-4" style="margin-left: 300px; margin-top: 20px;">
                <div class="box"
                    style="background-color: #white; color: #777B7E; border: 3px solid #777B7E; padding: 30px; border-radius: 50px;">
                    <center><i class="fa-solid fa-box-open fa-4x"></i></center><br>
                    <h1>
                        <center>
                            @foreach($jumlahproduk as $no => $value)
                                {{$value->jumlahproduk}}
                            @endforeach
                        </center>
                    </h1>
                    <h4>
                        <center>Produk Tersedia
                        </center>
                    </h4>
                </div>
            </div>
            <div class="col-md-4" style="margin-left: 100px; margin-top: 20px;">
                <div class="box"
                    style="background-color: #white; color: #777B7E; border: 3px solid #777B7E; padding: 30px; border-radius: 50px;">
                    <center><i class="fa-solid fa-cart-shopping fa-4x"></i></center><br>
                    <h1>
                        <center>
                            @foreach($jumlahpesanan as $no => $value)
                                {{$value->jumlahpesanan}}
                            @endforeach
                        </center>
                    </h1>
                    <h4>
                        <center>Produk Terjual
                        </center>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection