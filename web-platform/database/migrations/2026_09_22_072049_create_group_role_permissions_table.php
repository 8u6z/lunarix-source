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
        Schema::create('group_role_permissions', function (Blueprint $table) {
            $table->integer('role_id');
            $table->boolean('delete_wall_posts')->nullable()->default(false);
            $table->boolean('can_wall_post')->nullable()->default(true);
            $table->boolean('post_to_group_status')->nullable()->default(true);
            $table->boolean('kick_members')->nullable()->default(false);
            $table->boolean('ban_members')->nullable()->default(false);
            $table->boolean('view_status')->nullable()->default(true);
            $table->boolean('view_wall')->nullable()->default(true);
            $table->boolean('change_users_rank')->nullable()->default(false);
            $table->boolean('advertise')->nullable()->default(false);
            $table->boolean('manage_allies')->nullable()->default(false);
            $table->boolean('add_group_games')->nullable()->default(false);
            $table->boolean('view_group_logs')->nullable()->default(false);
            $table->boolean('create_items')->nullable()->default(false);
            $table->boolean('manage_items')->nullable()->default(false);
            $table->boolean('spend_funds')->nullable()->default(false);
            $table->boolean('manage_clan')->nullable()->default(false);
            $table->boolean('manage_group_games')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_role_permissions');
    }
};
