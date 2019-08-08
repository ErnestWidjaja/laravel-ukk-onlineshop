@extends('adminlte::page')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<?php 
$tahun = date('Y');
$bulan = date('m');
$hari = date('d');
$jam = date('H');
$menit = date('i');
$detik = date('s');
$id_transaksi = sprintf("%d%d%d%d%d%d",$tahun,$bulan,$hari,$jam,$menit,$detik);
 ?>
<div class="panel panel-default">
	<div class="panel-heading"><h3>Process</h3></div>
	<div class="panel-body">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Info</h4></div>
      <div class="panel-body">
        <table class="table">
          <form action="/transaction/stores">
          @foreach($user as $users)
          <tr>
            <td><h4>Recipient</h4></td>
          </tr>
          <tr>
            <td><input type="text" name="penerima" class="form-control" value="{{$users->name}}" required></td>
          </tr>
          <tr>
          <tr>
            <td><h4>Phone Number</h4></td>
          </tr>
          <tr>
            <td><input type="number" name="no_tlp" class="form-control" value="{{$users->no_tlp}}" required></td>
          </tr>
          <tr>
            <td><h4>Address</h4></td>
          </tr>
          <tr>
            <td><textarea class="form-control" name="alamat" style="resize: vertical;" required>{{$users->alamat}}</textarea></td>
          </tr>
            @endforeach
        </table>
      </div>
      </div>
		<div class="row">
			@foreach ($index as $data)
			<div class="col-sm-3" style="margin-bottom: 30px">
				<div class="card">
					<div class="card-body">
						<img class="img" src="{{URL::asset('/gambar/'.$data->foto)}}" style="width: 250px;height: 250px">
						<h5 class="card-title"><b>{{$data->nama_barang}}</b></h5>
						<p class="card-text">{{$data->deskripsi}}</p>
						<p class="card-text">Jumlah :{{$data->jumlah}}</p>
						<p class="card-text">Subtotal :{{$data->subtotal}}</p>
            <input type="hidden" name="id_barang" value="{{$data->id_barang}}">
            <input type="hidden" name="subtotal" value="{{$data->subtotal}}">
            <input type="hidden" name="jumlah" value="{{$data->jumlah}}">
            <input type="hidden" name="id_transaksi" value="{{$id_transaksi}}">
					</div>
				</div>
			</div>
			@endforeach
    </div>
      <div class="col-sm-3">
       <div class="panel panel-default">
        <div class="panel-heading"><h4>Total</h4></div>
        <div class="panel-body">
          <table class="table ">
            <?php $sum = 0; ?>
            @foreach ($index as $data)
            <?php $sub = substr($data->subtotal, 3);?>
            <tr>
              <td>{{$data->nama_barang}}</td>
              <td>Rp <?php echo($sub) ?></td>
            </tr>
            <?php $sum += $sub; ?>
            @endforeach
            <tr>
              <td>Ongkir</td>
              <td>Rp 10000</td>
            </tr>
            <tr>
              <td><b>Total</b></td>
              <td>Rp <?php echo($sum+10000); ?></td>
              <input type="hidden" name="total" value="<?php echo($sum+10000); ?>">
            </tr>
          </table>
        </div>
      </div>
         <button class="btn btn-danger col-sm-12" id="btn-process">Pay</button>
       </form>
     </div>
		</div>
	</div>
</div>
@stop