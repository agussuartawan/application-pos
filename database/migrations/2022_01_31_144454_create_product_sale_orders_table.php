<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sale_orders', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->onUpdate('cascade');
            $table->foreignId('sale_order_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('price', $precision = 19, $scale = 2);
            $table->integer('qty')->default(0);
            $table->integer('qty_left')->default(0);
            $table->double('discount')->default(0);
            $table->decimal('subtotal', $precision = 19, $scale = 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sale_orders');
    }
}
