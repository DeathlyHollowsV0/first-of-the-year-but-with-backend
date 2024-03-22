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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("cef");
            $table->string("name");
            $table->string("prenom");
            $table->string("filiere");
            $table->string("groupe");
            $table->date("select_date");
            $table->string("absent");
            $table->string("absent_retard");
            $table->string("from_hour");
            $table->string("to_hour");
            $table->string("justifier")->default("non justifier");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
