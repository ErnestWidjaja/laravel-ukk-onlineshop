@extends('adminlte::page')

@section('content')
<link rel="shortcut icon" href="{{ asset('gambar/shutdown.jpg') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

@if (Auth::user()->role=='Administrator')
<ul class="nav nav-tabs nav-justified">
  <li class="active"><a href="/home">Home</a></li>
  <li><a href="/admin/kategori">Category</a></li>
  <li><a href="/admin/barang">Item</a></li>
  <li><a href="/admin/laporan">Report</a></li>
</ul>
@endif

<div class="panel panel-default">
	<div class="panel-heading">
    <div class="row">
      <div class="col-sm-3">
        <h3>Item</h3>
      </div>
      <div class="col-sm-9">
        <form action="/home">
          <div class="row">
            <div class="col-sm-6">
              <input class="form-control" type="text" placeholder="Search" aria-label="Search" style="margin-top: 10px" name="search" id="search">
            </div>
            <div class="col-sm-3">
              <select class="form-control" name="kat" style="margin-top: 10px;margin-left: -30px">
                <option value="">All</option>
                @foreach($kategori as $k)
                <option value="{{$k->id}}">{{$k->kategori}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-3">
              <button class="btn btn-danger" style="margin-top: 11px;margin-left: -60px;height: 31px"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div> 
  </div>
	<div class="panel-body">
		<div class="row">
			@foreach ($index as $data)
			<div class="col-sm-3" style="margin-bottom: 30px">
				<div class="card">
					<div class="card-body">
						<img class="img" src="{{URL::asset('/gambar/'.$data->foto)}}" style="width: 250px;height: 250px">
						<h5 class="card-title"><b>{{$data->nama_barang}}</b></h5>
						<p class="card-text">{{$data->deskripsi}}</p>
						<button class="btn btn-danger" id="btn-detail" value="{{$data->id}}">Detail</button>
					</div>
				</div>
			</div>
			@endforeach
      <div class="col-sm-12">
          @if ($cek == 0)
            <h3 align="center">No Item</h3>
          @endif
        </div>
		</div>
	</div>
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
      	<div class="card mb-3" style="max-width: 540px;">
      		<div class="row no-gutters">
      			<div class="col-md-8">
      				<div class="card-body">
      					<h5 class="card-title"><div id="nama" /></h5>
      					<p class="card-text"><div id="deskripsi" /></p>
      				</div>
      			</div>
            <h4 class="modal-title" style="float: left"><div id="stock" /></h4>
      		</div>
      	</div>	
      </div>
      <div class="modal-footer">
      	<input type="number" id="jumlah" name="jumlah" min="1" value="1" style="float: left;width: 50px;font-size: 16px;margin-top: 6px;margin-left: -15px;margin-right: 10px"><h4 class="modal-title" style="float: left"><div id="harga" /></h4>
        <button type="button" class="btn btn-danger" id="btn-save" data-dismiss="modal"><i class="fa fa-shopping-cart"></i></button>
        <div hidden id="id_barang" />
      </div>
    </div>

  </div>
</div>
@stop

@section('js')
    <script src="{{asset('js/home.js')}}"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop