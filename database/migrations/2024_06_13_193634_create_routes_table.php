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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_driver');
            $table->unsignedBigInteger('id_package');

            $table->string('location');
            $table->string('comment')->nullable();
            $table->string('state')->nullable();
            $table->timestamps();

            $table->foreign('id_driver')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('id_package')->references('id')->on('packages')->onDelete('cascade');

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
