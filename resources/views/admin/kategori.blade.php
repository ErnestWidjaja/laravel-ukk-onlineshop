@extends('adminlte::page')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

@if (Auth::user()->role=='Administrator')
<ul class="nav nav-tabs nav-justified">
  <li><a href="/home">Home</a></li>
  <li class="active"><a href="/admin/kategori">Category</a></li>
  <li><a href="/admin/barang">Item</a></li>
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
				<th style="background-color: lightblue">Id</th>
				<th style="background-color: lightblue">Category</th>
				<th style="background-color: lightblue;width: 20%">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($index as $data)
			<tr>
				<td>{{$data->id}}</td>
				<td>{{$data->kategori}}</td>
				<td><button class="btn btn-warning" id="btn-edit" value="{{$data->id}}"><i class="fa fa-edit"></i></button>
					<a href="/admin/kategori/hapus/{{ $data->id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Category</h4>
      </div>
      <div class="modal-body">
      	<input id="url" type="hidden" value="{{ \Request::url() }}">
      	<div class="form-group">
      		<label for="category">Category:</label>
      		<input type="text" class="form-control" id="category">
      		<input type="hidden" class="form-control" id="id">
      	</div>

      </div>
      <div class="modal-footer">
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
<script src="{{asset('js/kategori.js')}}"></script>
<script>
	$(document).ready( function () {
    $('#table').DataTable();
} );
</script>
@stop