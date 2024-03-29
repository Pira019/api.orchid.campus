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
        Schema::table('service_disciplinaries', function (Blueprint $table) {
            $table->unique(['service_id', 'disciplinary_sector_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_disciplinaries', function (Blueprint $table) {
            $table->dropUnique(['service_id', 'disciplinary_sector_id']);
        });
    }
};
