@extends('full')

@section('content')
<div class="col-md-6 offset-md-3 mt-3 mb-3">
	@include('nav-login')
	<div class="card">
		<div class="card-body">
		@if( isset($error) )
			<div class="alert alert-danger">{{ $error }}</div>
			<a class="btn btn-warning" href="{{ route('product') }}" style="min-width: 100px;">Kembali</a>
		@endif
		@yield('product-content')
		</div>
	</div>
</div>
@endsection