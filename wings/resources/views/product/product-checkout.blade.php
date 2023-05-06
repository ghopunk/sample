@extends('product.product')

@section('title')
@if( isset($item) )
	Product Checkout
@else
	404 Not Found
@endif
@endsection

@section('header')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
@endsection

@section('product-content')
@if( $carts )
<form action="{{ route('product_confirm') }}" method="post">
	@csrf
	@foreach ($carts as $key=>$item)
	<div class="container 
	@if( $key < count($carts)-1 )
		mb-4
	@endif
	">
		<div class="row">
			<div class="col-md-4 bg-primary rounded-1 d-flex text-center">
				<div class="align-self-center w-100">Gambar</div>
			</div>
			<div class="col-md-6">
				<h4 class="mb-3">{{ $item['product_name'] }}</h4>
				<div class="input-group mb-3">
					<input data-code="{{ $item['product_code'] }}" type="number" min="0" name="quantity[{{ $key }}]" class="quantity form-control" value="{{ $item['quantity'] }}">
					<span class="input-group-text">{{ $item['unit'] }}</span>
				</div>
				<div>Sub Total: <span data-code="{{ $item['product_code'] }}" class="sub_total">{{ $item['sub_total_currency'] }}</span></div>
			</div>
		</div>
	</div>
	@endforeach
	<div class="text-center mt-4 border border-2 p-2">
		Total: <span class="total fw-bold">{{ $total_currency }}</span>
	</div>
	<div class="text-center mt-4">
		<a class="btn btn-success" href="{{ route('product') }}" style="min-width: 100px;">Pilih Lagi</a>
		<button type="submit" class="btn btn-warning" style="min-width: 100px;">Confirm</button>
	</div>
</form>
@else
<div class="alert alert-info">{{ session()->get('error') ? session()->get('error') : 'Keranjang Anda Kosong' }}</div>
<div class="text-center"><a class="btn btn-success" href="{{ route('product') }}">Cari Produk</a></div>
@endif
@endsection

@section('footer')
<script>
$('.quantity ').on('change', function() {
	var code = $(this).data('code');
	$.ajax({
		url: "{{ url('/api/carts') }}",
		type: "POST",
		data: { product_code: code, quantity: $(this).val() },
		success: function(c){
			$('.sub_total[data-code="'+code+'"]').html(c.sub_total);
			$('.total').html(c.total);
		},
		error: function (xhr, error, thrownError) {
			var msg = xhr.responseText ? xhr.responseText : thrownError;
			if( err = JSON.parse(msg) ) {
				msg = err;
			}
			msg = ( msg.message ) ? msg.message : 'Ada yang salah';
			alert(msg);
		}
	});
})
</script>
@endsection
