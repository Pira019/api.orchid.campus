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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("first_name");
            $table->string("sex",5);
            $table->integer('residence_contry')->unsigned()->nullable();
            $table->integer('citizenship')->unsigned()->nullable();
            $table->string("phone",20)->nullable();
            $table->date("birth_date");
            $table->foreign('residence_contry')->references('id')->on('countries')->onDelete('SET NULL');
            $table->foreign('citizenship')->references('id')->on('countries')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
