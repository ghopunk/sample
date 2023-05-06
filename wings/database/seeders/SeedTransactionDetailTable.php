<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeedTransactionDetailTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('transaction_detail')->insert(
		[
            'document_code' => 'TRX',
			'document_number'	=> 1,
			'product_code' => 'SKUTOPKP',
			'price' => '12000',
			'quantity' => '6',
			'unit' => 'BAG',
			'sub_total' => '72000',
			'currency' => 'IDR',
        ]
		);
    }
}
