<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_detail', function (Blueprint $table) {
            //$table->id();
			$table->string( 'document_code', 3 );
			$table->integer( 'document_number' );
			$table->string( 'product_code', 18 );
			$table->integer( 'price' );
			$table->integer( 'quantity' )->unsigned();
			$table->string( 'unit', 5 );
			$table->integer( 'sub_total' );
			$table->string( 'currency', 5 );
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
        Schema::dropIfExists('transaction_detail');
    }
}
