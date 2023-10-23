@extends('layouts.app-admin')
@extends('layouts.alert')
@section('content')

<section class="content">
    <div class="inner col-md-11">
        <div class="container" style="margin: 50px 50px 0px 210px;">
            <h2 style="color: black;">Data Pesanan</h2>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table table-responsive" align="center">
                        <table id="example" class="table table-responsive table-bordered table-hover table-striped">
                            <thead>
                                <tr style="background-color: #666666; color: white;">
                                    <th align="center">No</th>
                                    <th align="center">ID Produk</th>
                                    <th align="center">Produk</th>
                                    <th align="center">Harga</th>
                                    <th align="center">Berat</th>
                                    <th align="center">Alamat</th>
                                    <th align="center">Tanggal</th>
                                    <th align="center">Jumlah Pesanan</th>
                                    <th align="center">Jumlah Harga</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

</section>

@foreach($pesanan as $no => $value)
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(function() {
    $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url("adminpesanan/json") !!}',
        columns: [{
                data: 'id_pesanan',
                name: 'id_pesanan'
            },
            {
                data: 'id_produk',
                name: 'id_produk'
            },
            {
                data: 'nama_produk',
                name: 'nama_produk'
            },
            {
                data: 'harga',
                name: 'harga',
                render: $.fn.dataTable.render.number('.')
            },
            {
                data: 'berat',
                name: 'berat'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'jumlah_pesanan',
                name: 'jumlah_pesanan'
            },
            {
                data: 'jumlah_harga',
                name: 'jumlah_harga',
                render: $.fn.dataTable.render.number('.')
            },
        ]
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