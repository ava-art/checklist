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
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name', 40);
            $table->string('color', 20);
            $table->string('name_en', 40);
            $table->string('image', 100)->nullable();
            $table->string('transmissia', 20);
            $table->string('koleso', 10);
            $table->string('rama', 50);
            $table->integer('go');
            $table->string('repair')->nullable();
            $table->string('shield')->nullable();
            $table->integer('sort');
            $table->integer('qr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elements');
    }
};
