<?php

namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\student;
use Illuminate\Http\Request;

// class AbsenceController extends Controller
// {
//     //
//     public function absence_student(Request $request)
//     {
//         $request->validate([
//             'attendance' => 'required|array',
//         ]);
    
//         foreach ($request->input('attendance') as $studentId => $attendanceData) {
         
//             $student = student::findOrFail($studentId);
    
//             absence::create([
//                 'student_id' => $student->id, 
//                 'select_date' => $request->select_date,
//                 'absent_retard' => $attendanceData['absent_retard'],
//                 'from_hour' => $attendanceData['hour'],
//                 'to_hour' => $attendanceData['to_hour'],
//                 'justifier' => $attendanceData['justifier'] ?? "non justifier",
//             ]);
//         }
    
      
//         return redirect('/ajouter')->with('success', 'Absence recorded successfully!');
//     }
//     public function import()
//     {
    
//         $absences = Absence::with('student')->get();
    
        
//         $groups = $absences->pluck('student.Groupe')->unique()->sort()->values();
    
//         return view('Check', compact('groups', 'absences'));
//     }
//     public function detail_student($cef)
//     {
//         $absences = Absence::join('students', 'students.id', '=', 'absences.student_id')
//                             ->select('absences.*', 'students.Nom', 'students.Prenom', 'students.Filliere', 'students.Groupe')
//                             ->where('students.CEF', $cef)
//                             ->get();
        
//         $absencesCount = $absences->count();
        
//         return view('DetaileStagaire', compact('absences', 'absencesCount'));
//     }
    
    

// } 





use function Laravel\Prompts\alert;

class AbsenceController extends Controller
{
    //
    public function absence_student(Request $request)
    {
        // Validate the form data
        $request->validate([
            'attendance' => 'required|array',
            'select_date' => 'required|date',
        ]); 
        $duplicateFound = false;
    
        foreach ($request->input('attendance') as $studentId => $attendanceData) {
            $student = Student::findOrFail($studentId);
    
            // Check for existing absence record for the student on the same day and hour
            // $existingAbsence = Absence::where('student_id', $student->id)
            //     ->where('select_date', $request->select_date)
            //     ->where('from_hour', $attendanceData['hour'])
            //     ->where('to_hour', $attendanceData['to_hour'])
            //     ->first();
    
            // if ($existingAbsence) {
            //     // Redirect back with an error message if a matching absence record is found
            //     // return redirect()->back()->with('error', 'Duplicate absence record detected for the selected student, date, and hour. No new record has been created.');
            //     continue;
            //     // return redirect('/ajouter')->with('error','un enregistrement redoubler');
            // }
            $existingAbsence = Absence::where('student_id', $student->id)
            ->where('select_date', $request->select_date)
            ->where('from_hour', $attendanceData['hour'])
            ->where('to_hour', $attendanceData['to_hour'])
            ->first();

        if ($existingAbsence) {
            // Instead of redirecting, store the student's ID (or any identifier) and the date in the duplicates list
            $duplicateFound = true;            
            continue;
        }
    
            // Create a new absence record if no duplicates were found
            Absence::create([
                'student_id' => $student->id,
                'select_date' => $request->select_date,
                'absent_retard' => $attendanceData['absent_retard'],
                'from_hour' => $attendanceData['hour'],
                'to_hour' => $attendanceData['to_hour'],
                'justifier' => $attendanceData['justifier'] ?? "non justifier",
            ]);
        }
        if ($duplicateFound) {
            return redirect('/ajouter')->with('warning', 'At least one duplicate absence record was detected and skipped.');
        } else {
            return redirect('/ajouter')->with('success', 'All absence records have been recorded successfully.');
        }
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
    public function detail_student($cef)
    {
        $absences = Absence::join('students', 'students.id', '=', 'absences.student_id')
                            ->select('absences.*', 'students.Nom', 'students.Prenom', 'students.Filliere', 'students.Groupe')
                            ->where('students.CEF', $cef)
                            ->get();
        
        $absencesCount = $absences->count();
        
        return view('DetaileStagaire', compact('absences', 'absencesCount'));
    }

    public function search(Request $request) {
        $searchQuery = $request->input('search');
        $groups = absence::join('students', 'students.id', '=', 'absences.student_id')
                                ->where('students.Filliere', 'like', '%' . $searchQuery . '%')
                                ->distinct()
                                ->pluck('students.Groupe');
        $students = collect(); // No students until a group is selected
        return view('Check', compact('groups', 'students'))->with('selectedFiliere', $searchQuery);
    }
    
    public function filterByGroup(Request $request)
    {
        $groupId = $request->input('group');
        
        $groups = Absence::select('groupe')->distinct()->pluck('groupe');
        
        $absences = Absence::join('students', 'students.id', '=', 'absences.student_id')
                            ->select('absences.*', 'students.Nom', 'students.Prenom', 'students.Filliere', 'students.Groupe')
                            ->where('students.Groupe', $groupId)
                            ->get();
        
        return view('Check', compact('groups', 'absences'));
    }

    public function showAbsencesWithLatestDate()
    {
        // Fetch students with their latest absence date
        $studentsWithLatestAbsence = Student::with(['absences' => function($query) {
            $query->latest('select_date');
        }])->get();

        // Transform the collection to include only the latest absence date for each student
        $studentsWithLatestAbsence->each(function ($student) {
            if ($student->absences->isNotEmpty()) {
                $student->latest_absence_date = $student->absences->first()->select_date;
            }
        });

        // Fetch distinct groups from students
        $groups = Student::select('Groupe')->distinct()->pluck('Groupe');

        return view('check', compact('studentsWithLatestAbsence', 'groups'));
    }
}


