@extends('layouts.app')

@section('content')
<div class="profile-page">
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	{{-- <div class="flash-message">
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
		@if(Session::has('alert-' . $msg))

		<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		@endif
		@endforeach
	</div> --}}

	<div class="row">
		<div class="col-md-4">
			<ul class="setting-lists">
				<a href="#profile"><li>Profile</li></a>
				<a href="#" class="mymodal" data-target="modal-clues" data-header="Detail Soal" data-body="{{ url('password') }}"><li>Rubah Password</li></a>
				<a href="{{ url('user') }}"><li>Kembali</li></a>
				<div class="divider"></div>
				<a href="{{ url('logout') }}"><li>Keluar</li></a>
			</ul>
		</div>
		<div class="col-md-8">
			<div class="setting-content">
				<h3 id="profile"><strong>Profile</strong></h3>
				<form action="{{ url('user/updateprofile') }}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_method" value="put" />
					<div class="text-center">
						{{ csrf_field() }}
						<script type="text/javascript">
							function readURL(input) {
								if (input.files && input.files[0]) {
									var reader = new FileReader();
									reader.onload = function (e) {
										$('#blah').attr('src', e.target.result);
									}
									reader.readAsDataURL(input.files[0]);
								}
							}
						</script>

						<div class="circle" style="height: 100px; width: 100px; overflow: hidden; margin: auto;">
							<img class="responsive-img" id="blah" src="{{ Auth::user()->avatar == '' ? asset('images/default_pic.png') : asset('storage/avatar/'.Auth::user()->avatar.'') }}" alt=""/>
						</div>
						<input class="inputfile" type="file" id="img" onchange="readURL(this);" name="avatar">
						<label class="labelImg" for="img">Upload Photo</label>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<label for="name">Nama</label>
							<input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name">
						</div>
						<div class="col-md-12">
							<label for="username">Username</label>
							<input type="text" class="form-control" value="{{ Auth::user()->username }}" name="username">
						</div>
						<div class="col-md-12">
							<label for="">Email</label>
							<input type="email" class="form-control" value="{{ Auth::user()->email }}" name="email">
						</div>
						{{-- <div class="col-md-12">
							<label for="">Status</label>
							<select name="level" id="pendidikan" class="form-control">
								<option value="" disabled selected></option>
								<option value="guru">Guru</option>
								<option value="murid">Murid</option>
							</select>
						</div> --}}
						
						<div class="col-md-12">
							<label for="">Bio</label>
							<div contenteditable="true" id="biograph" style="max-width: 100%; min-height: 150px;" class="form-control">{!! Auth::user()->biography !!}
							</div>
							<textarea id="bio" type="hidden" name="biography">{!! Auth::user()->biography !!}</textarea>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 center">
							<br>
							<button type="submit" class="btn btn-default">SIMPAN</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<style>
	.profile-page{
		width: 75%;
		margin: 20px auto;
	}
	.setting-content{
		background: white;
		/*border: 1px solid rgba(0,0,0,.15);*/
		/*border-radius: 4px;*/
		padding: 13px;
	}
	.setting-lists li{
		list-style: none;
		padding: 10px;
	}


	/*styling input:file*/
	.inputfile {
		width: 0.1px;
		height: 0.1px;
		opacity: 0;
		overflow: hidden;
		position: absolute;
		z-index: -1;
	}
	/*styling inputfile label*/
	.labelImg{
		right: 0.75rem;
	}
	.inputfile + label {
		cursor: pointer;
		margin: auto;
		margin-top: 15px; /* "hand" cursor */
	}
	.setting-icon{
		position: absolute;
	}
	#bio{
		display: none;
	}
	/*.previewfoto{
		border: 1px solid #B71C1C;
		margin: 0 auto;
		border-radius: 2px;
		margin-top: 53px;
		width: 120px;
		height: 173px;
		overflow: hidden;
	}*/
</style>
<script>
	$(document).ready(function(){
		$('#biograph').keyup(function(event){
			var resulttext = $('#biograph').html();
			$('#bio').html(resulttext);
		});	
	})
</script>
@endsection