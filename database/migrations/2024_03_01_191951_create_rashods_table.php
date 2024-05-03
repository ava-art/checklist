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
        Schema::create('rashods', function (Blueprint $table) {
            $table->id();
            $table->string('who_add');
            $table->string('what')->nullable(true);
            $table->integer('sum');
            $table->time('time');
            $table->date('date');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rashods');
    }
};
