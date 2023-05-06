<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeedTransactionHeaderTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('transaction_header')->insert(
		[
            'document_code' => 'TRX',
			'user' => 'ghopunk',
			'total' => '72000',
			'date' => date('Y-m-d')
        ]
		);
    }
}
