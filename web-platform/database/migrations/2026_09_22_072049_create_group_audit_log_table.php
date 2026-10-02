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
        Schema::create('group_audit_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('user_id');
            $table->string('action');
            $table->integer('new_owner_user_id')->nullable();
            $table->integer('old_role_rank')->nullable();
            $table->integer('new_role_rank')->nullable();
            $table->string('old_group_name')->nullable();
            $table->string('new_group_name')->nullable();
            $table->string('old_group_desc', 1255)->nullable();
            $table->string('new_group_desc', 1255)->nullable();
            $table->string('post_desc', 1000)->nullable();
            $table->integer('post_user_id')->nullable();
            $table->integer('new_clan_member_user_id')->nullable();
            $table->integer('kicked_clan_member_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_audit_log');
    }
};
