<?php

namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\student;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    //
    public function absence_student(Request $request)
    {
        $request->validate([
            'attendance' => 'required|array',
        ]);
    
        foreach ($request->input('attendance') as $studentId => $attendanceData) {
         
            $student = student::findOrFail($studentId);
    
            absence::create([
                'student_id' => $student->id, 
                'select_date' => $request->select_date,
                'absent_retard' => $attendanceData['absent_retard'],
                'from_hour' => $attendanceData['hour'],
                'to_hour' => $attendanceData['to_hour'],
                'justifier' => $attendanceData['justifier'] ?? "non justifier",
            ]);
        }
    
      
        return redirect('/ajouter')->with('success', 'Absence recorded successfully!');
    }
    public function import()
    {
    
        $absences = Absence::with('student')->get();
    
        
        $groups = $absences->pluck('student.Groupe')->unique()->sort()->values();
    
        return view('Check', compact('groups', 'absences'));
    }
    public function detail_student($cef)
    {
        $absences = Absence::join('students', 'students.id', '=', 'absences.student_id')
                            ->select('absences.*', 'students.Nom', 'students.Prenom', 'students.Filliere', 'students.Groupe')
                            ->where('students.CEF', $cef)
                            ->get();
        
        $absencesCount = $absences->count();
        
        return view('DetaileStagaire', compact('absences', 'absencesCount'));
    }
    
    

}
