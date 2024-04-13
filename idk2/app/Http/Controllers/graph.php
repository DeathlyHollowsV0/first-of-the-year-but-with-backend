<?php
namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\student;
use Illuminate\Http\Request;

class graph extends Controller
{
    public function graph(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $groupe = $request->input('groupe');

        $query = absence::join('students', 'absences.student_id', '=', 'students.id')
            ->groupBy('select_date')
            ->orderBy('select_date')
            ->selectRaw('count(*) as total, select_date');

        if ($start_date && $end_date) {
            $query->whereBetween('select_date', [$start_date, $end_date]);
        }

        if ($groupe) {
            $query->where('groupe', $groupe);
        }

        $absences = $query->get()->sortBy("date");

        $absences = $absences->map(function ($absence) {
            $date = \Carbon\Carbon::parse($absence->select_date);
            $absence->select_date = $date->format('d/m');
            
            return $absence;
        });

        $allGroups = Student::select('Groupe')->distinct()->orderBy('Groupe')->get();

        return view('graph', ['absences' => $absences, 'allGroups' => $allGroups, 'selectedGroup' => $groupe]);
    }
}
