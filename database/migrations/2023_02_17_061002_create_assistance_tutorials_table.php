<?php

use App\Models\Assistance;
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
        Schema::create('assistance_tutorials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Assistance::class)->constrained();
            $table->foreignIdFor(Tutorial::class)->constrained()->nullOnDelete();
            $table->date('started_at');
            $table->string('last_seen_at')->nullable()->comment('for video');
            $table->date('finished_at')->nullable();
            $table->boolean('finished')->default(false);
            $table->text('comment')->nullable(false);
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
        Schema::dropIfExists('assistance_tutorials');
    }
};
