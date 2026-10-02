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
        Schema::table('datastores', function (Blueprint $table) {
            $table->foreign(['universe_id'], 'datastores_universe_id_fkey')->references(['id'])->on('universes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datastores', function (Blueprint $table) {
            $table->dropForeign('datastores_universe_id_fkey');
        });
    }
};
