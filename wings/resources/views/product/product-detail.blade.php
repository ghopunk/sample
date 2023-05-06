@extends('product.product')

@section('title')
@if( isset($item) )
	{{ $item->product_name }} Detail
@else
	404 Not Found
@endif
@endsection

@section('product-content')
@if( isset($item) )
<h2 class="text-center mb-3">{{ $item->product_name }}</h2>
<div class="container">
	<div class="row">
		<div class="col-md-4 bg-primary rounded-1 d-flex text-center">
			<div class="align-self-center w-100">Gambar</div>
		</div>
		<div class="col-md-8">
		@if( $item->price > $item->discount_price )
			<div>
				<span class="text-decoration-line-through text-danger">{{ $item->price_currency }}</span>
				<span class="ms-1">(-{{ $item->discount }}%)</span>
			</div>
			<div>{{ $item->discount_price_currency }}</div>
		@else
			<div>{{ $item->price_currency }}</div>
		@endif
			<div>Dimesion: {{ $item->dimension }}</div>
			<div>Price Unit: {{ $item->unit }}</div>
		</div>
		<div class="col-md-12 mt-4 text-center">
			<form action="{{ route('product_checkout') }}" method="post">
			@csrf
				<input type="hidden" name="product_code" value="{{ $item->product_code }}">
				<input type="hidden" name="quantity" value="1">
				<a class="btn btn-success" href="{{ route('product') }}" style="min-width: 100px;">Kembali</a>
				<button type="submit" class="btn btn-warning" style="min-width: 100px;">Buy</button>
			</form>
		</div>
	</div>
</div>
@endif
@endsection