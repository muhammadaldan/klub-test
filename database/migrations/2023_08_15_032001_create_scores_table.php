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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club1_id');
            $table->unsignedBigInteger('club2_id');
            $table->integer('score1');
            $table->integer('score2');
            $table->timestamps();
    
            $table->foreign('club1_id')->references('id')->on('clubs');
            $table->foreign('club2_id')->references('id')->on('clubs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
