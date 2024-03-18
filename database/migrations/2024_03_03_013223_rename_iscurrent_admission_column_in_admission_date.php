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
        Schema::table('admission_dates', function (Blueprint $table) {

            $table->dropColumn('cycle');
            $table->boolean('iscurrent_admission')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admission_dates', function (Blueprint $table) {
            $table->integer('cycle');


        });
    }
};
