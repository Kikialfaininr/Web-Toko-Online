@extends('layouts.app-admin')
@extends('layouts.alert')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11" style="margin: 50px 50px 0px 230px;">
            <div class="card">
                <div class="card-header" style="background: #777B7E; color: white;">
                    <h5>Ubah Data Produk</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{url('update-produk/'.$data->id_produk)}}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="foto">{{ __('Foto Produk*') }}</label>
                            <input id="foto" onchange="readFoto(event)" type="file" placeholder="Foto Produk"
                                class="form-control @error('foto_produk') is-invalid @enderror" name="foto"
                                value="{{ $data->foto }}" required autofocus>
                            <img src="{{ asset('/storage/img/produk/'.$data->foto) }}" id='output'
                                style="width:100px;">
                            @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="nama_produk">{{ __('Nama Produk*') }}</label>
                            <input id="nama_produk" type="text" placeholder="Nama Produk"
                                class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk"
                                value="{{ $data->nama_produk }}" required autofocus>
                            @error('nama_produk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="berat">{{ __('Berat*') }}</label>
                            <input id="berat" type="number" placeholder="Berat"
                                class="form-control @error('berat') is-invalid @enderror" name="berat"
                                value="{{ $data->berat }}" required autofocus>
                            @error('berat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="stok">{{ __('Stok*') }}</label>
                            <input id="stok" type="number" min="0" placeholder="Stok"
                                class="form-control @error('stok') is-invalid @enderror" name="stok"
                                value="{{ $data->stok }}" required autofocus>
                            @error('stok')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="harga">{{ __('Harga*') }}</label>
                            <input id="harga" type="number" placeholder="Harga"
                                class="form-control @error('harga') is-invalid @enderror" name="harga"
                                value="{{ $data->harga }}" required autofocus>
                            @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="alamat">{{ __('Alamat*') }}</label>
                            <input id="alamat" type="text" placeholder="Alamat"
                                class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                value="{{ $data->alamat }}" required autofocus>
                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" value="Ubah Data"
                                style="width: 100%; margin-top: 10px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
var readFoto = function(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function() {
        var dataURL = reader.result;
        var output = document.getElementById('output');
        output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
};
</script>
@endsection