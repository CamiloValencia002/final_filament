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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_admin');
  
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('adress');
            $table->string('document')->unique();
            $table->boolean('document_verify');
            $table->float('ratings');
            $table->timestamps();


            $table->foreign('id_admin')->references('id')->on('users')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
