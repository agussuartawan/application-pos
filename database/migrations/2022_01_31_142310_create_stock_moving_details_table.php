<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_moving_details', function (Blueprint $table) {
            $table->foreignId('stock_moving_id')->constrained()->onUpdate('cascade');
            $table->foreignId('stock_id')->constrained()->onUpdate('cascade');
            $table->integer('qty')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_moving_details');
    }
}
