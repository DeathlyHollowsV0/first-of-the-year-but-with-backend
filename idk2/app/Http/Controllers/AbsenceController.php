<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Absence;
use App\Models\Student;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
class AbsenceController extends Controller
{
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
            'absent' => $attendanceData['absent'],
            'cef' => $student->cef,
            'name' => $student->name,
            'prenom' => $student->prenom,
            'filiere' => $student->filiere, // Fetch 'filiere' from the student record
            'groupe' => $student->groupe,
            'select_date' => $request->select_date,
            'absent_retard' => $attendanceData['absent_retard'],
            'from_hour' => $attendanceData['hour'],
            'to_hour' => $attendanceData['to_hour'],
            'justifier' => $attendanceData['justifier'],
        ]);
    }

    // Add any additional logic or redirection as needed
    return redirect('/ajouter')->with('success', 'Absence recorded successfully!');
}
    public function import(){
        $groups = Absence::select('groupe')->distinct()->pluck('groupe');
        $students = collect();
        return view('Check', compact('students', 'groups'));
    }

    //update : : : 

    public function absence_update(Request $request)
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
            $absence = absence::findOrFail($studentId);
            $absence->update([
                'cef' => $student->cef,
                'name' => $student->name,
                'prenom' => $student->prenom,
                'filiere' => $student->filiere, // Fetch 'filiere' from the student record
                'groupe' => $student->groupe,
                'absent' => $absence->absent,
                'absent_retard' => $attendanceData['absent_retard'],
                'from_hour' => $attendanceData['hour'],
                'to_hour' => $attendanceData['to_hour'],
                'justifier' => $attendanceData['justifier'],
            ]);
        }
        return redirect('/ajouter')->with('success', 'Absence recorded successfully!');        
    }

    //detail  

    public function detail_student($cef){
        $absences = absence::where('cef', $cef)->get();
        $absencesCount = Absence::where('cef', $cef)->count();
        return view('/DetailStagaire',compact('absences','absencesCount'));

    }
    // search 

    public function affiche() {
        $groups = Absence::select('groupe')->distinct()->pluck('groupe');
        $students = collect();
        return view('Check', compact('students', 'groups'));
    }
    
    public function search(Request $request) {
        $searchQuery = $request->input('search');
        $groups = Absence::where('filiere', 'like', '%' . $searchQuery . '%')->where('select_date', 'like', '%' . $searchQuery . '%')
                        ->distinct()
                        ->pluck('groupe');
        $students = collect(); // No students until a group is selected
        return view('Check', compact('groups', 'students'))->with('selectedFiliere', $searchQuery);
    }
    
    public function filterByGroup(Request $request) {
        $groupId = $request->input('group');
        $groups = Absence::select('groupe')->distinct()->pluck('groupe');
        $students = Absence::where('groupe', $groupId)->get();
        return view('Check', compact('groups', 'students'));
    }
}
