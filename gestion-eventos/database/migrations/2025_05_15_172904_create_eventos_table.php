<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id(); // Columna ID primaria
            $table->string('titulo'); // Título del evento
            $table->text('descripcion'); // Descripción del evento
            $table->date('fecha'); // Fecha del evento
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('eventos');
    }
};