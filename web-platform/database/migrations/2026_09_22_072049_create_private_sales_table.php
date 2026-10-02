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
        Schema::create('private_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('asset_id');
            $table->text('guid');
            $table->integer('serial')->nullable();
            $table->integer('price');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_sales');
    }
};
