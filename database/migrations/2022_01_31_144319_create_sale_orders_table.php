<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade');
            $table->foreignId('seller_id')->constrained()->onUpdate('cascade');
            $table->foreignId('warehouse_id')->constrained()->onUpdate('cascade');
            $table->foreignId('term_id')->constrained()->onUpdate('cascade');
            $table->date('date');
            $table->string('terms');
            $table->decimal('total', $precision = 19, $scale = 2);
            $table->string('sale_order_number');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_orders');
    }
}
