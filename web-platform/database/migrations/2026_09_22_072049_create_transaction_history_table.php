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
        Schema::create('transaction_history', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('transaction_type_id');
            $table->smallInteger('transaction_origin_type_id');
            $table->smallInteger('currency_type_id');
            $table->integer('user_id');
            $table->bigInteger('sale_id');
            $table->bigInteger('amount');
            $table->boolean('is_processed')->default(true);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_history');
    }
};
