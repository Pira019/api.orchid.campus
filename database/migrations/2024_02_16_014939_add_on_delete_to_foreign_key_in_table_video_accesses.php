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
            $table->dropForeign(['extra_tutorial_id']);
            $table->foreign('extra_tutorial_id')->on('extra_tutorials')->references('id')->onDelete('cascade');
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
            $table->dropForeign(['extra_tutorial_id']);
            // Add a new foreign key constraint without ON DELETE CASCADE
            $ $table->foreign('extra_tutorial_id')->on('extra_tutorials')->references('id');
        });
    }
};
