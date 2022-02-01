<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('term_id')->constrained()->onUpdate('cascade');
            $table->foreignId('seller_id')->constrained()->onUpdate('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('address');
            $table->string('email');
            $table->string('phone');
            $table->decimal('max_credit', $precision = 19, $scale = 2);
            $table->string('identification_type');
            $table->string('identification_number')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
}
