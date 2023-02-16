<?php

use App\Models\Tutorial;
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
        Schema::create('extra_tutorials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tutorial::class)->constrained();
            $table->string('link')->nullable();
            $table->string('link_video')->nullable();
            $table->text('commment')->nullable();
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
        Schema::dropIfExists('extra_tutorials');
    }
};
