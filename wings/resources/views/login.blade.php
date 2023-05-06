@extends('full')

@section('title', 'Login')

@section('content')
<div class="col-md-4 offset-md-4 mt-3">
@if(count($errors) > 0)
	@foreach( $errors->all() as $message )
	<div class="alert alert-danger">{{ $message }}</div>
	@endforeach
@endif
	<div class="card">
		<div class="card-body">
			<h2 class="text-center mt-3 mb-5">LOGIN</h2>
			<form action="{{ route('actionlogin') }}" method="post">
				@csrf
				<input type="hidden" name="redirect" value="{{request()->input('redirect')}}">
				<div class="mb-3">
					<input type="text" name="user" class="form-control" placeholder="Username" required>
				</div>
				<div class="mb-3">
					<input type="password" name="password" class="form-control" placeholder="Password" required>
				</div>
				<div class="text-center mb-3">
					<a class="btn btn-warning" href="{{ route('product') }}" style="min-width: 100px;">Kembali</a>
					<button type="submit" class="btn btn-primary" style="min-width: 100px;">LOGIN</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection