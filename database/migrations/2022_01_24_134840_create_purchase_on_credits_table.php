<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOnCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_on_credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('total_credit', $precision = 19, $scale = 2);
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
        Schema::dropIfExists('purchase_on_credits');
    }
}
