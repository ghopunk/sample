@extends('product.product')

@section('title', 'Product List')

@section('product-content')
@if( isset($product) )
@foreach ($product as $key=>$item)
<div class="container 
	@if( $key < count($product)-1 )
		mb-4
	@endif
	">
	<div class="row">
		<div class="col-md-3 bg-primary rounded-1 d-flex text-center">
			<div class="align-self-center w-100">Gambar</div>
		</div>
		<div class="col-md-6">
			<h4>{{ $item->product_name }}</h4>
		@if( $item->price > $item->discount_price )
			<div>
				<span class="text-decoration-line-through text-danger">{{ $item->price_currency }}</span>
				<span class="ms-1">(-{{ $item->discount }}%)</span>
			</div>
			<div>{{ $item->discount_price_currency }}</div>
		@else
			<div>{{ $item->price_currency }}</div>
		@endif
		</div>
		<div class="col-md-3 d-flex">
			<div class="align-self-center">
				<a class="btn btn-success position-relative" href="{{ route('product_detail',$item->product_code) }}" style="min-width: 100px;">
					Detail 
					@if( $item->quantity )
						<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $item->quantity }}</span>
					@endif
				</a>
			</div>
		</div>
	</div>
</div>
@endforeach
<div class="text-center mt-4">
	<a class="btn btn-warning" href="{{ route('product_checkout') }}" style="min-width: 100px;">Chekout</a>
</div>
@endif
@endsection