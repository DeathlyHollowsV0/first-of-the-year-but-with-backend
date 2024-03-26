<?php

namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\student;
use Illuminate\Http\Request;


class ImprimerController extends Controller
{
    public function imprimer(Request $request)
    {
        $groups = student::select('Groupe')->distinct()->get()->sortBy('Groupe');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $group = $request->input('group');

        $absences = absence::with('student')
            ->when($start_date, function ($query, $start_date) {
                return $query->where('select_date', '>=', $start_date);
            })
            ->when($end_date, function ($query, $end_date) {
                return $query->where('select_date', '<=', $end_date);
            })
            ->when($group, function ($query, $group) {
                return $query->whereHas('student', function ($query) use ($group) {
                    $query->where('Groupe', $group);
                });
            })
            ->get()
            ->sortBy('student.Groupe')
            ->groupBy('groupe');

        return view('Imprimer', compact('absences', 'groups'));
    }
}