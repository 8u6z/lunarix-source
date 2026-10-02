<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 50);
            $table->text('password');
            $table->smallInteger('status')->default(1);
            $table->timestamp('created_at')->default(DB::raw("now()"));
            $table->text('description')->nullable();
            $table->text('blurb')->nullable();
            $table->date('birth_date')->nullable();
            $table->bigInteger('moons')->default(0);
            $table->boolean('is_kattus');
            $table->boolean('is_verified');
            $table->timestamp('updated_at')->nullable();
            $table->rememberToken();
            $table->text('gender')->nullable();
            $table->timestamp('last_reward_time')->nullable();
            $table->bigInteger('discord_id')->nullable()->unique();
            $table->smallInteger('membership')->default(0);
            $table->integer('roleset')->default(0);
            $table->timestamp('last_activity')->nullable();
            $table->integer('place_id')->nullable();
            $table->integer('universe_id')->nullable();
            $table->string('discord_username')->nullable();
            $table->smallInteger('discord_membership')->default(0);
            $table->json('ip_hashes')->nullable();
            $table->bigInteger('knockout')->default(0);
            $table->bigInteger('wipeout')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
