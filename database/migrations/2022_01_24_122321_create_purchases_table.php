<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('supplier_id')->constrained()->onUpdate('cascade');
            $table->foreignId('warehouse_id')->constrained()->onUpdate('cascade');
            $table->foreignId('term_id')->constrained()->onUpdate('cascade');
            $table->foreignId('purchase_order_id')->nullable()->constrained()->onUpdate('cascade');
            $table->string('purchase_number');
            $table->string('purchase_invoice_number')->nullable();
            $table->date('date');
            $table->date('due_date');
            $table->string('terms');
            $table->string('status');
            $table->text('supplier_address')->nullable();
            $table->string('supplier_email')->nullable();
            $table->string('supplier_phone')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
