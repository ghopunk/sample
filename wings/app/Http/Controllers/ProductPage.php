<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;
use App\Http\Controllers\PrepareProduct;
use Cookie;

class ProductPage extends Controller
{
    //
	public function index() {
		$product   = Product::all();
		if( $product->isEmpty() ) {
			return view('product.product-list')->with( 'error', 'Maaf, List Product Masih Kosong' );
		} else {
			$carts = $this->getCarts();
			foreach($product as $key=>$val ){
				$product[$key] = PrepareProduct::prepareItem($val);
				if ($carts && array_key_exists($val->product_code, $carts)) {
					$product[$key]->quantity = $carts[$val->product_code]['quantity'];
				}
			}
			return view('product.product-list')->with( 'product', $product );
		}
	}
	
	public function detail($product_code=false) {
		if( $product_code ) {
			//$product = DB::table('product')->where(['product_code' => $product_code])->first();
			$product = Product::find($product_code);
			if( empty($product) ) {
				return view('product.product-detail')->with( 'error', 'Maaf, Produk yang anda cari Tidak di temukan' );
			} else {
				return view('product.product-detail')->with( 'item', PrepareProduct::prepareItem($product) );
			}
		}
		return redirect( route('product') );
	}
	
	private function getCarts()
    {
        $carts = json_decode(request()->cookie('gcharts'), true);
        $carts = !empty($carts) ? $carts : [];
        return $carts;
    }
	
	public function addToCart(Request $request)
    {
		$this->validate($request, [
            'product_code' => 'required|string',
            'quantity' => 'required|integer'
        ]);

        $carts = $this->getCarts();
        if ($carts && array_key_exists($request->product_code, $carts)) {
            $carts[$request->product_code]['quantity'] += $request->quantity;
			$sub_total = $carts[$request->product_code]['quantity'] * $carts[$request->product_code]['price'];
			$carts[$request->product_code]['sub_total'] = $sub_total;
			$carts[$request->product_code]['sub_total_currency'] = PrepareProduct::formatCurrency( $sub_total, $carts[$request->product_code]['currency'] );
        } else {
            $product = Product::find($request->product_code);
			if( !empty($product) ) {
				$product = PrepareProduct::prepareItem($product);
				$sub_total = $request->quantity * $product->discount_price;
				$carts[$request->product_code] = [
					'quantity' 		=> $request->quantity,
					'product_code' 	=> $product->product_code,
					'product_name' 	=> $product->product_name,
					'price' 		=> $product->discount_price,
					'price_currency'	=> $product->discount_price_currency,
					'sub_total' 	=> $sub_total,
					'sub_total_currency'	=> PrepareProduct::formatCurrency( $sub_total, $product->currency ),
					'unit' 			=> $product->unit,
					'currency' 		=> $product->currency,
				];
			}
        }
        $cookie = cookie( 'gcharts', json_encode($carts), 3600);
        return redirect( route('product_checkout') )->cookie($cookie);
    }
	
	public function checkout($product_code=false) {
		$carts = $this->getCarts();
		if( !empty($carts) ) {
			$total = collect($carts)->sum('sub_total');
			$first = collect($carts)->firstWhere('currency');
			$total_currency = PrepareProduct::formatCurrency( $total, $first['currency'] );
			return view('product.product-checkout')->with( compact('carts', 'total', 'total_currency') );
		}
		return view('product.product-checkout')->with( 'carts', false );
	}
	
	public function confirm(Request $request) {
		$userdata 	= Auth::guard('login')->user();
		$user 		= $userdata->user;
		$carts 		= $this->getCarts();
		if( collect($carts)->isNotEmpty() ) {
			$total = collect($carts)->sum('sub_total');
			$th = TransactionHeader::create([
				'document_code' => 'TRX',
				'user' 			=> $user,
				'total' 		=> $total,
				'date'			=> date('Y-m-d'),
			]);
			if( !empty($th->document_number) ) {
				$add = ['document_code'=>$th->document_code, 'document_number'=>$th->document_number];
				collect($carts)->each( function ($item, $key) use($add) {
					unset($item['product_name']);
					unset($item['sub_total_currency']);
					unset($item['price_currency']);
					$item = array_merge($item, $add);
					$td = TransactionDetail::create($item);
				});
				Cookie::queue(Cookie::forget('gcharts'));
				$date	= date( 'd F Y', strtotime($th->date) );
				$first	= collect($carts)->firstWhere('currency');
				$total_currency = PrepareProduct::formatCurrency( $total, $first['currency'] );
				return view('product.product-confirm')->with( compact('carts', 'date', 'total', 'total_currency') );
			} else {
				return redirect( route('product_checkout') )->with( 'error', 'Maaf, Ada keslahan dalam, memproses pemeblian anda. SIlahkan di ulangi lagi.' );
			}
		} else {
			Cookie::queue(Cookie::forget('gcharts'));
			return redirect( route('product_checkout') )->with( 'error', 'Maaf, Keranjang Belanja Anda Masih Kosong' );
		}
	}
	
	public function updateCarts(Request $request) {
		$this->validate($request, [
            'product_code' => 'required|string',
            'quantity' => 'required|integer'
        ]);
		$product = Product::find($request->product_code);
		if( !empty($product) ) {
			$carts 	= $this->getCarts();
			$product = PrepareProduct::prepareItem($product);
			$sub_total = $request->quantity * $product->discount_price;
			$carts[$request->product_code] = [
				'quantity' 		=> $request->quantity,
				'product_code' 	=> $product->product_code,
				'product_name' 	=> $product->product_name,
				'price' 		=> $product->discount_price,
				'price_currency'	=> $product->discount_price_currency,
				'sub_total' 	=> $sub_total,
				'sub_total_currency'	=> PrepareProduct::formatCurrency( $sub_total, $product->currency ),
				'unit' 			=> $product->unit,
				'currency' 		=> $product->currency,
			];
			$sub_total = $carts[$request->product_code]['sub_total_currency'];
			$total = collect($carts)->sum('sub_total');
			$first = collect($carts)->firstWhere('currency');
			$total_currency = isset($first['currency']) ? PrepareProduct::formatCurrency( $total, $first['currency'] ) : $total;
			if( empty($request->quantity) ) {
				unset($carts[$request->product_code]);
			}
			$cookie = cookie( 'gcharts', json_encode($carts), 3600);
			return response()->json( [ 'sub_total'=>$sub_total, 'total'=>$total_currency ] )->cookie($cookie);
		} else {
			return response()->json(['message' => 'Produk Tidak Ditemukan'],404);
		}
	}
}
