@extends('layouts.app')

@section('content')

<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 703ba44af5890fbb1555812fb28fb821"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $data = json_decode($response);
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11" style="margin: 50px 50px 0px 230px;">
            <div class="card">
                <div class="card-header" style="background: #777B7E; color: white;">
                    <h5>Cek Ongkos Kirim</h5>
                </div>

                <div class="card-body">
                    <form action="{{url('/ongkir-simpan')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kota_asal" class="form-label">Kota Asal:</label>

                            <select name="kota_asal" class="form-control">
                                <option> - Pilih Kota - </option>
                                <?php 
                                    foreach ($data->rajaongkir->results as $kota) {
                                        echo "<option value=" .$kota->city_id.">" .$kota->city_name."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kota_tujuan" class="form-label">Kota Tujuan:</label>
                            <select name="kota_tujuan" class="form-control">
                                <option> - Pilih Kota - </option>
                                <?php 
                                    foreach ($data->rajaongkir->results as $kota) {
                                        echo "<option value=" .$kota->city_id.">" .$kota->city_name."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="berat" class="form-label">Berat:</label>
                            <input type="number" placeholder="Satuan Gram" name="berat" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="kurir" class="form-label">Kurir:</label>
                            <select name="kurir" class="form-control">
                                <option> - Pilih Kurir - </option>
                                <option>jne</option>
                                <option>pos</option>
                                <option>tiki</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#CekOngkir">
                                Cek Ongkir
                            </button>
                        </div>
                    </form>
                    <div class="modal fade" id="CekOngkir" tabindex="-1" aria-labelledby="CekOngkirLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="CekOngkirLabel">Ongkos Kirim</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if(empty($ongkir->rajaongkir->results))

                                    @else
                                    <?php
                                foreach ($ongkir->rajaongkir->results[0]->costs as $ongkos) {
                                    $paket = $ongkos->service;
                                    $ongkos = $ongkos->cost[0]->value;

                                    echo "<div class='alert alert-info'>";
                                    echo "Paket : " .$paket;
                                    echo "<br>";
                                    echo "Ongkos Kirim : Rp " .number_format($ongkos,0);
                                    echo "<br>";
                                    echo "<div>";
                                }
                                ?>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
});
</script>

@endsection