<?php

use App\Models\DisciplinarySector;
use App\Models\Service;
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
        Schema::create('service_disciplinaries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Service::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(DisciplinarySector::class)->constrained()->nullOnDelete();
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_disciplinaries');
    }
};
