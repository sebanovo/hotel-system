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
        Schema::create('nota_ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('monto_total', 10, 2);

            $table->unsignedBigInteger('tipo_pago_id');
            $table->unsignedBigInteger('reserva_id')->nullable();
            $table->unsignedBigInteger('user_cliente_id');
            $table->unsignedBigInteger('user_empleado_id');


            $table->foreign('tipo_pago_id')->references('id')->on('tipo_pagos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('reserva_id')->references('id')->on('reservas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_cliente_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_empleado_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_ventas');
    }
};
