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
        Schema::table('product_transactions', function (Blueprint $table) {
            $table->string('code')->after('user_id');
            $table->integer('point')->after('total_amount')->nullable();
            $table->string('type')->after('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_transactions', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('point');
            $table->dropColumn('type');
        });
    }
};
