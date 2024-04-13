<?php

namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\student;


class DataResetController extends Controller
{
    //
    public function resetData()
    {
        absence::truncate();
    
        student::query()->delete();
    
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE students AUTO_INCREMENT = 1;');
    
        return back()->with('success', 'Les données ont été réinitialisées avec succès.');
    }
}
