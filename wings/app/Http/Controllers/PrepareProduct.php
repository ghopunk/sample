<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NumberFormatter;

class PrepareProduct extends Controller
{
    //
	function formatCurrency($price, $currency) {
		$fmt = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
		$fmt->setTextAttribute(NumberFormatter::CURRENCY_CODE, $currency);
		$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
		return $fmt->formatCurrency($price, $currency);
	}
	function prepareItem($item) {
		if( !empty($item) ){
			$discount_price = $item->price;
			if( !empty($item->discount) ) {
				$discount_price = $item->price - ( $item->price * $item->discount / 100 );
			}
			$item->discount_price = $discount_price;
			$item->price_currency = self::formatCurrency($item->price, $item->currency);
			$item->discount_price_currency = self::formatCurrency($item->discount_price, $item->currency);
		}
		return $item;
	}
	
}
