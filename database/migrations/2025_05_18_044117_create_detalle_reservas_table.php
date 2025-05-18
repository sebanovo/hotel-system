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
        Schema::create('detalle_reservas', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio_v', 10, 2);
            $table->integer('cantidad');

            $table->unsignedBigInteger('reserva_id');
            $table->unsignedBigInteger('habitacion_id');

            $table->foreign('reserva_id')->references('id')->on('reservas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('habitacion_id')->references('id')->on('habitacions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_reservas');
    }
};
