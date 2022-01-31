<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade');
            $table->foreignId('warehouse_id')->constrained()->onUpdate('cascade');
            $table->foreignId('term_id')->constrained()->onUpdate('cascade');
            $table->foreignId('sale_order_id')->nullable()->constrained()->onUpdate('cascade');
            $table->string('sale_number');
            $table->string('po_number')->nullable();
            $table->date('date');
            $table->date('due_date');
            $table->string('terms');
            $table->string('status');
            $table->text('customer_address')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->decimal('total', $precision = 19, $scale = 2);
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
        Schema::dropIfExists('sales');
    }
}
