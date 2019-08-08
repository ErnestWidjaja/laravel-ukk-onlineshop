@extends('adminlte::page')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="panel panel-default">
	<div class="panel-heading"><h3>Cart</h3></div>
	<div class="panel-body">
		<div class="row">
			@foreach ($index as $data)
			<div class="col-sm-3" style="margin-bottom: 30px">
				<div class="card">
					<div class="card-body">
						<img src="{{URL::asset('/gambar/'.$data->photo)}}" style="width: 250px;height: 250px">
						<h5 class="card-title"><b>{{$data->nama_barang}}</b></h5>
						<p class="card-text">{{$data->deskripsi}}</p>
						<p class="card-text">Jumlah :{{$data->jumlah}}</p>
						<p class="card-text">Subtotal :{{$data->subtotal}}</p>
						<a href="/cart/hapus/{{ $data->id_cart }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
					</div>
				</div>
			</div>
			@endforeach
				<div class="col-sm-12">
					@if ($cek > 0)
          <form action="/cart/process">
					 <button class="btn btn-danger col-sm-12" id="btn-process">Process</button>
          </form>
					@else
					<h3 align="center">No Item</h3>
					@endif
				</div>
		</div>
	</div>
</div>
@stop

@section('js')
    <script src="{{asset('js/cart.js')}}"></script>
@stop