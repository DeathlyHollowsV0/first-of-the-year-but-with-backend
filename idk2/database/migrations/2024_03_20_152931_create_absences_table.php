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
            $table->unsignedBigInteger('student_id'); 
            $table->date("select_date");
            $table->string("absent_retard");
            $table->time("from_hour");
            $table->time("to_hour");
            $table->string("justifier")->default("non justifier");
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
        // Schema::table('absences', function (Blueprint $table) {
        //     $table->softDeletes(); // Ajoute la colonne deleted_at pour la suppression logique
        // });
    }
};
