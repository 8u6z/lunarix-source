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
        Schema::create('user_privacy', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('ChatPrivacy')->default(0);
            $table->integer('GuestMode')->default(0);
            $table->integer('PrivateMessagePrivacy')->default(1);
            $table->integer('FollowMePrivacy')->default(2);
            $table->integer('FriendMePrivacy')->default(2);
            $table->boolean('discord_notifications')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_privacy');
    }
};
