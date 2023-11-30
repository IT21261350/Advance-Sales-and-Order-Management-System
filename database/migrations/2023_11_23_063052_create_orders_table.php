<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('orderCode');
            $table->String('cName');
            $table->String('pProduct');
            $table->date('order_date');
            $table->time('order_time');
            $table->integer('price');
            $table->integer('discountLimit');
            $table->integer('discount');
            $table->integer('quantity');
            $table->integer('freeQty');
            $table->integer('totalAmt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
