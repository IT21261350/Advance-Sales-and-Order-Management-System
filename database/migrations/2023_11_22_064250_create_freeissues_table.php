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
        Schema::create('freeissues', function (Blueprint $table) {
            $table->id();
            $table->String('fIssue');
            $table->String('type');
            $table->String('pro');
            $table->String('fPro');
            $table->integer('pQuan');
            $table->String('fQuan');
            $table->integer('lLimit');
            $table->integer('uLimit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freeissues');
    }
};
