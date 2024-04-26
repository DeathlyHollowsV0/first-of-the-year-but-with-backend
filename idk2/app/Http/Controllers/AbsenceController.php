<?php

namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



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
    
            
            $existingAbsence = Absence::where('student_id', $student->id)
            ->where('select_date', $request->select_date)
            ->where('from_hour', $attendanceData['hour'])
            ->where('to_hour', $attendanceData['to_hour'])
            ->first();

        if ($existingAbsence) {
            $duplicateFound = true;            
            continue;
        }
    
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


    //update function
    public function updateAbsence(Request $request)
    {
        $request->validate([
            'attendance' => 'required|array',
        ]);
        
        foreach ($request->input('attendance') as $absenceId => $attendanceData) {
            $absence = Absence::findOrFail($absenceId);
            
            if (isset($attendanceData['absent']) && $attendanceData['absent'] == '1') {
                $absence->update([
                    'absent_retard' => $attendanceData['absent_retard'],
                    'from_hour' => $attendanceData['hour'],
                    'to_hour' => $attendanceData['to_hour'],
                    'justifier' => $attendanceData['justifier'],
                ]);
            }
        }
        
        return back()->with('success', 'Les absences ont été mises à jour avec succès.');
    }

    

    
    public function import()
    {
       
        $absences = Absence::with('student')->get();
    
       
        $groups = $absences->pluck('student.Groupe')->unique()->sort()->values();
    
        return view('Check', compact('groups', 'absences'));
    }
    public function detail_student($CEF)
    {
        $absences = Absence::join('students', 'students.id', '=', 'absences.student_id')
                            ->select('absences.*', 'students.Nom', 'students.Prenom', 'students.Filliere', 'students.Groupe')
                            ->where('students.CEF', $CEF)
                            ->orderBy('absences.select_date', 'desc') // Tri par date croissante
                            ->get();
        
        $absencesCount = $absences->count();
        $name = $absences->isNotEmpty() ? $absences->first()->Nom : 'Inconnu';
        $pren = $absences->isNotEmpty() ? $absences->first()->Prenom : 'Inconnu';
        
        return view('DetaileStagaire', compact('absences', 'absencesCount','name','pren'));
    }
    


   
    public function importCheck(){
        $groups = absence::select('Groupe')->distinct()->get()->sortBy('Groupe');

        return view('Check', compact('groups'));
    }



    


    public function showAbsences(Request $request)
    {
        $selectedGroup = $request->input('groupe');
        $searchQuery = $request->input('search');
        $groups = Student::select('Groupe')->distinct()->orderBy('Groupe')->pluck('Groupe');

        $query = DB::table('students')
            ->join('absences', 'students.id', '=', 'absences.student_id')
            ->select('students.CEF', 'students.Nom', 'students.Prenom', 'students.Groupe', 
                        DB::raw("CONCAT(FLOOR(SUM(TIME_TO_SEC(TIMEDIFF(absences.to_hour, absences.from_hour))) / 3600), 'h ',
                        LPAD(FLOOR((SUM(TIME_TO_SEC(TIMEDIFF(absences.to_hour, absences.from_hour))) % 3600) / 60), 2, '0'), 'min') AS total_time_absent"));

        if (!empty($searchQuery)) {
            $terms = explode(' ', $searchQuery);
            foreach ($terms as $term) {
                $query->orWhere('students.Nom', 'like', "%{$term}%")
                        ->orWhere('students.Prenom', 'like', "%{$term}%")
                        ->orWhere('students.Groupe', 'like', "%{$term}%");
            }
        }

        if (!empty($selectedGroup)) {
            $query->where('students.Groupe', $selectedGroup);
        }

        $studentsWithAbsences = $query->groupBy('students.CEF', 'students.Nom', 'students.Prenom', 'students.Groupe')->get();

        return view('check', compact('groups', 'studentsWithAbsences', 'selectedGroup'));
    }





    
    public function delete($id)
    {
        $client = absence::find($id); 
        
            $client->delete();
            return redirect()->back()->with('success', 'absence supprimé avec succès.');
        
    }
    
    
    



}

