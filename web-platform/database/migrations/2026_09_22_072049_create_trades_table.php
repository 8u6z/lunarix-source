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
        Schema::create('trades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sender_id');
            $table->bigInteger('receiver_id');
            $table->text('status');
            $table->bigInteger('sender_robux')->default(0);
            $table->bigInteger('receiver_robux')->default(0);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
