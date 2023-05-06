<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeedProductTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('product')->insert([
		[
            'product_code' => 'SKUSKILNP',
            'product_name' => 'So klin Pewangi',
			'price' => '15000',
			'currency' => 'IDR',
			'discount' => '10',
			'dimension' => '13 cm x 10 cm',
			'unit' => 'PCS',
        ],
		[
            'product_code' => 'SKUSKILNL',
            'product_name' => 'So klin Liquid',
			'price' => '18000',
			'currency' => 'IDR',
			'discount' => '5',
			'dimension' => '8 cm x 10 cm',
			'unit' => 'PCS',
        ],
		[
            'product_code' => 'SKUGIVBR',
            'product_name' => 'Giv Biru',
			'price' => '11000',
			'currency' => 'IDR',
			'discount' => '0',
			'dimension' => '5 cm x 8 cm',
			'unit' => 'PCS',
        ],
		[
            'product_code' => 'SKUTOPKP',
            'product_name' => 'Top Coffee',
			'price' => '12000',
			'currency' => 'IDR',
			'discount' => '8',
			'dimension' => '15 cm x 10 cm',
			'unit' => 'BAG',
        ],
		]);
    }
}
