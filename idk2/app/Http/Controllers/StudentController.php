<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function affiche()
    {
        $groups = student::select('Groupe')->distinct()->orderBy('Groupe')->pluck('Groupe');
        $students = collect();
        
        return view('Ajouter', compact('students', 'groups'));
    }

    //search
    public function search(Request $request)
    {
        $searchQuery = $request->input('search');
        
        $groups = Student::where('Filliere', 'like', '%' . $searchQuery . '%')
                        ->distinct()
                        ->pluck('Groupe');
        
        $students = collect(); 
        
        return view('Ajouter', compact('groups', 'students'))->with('selectedFiliere', $searchQuery);
    }


    public function filterByGroup(Request $request)
    {
        $groupId = $request->input('group');
        
        $groups = Student::select('Groupe')->distinct()->pluck('Groupe');
        
        $students = Student::where('Groupe', $groupId)->orderBy('Nom', 'asc')->get();
        
        return view('Ajouter', compact('groups', 'students' , 'groupId'));
        
    }
}

