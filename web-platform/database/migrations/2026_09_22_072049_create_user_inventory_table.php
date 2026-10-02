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
        Schema::create('user_inventory', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('asset_id');
            $table->integer('asset_type');
            $table->timestamp('obtained_at');
            $table->integer('serial_number')->nullable();
            $table->text('guid')->nullable();
            $table->bigIncrements('id');
            $table->boolean('is_locked')->default(false);

            $table->unique(['asset_id', 'serial_number'], 'user_inventory_asset_serial_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_inventory');
    }
};
