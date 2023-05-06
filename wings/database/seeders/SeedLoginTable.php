<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SeedLoginTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('login')->insert([
		[
            'user' => 'admin',
            'password' => 'password',
			//'password' => Hash::make('password'),
        ],
		[
            'user' => 'Jhony',
            'password' => 'password',
			//'password' => Hash::make('password2'),
        ],
		[
            'user' => 'Susan',
            'password' => 'password',
			//'password' => Hash::make('password2'),
        ],
		[
            'user' => 'Budi Santoso',
            'password' => 'password',
			//'password' => Hash::make('password2'),
        ]
		]);
    }
}
