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

            $table->string('codigo', 50)->nullable();
            $table->string('marca_temporal', 50)->nullable();
            $table->string('dpi_cui', 20)->nullable();
            $table->string('primer_nombre', 100)->nullable();
            $table->string('segundo_nombre', 100)->nullable();
            $table->string('primer_apellido', 100)->nullable();
            $table->string('segundo_apellido', 100)->nullable();
            $table->string('telefono_de_contacto', 20)->nulllable();
            $table->string('correo_electronico', 150)->nullable();
            $table->string('fecha_de_nacimiento', 50)->nullable();
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
