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
        Schema::create('habitacions', function (Blueprint $table) {
            $table->id();
            $table->integer('nro');
            $table->integer('capacidad');
            $table->decimal('precio', 8, 2);
            $table->text('url_foto')->nullable();

            $table->unsignedBigInteger('piso_id');
            $table->unsignedBigInteger('tipo_habitacion_id');
            $table->unsignedBigInteger('estado_id');

            $table->foreign('piso_id')->references('id')->on('pisos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_habitacion_id')->references('id')->on('tipo_habitacions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacions');
    }
};
