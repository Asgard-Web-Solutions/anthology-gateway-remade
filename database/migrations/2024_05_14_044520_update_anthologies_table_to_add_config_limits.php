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
        Schema::table('anthologies', function (Blueprint $table) {
            $table->string('subscription_tier')->default('silver');
            $table->integer('limit_team')->default(0);
            $table->integer('limit_open_days')->default(0);
            $table->integer('remaining_open_days')->default(0);
            $table->integer('data_retention')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anthologies', function (Blueprint $table) {
            $table->dropColumn('subscription_tier');
            $table->dropColumn('limit_team');
            $table->dropColumn('limit_open_days');
            $table->dropColumn('remaining_open_days');
            $table->dropColumn('data_retention');
        });
    }
};
