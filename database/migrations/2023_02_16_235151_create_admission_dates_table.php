<?php

use App\Models\DetailProgram;
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
        Schema::create('admission_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DetailProgram::class)->constrained();
            $table->integer('cycle');
            $table->string('type');
            $table->date('start_at');
            $table->date('end_at');
            $table->string('session_admission');
            $table->string('link');
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
        Schema::dropIfExists('admission_dates');
    }
};
