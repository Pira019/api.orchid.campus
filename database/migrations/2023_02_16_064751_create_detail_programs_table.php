<?php

use App\Models\Program;
use App\Models\University;
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
        Schema::create('detail_programs', function (Blueprint $table) {
            $table->id();
            $table->integer('nbrCredit');
            $table->integer('cycle');
            $table->string('duration');
            $table->string('admissionScheme');
            $table->string('languages');
            $table->foreignIdFor(Program::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(University::class)->constrained();
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
        Schema::dropIfExists('detail_programs');
    }
};
