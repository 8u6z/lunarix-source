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
        Schema::create('group_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->string('role_name');
            $table->text('description')->nullable();
            $table->integer('rank');
            $table->integer('member_count')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_roles');
    }
};
