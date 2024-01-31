<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ExtraTutorial;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_accesses', function (Blueprint $table) {
           /* $table->id();*/ 
             $table->foreignIdFor(ExtraTutorial::class)->constrained()->comment("represent id video");
             $table->string('user_name')->nullable();
             $table->foreign('user_name')->references('user_name')->on('users')->onUpdate('cascade')->onDelete('set null'); 
             $table->dateTime("grant_date")->index()->default(now());
             $table->dateTime("expiration_date")->index()->nullable();
             $table->text("signature");
             $table->boolean("visibility")->default(true);
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
        Schema::dropIfExists('video_accesses');
    }
};
