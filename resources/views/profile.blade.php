@extends('adminlte::page')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="panel panel-default">
	<div class="panel-heading"><h3>My Profile</h3></div>
	<div class="panel-body">
		<div class="container" style="float: left">
			<div class="row">
				<div class="col-md-3">
					<img class="img-circle" src="{{URL::asset('/gambar/'.Auth::user()->photo)}}" style="width: 250px;height: 250px">
				</div>
				<div class="col-md-6">
					<h1>{{Auth::user()->name}}</h1>
					<div class="form-group">
						<p><b>Gender : </b>{{Auth::user()->jk}}</p>
						<p><b>Email : </b>{{Auth::user()->email}}</p>
						<p><b>Phone Number : </b>{{Auth::user()->no_tlp}}</p>
						<p><b>Address : </b>{{Auth::user()->alamat}}</p><br>
						<button class="btn btn-primary" id="btn-edit">Edit</button>
					</div>
				</div>
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
        <h4 class="modal-title">Edit Profile</h4>
      </div>
      <div class="modal-body">
      	<input id="url" type="hidden" value="{{ \Request::url() }}">
      	<input id="id" type="hidden" value="{{Auth::user()->id}}">
      	<div class="form-group">
      		<label for="photo">Photo Profile:</label><br>
      		<img id="preview" class="img-circle" width="100" height="100" />
    		<input type="file" id="photo" name="photo" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
      	</div>
      	<div class="form-group">
      		<label for="name">Name:</label>
      		<input type="text" class="form-control" id="name">
      	</div>
      	<div class="form-group">
      		<label for="gender">Gender:</label>
      		<select id="gender" class="form-control">
      			<option value="Male">Male</option>
      			<option value="Female">Female</option>
      		</select>
      	</div>
      	<div class="form-group">
      		<label for="email">Email:</label>
      		<input type="email" class="form-control" id="email">
      	</div>
      	<div class="form-group">
      		<label for="phone">Phone Number:</label>
      		<input type="number" class="form-control" id="phone">
      	</div>
      	<div class="form-group">
      		<label for="address">Address:</label>
      		<textarea class="form-control" id="address" style="resize: vertical;"></textarea>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-save" data-dismiss="modal">Save</button>
      </div>
    </div>

  </div>
</div>
@stop

@section('js')
    <script src="{{asset('js/profile.js')}}"></script>
@stop