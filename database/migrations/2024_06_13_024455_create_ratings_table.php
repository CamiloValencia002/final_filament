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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_driver');
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_route');
            $table->float('ratings');
            $table->string('comment');
            $table->timestamps();

            $table->foreign('id_driver')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('id_route')->references('id')->on('routes')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
