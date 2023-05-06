@extends('full')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="col-md-8 offset-md-2 mt-3 mb-3">
	@include('nav-login')
	<div class="card">
		<div class="card-body">
			<h2>Laporan Penjualan</h2>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Transaction</th>
						<th>User</th>
						<th>Total</th>
						<th>Date</th>
						<th>Item</th>
					</tr>
				</thead>
				<tbody>
				@if ( count($data) > 0 )
				@foreach ($data as $key=>$item)
					<tr>
						<td>{{ $item['transaction'] }}</td>
						<td>{{ $item['user'] }}</td>
						<td>{{ $item['total'] }}</td>
						<td>{{ $item['date'] }}</td>
						<td>{!! $item['item'] !!}</td>
					</tr>
				@endforeach
				@else
					<tr>
						<td colspan="5">Report Data masih belum tersedia</td>
					</tr>
				@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
