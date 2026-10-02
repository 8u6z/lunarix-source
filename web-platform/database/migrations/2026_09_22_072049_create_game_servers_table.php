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
        Schema::create('game_servers', function (Blueprint $table) {
            $table->integer('asset_id');
            $table->integer('universe_id');
            $table->integer('port');
            $table->integer('soap_port');
            $table->text('job_id');
            $table->integer('status')->default(2);
            $table->timestamp('created_at');
            $table->text('ip_address')->default('127.0.0.1');
            $table->integer('capacity');
            $table->integer('ping')->nullable();
            $table->integer('fps')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_servers');
    }
};
