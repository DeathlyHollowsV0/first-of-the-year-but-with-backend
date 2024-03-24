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
        // Validate the form data
        $request->validate([
            'attendance' => 'required|array',
        ]);
    
        // Process the form data
        foreach ($request->input('attendance') as $studentId => $attendanceData) {
            // Assuming you have a Student model
            $student = student::findOrFail($studentId);
    
            // Store the data in the 'absences' table
            absence::create([
                'student_id' => $student->id, // Use 'student_id' instead of 'cef'
                'select_date' => $request->select_date,
                'absent_retard' => $attendanceData['absent_retard'],
                'from_hour' => $attendanceData['hour'],
                'to_hour' => $attendanceData['to_hour'],
                'justifier' => $attendanceData['justifier'] ?? "non justifier",
            ]);
        }
    
        // Add any additional logic or redirection as needed
        return redirect('/ajouter')->with('success', 'Absence recorded successfully!');
    }
    public function import()
    {
        // Eager load the related student details with the absences
        $absences = Absence::with('student')->get();
    
        // Retrieve distinct groups from the loaded student relationships
        // This involves collecting all student group names from the absences and then getting unique values
        $groups = $absences->pluck('student.Groupe')->unique()->sort()->values();
    
        return view('Check', compact('groups', 'absences'));
    }
    

}
