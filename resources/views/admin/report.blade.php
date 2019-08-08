@extends('adminlte::page')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

@if (Auth::user()->role=='Administrator')
<ul class="nav nav-tabs nav-justified">
  <li><a href="/home">Home</a></li>
  <li><a href="/admin/kategori">Category</a></li>
  <li><a href="/admin/barang">Item</a></li>
  <li class="active"><a href="/admin/laporan">Report</a></li>
</ul>
@endif

<div class="panel panel-default">
<div class="panel-body">
<div class="table-responsive">
	<table class="table" id="table">
		<thead>
			<tr>
				<th style="background-color: lightblue">Transaction ID</th>
				<th style="background-color: lightblue">Name</th>
				<th style="background-color: lightblue">Recipient</th>
				<th style="background-color: lightblue">Phone Number</th>
				<th style="background-color: lightblue">Address</th>
				<th style="background-color: lightblue">Status</th>
        <th style="background-color: lightblue">Detail</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($index as $data)
			<tr>
				<td>{{$data->id_transaksi}}</td>
				<td>{{$data->penerima}}</td>
				<td>{{$data->penerima}}</td>
				<td>{{$data->no_tlp}}</td>
				<td>{{$data->alamat}}</td>
				<td>{{$data->status}}</td>
        <td><button class="btn btn-primary" id="btn-detail" value="{{$data->id_transaksi}}"><i class="fa fa-info"></i></button></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail</h4>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
            <td><b>Item</b></td>
            <td><b>Quantity</b></td>
            <td><b>Subtotal</b></td>
          </tr>
          </thead>
          <tbody id="isi">
            
          </tbody>
          <tfoot id="total">
            
          </tfoot>
        </table>
      </div>
    </div>

  </div>
</div>

@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@stop
@section('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('js/report.js')}}"></script>
<script>
  $(document).ready( function () {
    $('#table').DataTable();
} );
</script>
@stop