<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataResetController;
use App\Http\Controllers\graph;
use App\Http\Controllers\ImprimerController;
use App\Http\Controllers\StudentController;
use App\Models\student;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});

Route::post('/Login',[AdminController::class,'Login']);

Route::get('/logout', [AdminController::class, 'logout']);

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get( '/upload', function () {
    return view('Upload');
});

Route::get('/check',[AbsenceController::class,'import'])->name("check-absence");

Route::get('/ajouter',[StudentController::class,"affiche"])->name("ajouter-absence");
Route::get('/search', 'StudentController@search')->name('search');

//filter
Route::get('/filterByGroup', [StudentController::class, 'filterByGroup'])->name('filterByGroup');
//inserer 
Route::post('/absence-student',[AbsenceController::class,"absence_student"]);

//imprimer
Route::get('/Imprimer', [ImprimerController::class, 'imprimer']);

//detail 
Route::get('/detail-student/{CEF}', [AbsenceController::class, 'detail_student']);

//graph
Route::get('/graph', [graph::class, 'graph'])->name("graph");

//reset data
Route::post('/data-reset', [DataResetController::class, 'resetData'])->name('data.reset');

//Update 
Route::post('/absence-update', [AbsenceController::class, 'updateAbsence'])->name('absence.update');


//delete

Route::get('/delete/{id}', [AbsenceController::class, 'delete']);


//check jdida
Route::get('/absences', [AbsenceController::class, 'showAbsences'])->name('absences.show');

//csv
Route::post('/upload', function() {
    // Check if the file is uploaded
    if (!request()->hasFile('csv_file')) {
        return back()->with('danger', 'Veuillez télécharger un fichier CSV.');
    }

    $file = request()->file('csv_file');

    // Check if the uploaded file is valid
    if (!$file->isValid()) {
        return back()->with('danger', 'Téléchargement de fichier invalide. Veuillez réessayer.');
    }

    try {
        $csv = \League\Csv\Reader::createFromPath($file->getRealPath());
        $csv->setHeaderOffset(0); 
        $csv->setDelimiter(';'); 

        foreach ($csv as $record) {
            Student::create([
                'CEF' => $record['CEF'],
                'Nom' => $record['Nom'],
                'Prenom' => $record['Prenom'],
                'Filliere' => $record['Filliere'],
                'Groupe' => $record['Groupe'],
            ]);
        }

        return back()->with('success', 'CSV data has been imported successfully.');

    } catch (\Exception $e) {
      
        return back()->with('danger', 'An error occurred while processing the CSV file. Please check the file format and try again.');
    }
});



Route::get('/search',[StudentController::class,"search"]);
