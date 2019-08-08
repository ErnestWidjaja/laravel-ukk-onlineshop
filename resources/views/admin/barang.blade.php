@extends('adminlte::page')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

@if (Auth::user()->role=='Administrator')
<ul class="nav nav-tabs nav-justified">
  <li><a href="/home">Home</a></li>
  <li><a href="/admin/kategori">Category</a></li>
  <li class="active"><a href="/admin/barang">Item</a></li>
  <li><a href="/admin/laporan">Report</a></li>
</ul>
@endif

<div class="panel panel-default">
<div class="panel-body">
  <button class="btn btn-primary" id="btn-add" style="margin-bottom: 20px"><i class="fa fa-plus"></i></button>
<div class="table-responsive">
	<table class="table" id="table">
		<thead>
			<tr>
				<th style="background-color: lightblue">Name</th>
				<th style="background-color: lightblue">Category</th>
				<th style="background-color: lightblue">Price</th>
				<th style="background-color: lightblue">Stock</th>
				<th style="background-color: lightblue">Description</th>
				<th style="background-color: lightblue">Photo</th>
				<th style="background-color: lightblue;width: 20%">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($index as $data)
			<tr>
				<td>{{$data->nama_barang}}</td>
				<td>{{$data->kategori}}</td>
				<td>{{$data->harga_barang}}</td>
				<td>{{$data->stok_barang}}</td>
				<td>{{$data->deskripsi}}</td>
				<td><img class="img" src="{{URL::asset('/gambar/'.$data->foto)}}" style="width: 150px;height: 150px"></td>
				<td><button class="btn btn-warning" id="btn-edit" value="{{$data->id}}"><i class="fa fa-edit"></i></button>
					<a href="/admin/barang/hapus/{{ $data->id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
				</td>
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
        <h4 class="modal-title">Item</h4>
      </div>
      <div class="modal-body">
      	<input id="url" type="hidden" value="{{ \Request::url() }}">
      	<div class="form-group">
      		<label for="name">Name:</label>
      		<input type="text" class="form-control" id="name">
      	</div>
      	<div class="form-group">
      		<label for="category">Category:</label>
      		<select class="form-control" id="category">
      			@foreach ($kategori as $p)
      			<option value="{{$p->id}}">{{$p->kategori}}</option>
      			@endforeach
      		</select>
      	</div>
      	<div class="form-group">
      		<label for="price">Price:</label>
      		<input type="text" class="form-control" id="price">
      	</div>
      	<div class="form-group">
      		<label for="stock">Stock:</label>
      		<input type="text" class="form-control" id="stock">
      	</div>
      	<div class="form-group">
      		<label for="description">Description:</label>
      		<textarea class="form-control" id="description"></textarea>
      	</div>
      	<div class="form-group">
      		<label for="photo">Photo:</label>
      		<input type="file" class="form-control" id="photo">
      	</div>
      </div>
      <div class="modal-footer">
      	<input type="hidden" class="form-control" id="id">
        <button type="button" class="btn btn-primary" id="btn-save" data-dismiss="modal">Save</button>
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
<script src="{{asset('js/barang.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	$(document).ready( function () {
    $('#table').DataTable();
} );
</script>
@stop