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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_driver');
            $table->string('vehicle_photo')->nullable();
            $table->string('capacity');
            $table->string('dimension');
            $table->string('type');
            $table->boolean('photo_soat')->nullable();
            $table->boolean('photo_tecnomecanic')->nullable();
            $table->timestamps();


            $table->foreign('id_driver')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
