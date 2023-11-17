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
        Schema::table('detail_programs', function (Blueprint $table) {
            $table->unique(['cycle', 'university_id','program_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_program', function (Blueprint $table) {
            $table->dropUnique(['cycle', 'university_id','program_id']);
        });
    }
};
