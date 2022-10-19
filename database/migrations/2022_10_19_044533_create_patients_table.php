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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name', 150);
            $table->string('cpf', 15);
            $table->string('phone', 20);
            $table->string('email', 50);
            $table->string('cep',15);
            $table->string('address', 150);
            $table->string('number', 20);
            $table->string('name_responsable', 150)->nullable();
            $table->string('cpf_responsable', 15)->nullable();
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
        Schema::dropIfExists('patients');
    }
};
