<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            //$table->id();
			$table->string( 'product_code', 18 )->unique();
			$table->string( 'product_name', 30 );
			$table->integer( 'price' );
			$table->string( 'currency', 5 );
			$table->integer( 'discount' );
			$table->string( 'dimension', 50 );
			$table->string( 'unit', 5 );
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
