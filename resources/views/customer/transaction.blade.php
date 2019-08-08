@extends('adminlte::page')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="panel panel-default">
	<div class="panel-heading">
    <div class="row">
    <div class="col-sm-3">
      <h3>Transaction</h3>
    </div>
    <div class="col-sm-3">
      <form action="/transaction">
        <select class="form-control" name="status" style="margin-top: 10px;margin-left: 515px">
          <option value="">All</option>
          <option value="Waiting">Waiting</option>
          <option value="Sending">Sending</option>
          <option value="Received">Received</option>
        </select>
      </div>
      <div class="col-sm-3">
        <button class="btn btn-danger" style="margin-left: 485px;margin-top: 11px;height: 31px"><i class="fa fa-search"></i></button>
      </div>
    </form>
    </div>
  </div>
	<div class="panel-body">

@foreach($index as $data)
    <div class="panel panel-default">
      @if(Auth::user()->role == 'Administrator')
      @if($data->status == 'Waiting')
        <div class="panel-heading"><h4><b>Transaction Number : {{$data->id_transaksi}} - {{$data->status}}</b><a href="/transaction/accept/{{$data->id_transaksi}}"><button style="margin-left: 40px" class="btn btn-danger">Accept</button></a></h4></div>
        @else
        <div class="panel-heading"><h4><b>Transaction Number : {{$data->id_transaksi}} - {{$data->status}}</b></h4></div>
        @endif
      @else
        @if($data->status == 'Sending')
        <div class="panel-heading"><h4><b>Transaction Number : {{$data->id_transaksi}} - {{$data->status}}</b><a href="/transaction/received/{{$data->id_transaksi}}"><button style="margin-left: 40px" class="btn btn-danger">Received</button></a></h4></div>
        @else
        <div class="panel-heading"><h4><b>Transaction Number : {{$data->id_transaksi}} - {{$data->status}}</b></h4></div>
        @endif
      @endif
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-3" style="margin-bottom: 30px">
            <div class="card">
              <div class="card-body">
                <img src="{{URL::asset('/gambar/'.$data->foto)}}" style="width: 250px;height: 250px">
                <h5 class="card-title"><b>{{$data->nama_barang}}</b></h5>
                <p class="card-text">{{$data->deskripsi}}</p>
                <p class="card-text">Jumlah :{{$data->jumlah}}</p>
                <p class="card-text">Subtotal :{{$data->subtotal}}</p>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
           <div class="panel panel-default">
            <div class="panel-heading"><h4>Total</h4></div>
            <div class="panel-body">
              <table class="table ">
                <?php $sum = 0;$sub = substr($data->subtotal, 3);?>
                <tr>
                  <td>{{$data->nama_barang}}</td>
                  <td>Rp <?php echo($sub) ?></td>
                </tr>
                <?php $sum += $sub; ?>
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
        </div>
        <div class="col-sm-6">
         <div class="panel panel-default">
          <div class="panel-heading"><h4>Info</h4></div>
          <div class="panel-body">
            <table class="table ">
              <tr>
                <td>Recipent</td>
                <td>{{$data->penerima}}</td>
              </tr>
              <tr>
                <td>Phone Number</td>
                <td>{{$data->no_tlp}}</td>
              </tr>
              <tr>
                <td>Address</td>
                <td>{{$data->alamat}}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
        </div>
      </div>
    </div>
@endforeach

</div>
</div>
@stop