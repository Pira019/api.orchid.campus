<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_accesses', function (Blueprint $table) {
            $table->unique(['extra_tutorial_id', 'user_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_accesses', function (Blueprint $table) {
            $table->dropUnique(['extra_tutorial_id', 'user_name']);
        });
    }
};
