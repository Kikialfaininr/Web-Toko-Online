@extends('layouts.app')

@section('content')
<div
    style="background-image: url('storage/img/bg.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover; weight: 100%;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="container-fluid two-box">
                <div class=" trans" style="margin: 100px 0 100px 0; background-color: rgba(0, 0, 0, 0.5);">
                    <div class="row">
                        <div class="col-sm center-dist" align="center">
                            <h1 style=" color: white; font-size: 100px, font-weight: bold 900; padding-top: 50px;">
                                <b>WHAT'S NEW</b>
                            </h1>
                            <h5 style="color: white;">
                                Temukan jam terbaikmu dengan desain yang memukau dan modern.
                            </h5>
                            <a style="margin-bottom: 50px;" href="{{url('/produk')}}" class="btn btn-danger">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection