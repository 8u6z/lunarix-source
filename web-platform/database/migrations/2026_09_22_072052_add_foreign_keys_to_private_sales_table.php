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
        Schema::table('private_sales', function (Blueprint $table) {
            $table->foreign(['asset_id'], 'private_sales_asset_id_fkey')->references(['id'])->on('assets')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'private_sales_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('private_sales', function (Blueprint $table) {
            $table->dropForeign('private_sales_asset_id_fkey');
            $table->dropForeign('private_sales_user_id_fkey');
        });
    }
};
