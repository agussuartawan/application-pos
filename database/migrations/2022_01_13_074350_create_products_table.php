<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id');
            $table->foreignId('group_id');
            $table->foreignId('unit_id');
            $table->foreignId('warehouse_id');
            $table->string('code');
            $table->string('name');
            $table->string('slug');
            $table->integer('size');
            $table->decimal('purchase_price', $precision = 19, $scale = 2);
            $table->decimal('selling_price', $precision = 19, $scale = 2);
            $table->integer('stock');
            $table->integer('min_stock');
            $table->integer('max_stock');
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
