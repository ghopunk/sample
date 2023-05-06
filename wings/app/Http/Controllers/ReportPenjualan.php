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

class ReportPenjualan extends Controller
{
    //
	public function index() {
		$data = DB::table('transaction_header as th')
		->select(
		'th.*',
		//'td.product_code',
		//'td.price',
		'td.quantity',
		'td.unit',
		//'td.sub_total',
		'td.currency',
		'p.product_name',
		)
		->join( 'transaction_detail as td', 'td.document_number', '=', 'th.document_number' )
		->join( 'product as p', 'td.product_code', '=', 'p.product_code' )
		->orderBy('th.document_number')
		->get()
		;
		
		$report = [];
		foreach($data as $key=>$val ){
			if( !isset($report[$val->document_number]) ) {
				$item = [];
				$report[$val->document_number] = [];
				$report[$val->document_number]['transaction'] = sprintf("%s %03d", $val->document_code, $val->document_number);
				$report[$val->document_number]['user'] = $val->user;
				$report[$val->document_number]['total'] = PrepareProduct::formatCurrency($val->total, $val->currency);
				$report[$val->document_number]['date'] = date('d F Y', strtotime($val->date));
				$item[] = sprintf("%s X %d %s", $val->product_name, $val->quantity, $val->unit);
			} else {
				$item[] = sprintf("%s X %d %s", $val->product_name, $val->quantity, $val->unit);
			}
			$report[$val->document_number]['item'] = implode( '<br>', $item );
			//$data[$key]->price_currency = PrepareProduct::formatCurrency($val->price, $val->currency);
			//$data[$key]->total_currency = PrepareProduct::formatCurrency($val->total, $val->currency);
			//$data[$key]->_date = date('d F Y', strtotime($val->date));
			//$data[$key]->transaction = sprintf("%s %03d", $val->document_code, $val->document_number);
		}
		return view('report')->with( 'data', $report );
	}
}
