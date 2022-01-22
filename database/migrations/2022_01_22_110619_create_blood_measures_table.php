<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_measures', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->date('date_sistolik')->nullable();
            $table->string('sistolik', 5);
            $table->date('date_diastolik')->nullable();
            $table->string('diastolik', 5);
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
        Schema::dropIfExists('blood_measures');
    }
}
