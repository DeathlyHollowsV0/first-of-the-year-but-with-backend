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
        Schema::create('etud', function (Blueprint $table) {

            $table->id('id')->autoIncrement;
            $table->unsignedBigInteger('CEF');
            $table->string('Nom');
            $table->string('Prenom');
            $table->string('Filliere');
            $table->string('Groupe');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etud');
    }
};
