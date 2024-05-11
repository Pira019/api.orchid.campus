<?php

use App\Models\AdmissionDate;
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
        Schema::create('service_date_admission', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Service::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(AdmissionDate::class)->constrained()->nullOnDelete();
            $table->unique(['service_id','admission_date_id']);
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
        Schema::dropIfExists('service_date_admission');
    }
};
