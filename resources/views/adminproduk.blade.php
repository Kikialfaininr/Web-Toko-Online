@extends('layouts.app-admin')
@extends('layouts.alert')
@section('content')

<section class="content">
    <div class="inner col-md-11">
        <div class="container" style="margin: 50px 50px 0px 210px;">
            <h2 style="color: black;">Data Produk</h2>
            <hr>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#TambahProduk"
                style="margin-top: 25px; margin-bottom: 25px;">
                <i class="fa fa-plus"></i>Tambah Produk
            </button>
            <div class="card">
                <div class="card-body">
                    <div class="table table-responsive" align="center">
                        <table id="example" class="table table-responsive table-bordered table-hover table-striped">
                            <thead>
                                <tr style="background-color: #666666; color: white;">
                                    <th align="center">No</th>
                                    <th align="center" width="10%">Foto</th>
                                    <th align="center">Nama</th>
                                    <th align="center">Berat</th>
                                    <th align="center">Stok</th>
                                    <th align="center">Harga</th>
                                    <th align="center">Alamat</th>
                                    <th align="center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="TambahProduk" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{url('simpan-data-adminproduk')}}"
                                enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <label for="foto">{{ __('Foto Produk*') }}</label>
                                    <input id="foto" onchange="readFoto(event)" type="file" placeholder="Foto Produk"
                                        class="form-control @error('foto_produk') is-invalid @enderror" name="foto"
                                        value="{{ old('foto') }}" required autofocus>
                                    <img id='output' style="width:100px;">
                                    @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="nama_produk">{{ __('Nama Produk*') }}</label>
                                    <input id="nama_produk" type="text" placeholder="Nama Produk"
                                        class="form-control @error('nama_produk') is-invalid @enderror"
                                        name="nama_produk" value="{{ old('nama_produk') }}" required autofocus>
                                    @error('nama_produk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="berat">{{ __('Berat*') }}</label>
                                    <input id="berat" type="number" min="0" placeholder="Berat"
                                        class="form-control @error('berat') is-invalid @enderror" name="berat"
                                        value="{{ old('berat') }}" required autofocus>
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
                                        value="{{ old('stok') }}" required autofocus>
                                    @error('stok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="harga">{{ __('Harga*') }}</label>
                                    <input id="harga" type="number" min="0" placeholder="Harga"
                                        class="form-control @error('harga') is-invalid @enderror" name="harga"
                                        value="{{ old('harga') }}" required autofocus>
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
                                        value="{{ old('alamat') }}" required autofocus>
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <input class="btn btn-primary" type="submit" value="Simpan Data"
                                        style="width: 100%; margin-top: 10px;">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

</section>

@foreach($data as $no => $value)
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(function() {
    $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url("adminproduk/json") !!}',
        columns: [{
                data: 'id_produk',
                name: 'id_produk'
            },
            {
                data: 'foto',
                name: 'foto',
                render: function(data, type, full, meta) {
                    return "<img src=\"/storage/img/produk/" + data + "\" height=\"130\"/>";
                }
            },
            {
                data: 'nama_produk',
                name: 'nama_produk'
            },
            {
                data: 'berat',
                name: 'berat'
            },
            {
                data: 'stok',
                name: 'stok'
            },
            {
                data: 'harga',
                name: 'harga',
                render: $.fn.dataTable.render.number('.')
            },
            {
                data: 'alamat',
                name: 'alamat'
            }
        ],
        columnDefs: [{
            "targets": 7,
            "data": null,
            "render": function(data, type, row) {
                return "<a href='{{url($value->id_produk.'/edit-produk')}}'><button title='edit data' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i></button> <a href='{{url($value->id_produk.'/hapus-produk')}}'><button title='hapus data' class='btn btn-danger btn-xs'><i class='fa fa-remove'></i></button>"
            }
        }]
    });
});
</script>
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
@endforeach
@endsection