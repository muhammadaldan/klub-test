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
        Schema::table('clubs', function (Blueprint $table) {
            $table->integer('main')->after('kota_klub')->default(0);
            $table->integer('menang')->after('main')->default(0);
            $table->integer('seri')->after('menang')->default(0);
            $table->integer('kalah')->after('seri')->default(0);
            $table->integer('goal_menang')->after('kalah')->default(0);
            $table->integer('goal_kalah')->after('goal_menang')->default(0);
            $table->integer('point')->after('goal_kalah')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clubs', function (Blueprint $table) {
            $table->dropColumn('point');
        });
    }
};
