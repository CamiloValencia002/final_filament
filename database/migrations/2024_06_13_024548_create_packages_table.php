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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_driver');
            $table->string('carge_type');
            $table->string('size')->nullable();
            $table->string('weight')->nullable();
            $table->string('point_initial');
            $table->string('point_finally');
            $table->string('description')->nullable();
            $table->double('price');
            $table->string('comment')->nullable();
            $table->string('image')->nullable();
            $table->string('state')->nullable();

            $table->timestamps();

            $table->foreign('id_driver')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
