<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->integer('edad')->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();

            $table->string('estado_civil', 30)->nullable();

            $table->string('departamento', 100)->nullable();
            $table->string('municipio', 100)->nullable();

            $table->string('zona', 50)->nullable();

            $table->string('colonia_barrio_aldea', 150)->nullable();

            $table->text('direccion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
