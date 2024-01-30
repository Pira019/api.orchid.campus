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

            Schema::table('user_video_keys', function (Blueprint $table) {
                $table->dropColumn(['user_id']);
                $table->string('user_name', 255)->index(); ;
                $table->foreign('user_name')->references('user_name')->on('users');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_video_keys', function (Blueprint $table) {
            $table->dropColumn(['user_id']);
            $table->string('user_id', 255)->index(); ;
            $table->foreign('user_name')->references('user_name')->on('users');
        });
    }
};
