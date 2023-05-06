@extends('product.product')

@section('title', 'Thank You')

@section('product-content')
<div class="card">
	<div class="card-body">
		<div class="alert alert-info">Terima Kasih. Berikut Rician Belanjaan Anda.</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Tanggal</th>
					<th>Item</th>
					<th>Jumlah</th>
					<th>Harga</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($carts as $key=>$item)
				<tr>
					<td>{{ $date }}</td>
					<td>{{ $item['product_name'] }}</td>
					<td>{{ $item['quantity'] }} {{ $item['unit'] }}</td>
					<td>{{ $item['price_currency'] }}</td>
					<td>{{ $item['sub_total_currency'] }}</td>
				</tr>
			@endforeach
				<tr>
					<td colspan="4" class="text-end fw-bold">Total</td>
					<td class="fw-bold">{{ $total_currency }}</td>
				</tr>
			</tbody>
		</table>
		<div class="text-center mt-4">
			<a class="btn btn-success" href="{{ route('product') }}" style="min-width: 100px;">Lanjutkan</a>
		</div>
	</div>
</div>
@endsection