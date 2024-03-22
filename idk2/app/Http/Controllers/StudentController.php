<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function affiche() {
        $groups = Student::select('groupe')->distinct()->pluck('groupe');
        $students = collect();
        return view('Ajouter', compact('students', 'groups'));
    }
    
    public function search(Request $request) {
        $searchQuery = $request->input('search');
        $groups = Student::where('filiere', 'like', '%' . $searchQuery . '%')
                        ->distinct()
                        ->pluck('groupe');
        $students = collect(); // No students until a group is selected
        return view('Ajouter', compact('groups', 'students'))->with('selectedFiliere', $searchQuery);
    }
    
    public function filterByGroup(Request $request) {
        $groupId = $request->input('group');
        $groups = Student::select('groupe')->distinct()->pluck('groupe');
        $students = Student::where('groupe', $groupId)->get();
        return view('Ajouter', compact('groups', 'students'));
    }
}

