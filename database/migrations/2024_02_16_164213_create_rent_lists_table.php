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
        Schema::create('rent_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('element_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->string('comment_start','140');
            $table->string('comment_stop','140');
            $table->string('sposob_pay_start','10');
            $table->string('sposob_pay_stop','10');
            $table->string('time_rent','10');
            $table->string('time_drive','10');
            $table->string('status','6')->default('D');
            $table->string('who_start','20');
            $table->string('who_stop','20');
            $table->time('time_start');
            $table->time('time_stop');
            $table->time('pause_start');
            $table->time('pause_stop');
            $table->time('time_update');
            $table->date('date_start');
            $table->date('date_stop');
            $table->integer('money_full_drive');
            $table->integer('money_pay_start')->default(0);
            $table->integer('money_pay_stop')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_lists');
    }
};
