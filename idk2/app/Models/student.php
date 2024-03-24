<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable = [
        "CEF",
        "Nom",
        "Prenom",
        "Filliere",
        "Groupe",
    ];
    public function absences()
{
    return $this->hasMany(absence::class, 'student_id');
}
    protected $guarded = [];
}
