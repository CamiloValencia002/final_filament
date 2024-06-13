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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_request');
            $table->unsignedBigInteger('id_driver');
            $table->unsignedBigInteger('id_rating');
            $table->string('city');
            $table->string('delivery_state');
            $table->string('comment');
            $table->timestamps();

            $table->foreign('id_request')->references('id')->on('requests')->onDelete('cascade');
            $table->foreign('id_driver')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('id_rating')->references('id')->on('ratings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
