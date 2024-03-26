<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\graph;
use App\Http\Controllers\ImprimerController;
use App\Http\Controllers\StudentController;
use App\Models\student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get( '/upload', function () {
    return view('Upload');
});

Route::get('/check',[AbsenceController::class,'import'])->name("check-absence");
// Route::get('/imprimer',[AbsenceController::class,'import_im'])->name("imprimer-absence");

Route::get('/ajouter',[StudentController::class,"affiche"])->name("ajouter-absence");
Route::get('/search', 'StudentController@search')->name('search');

//filter
Route::get('/filterByGroup', [StudentController::class, 'filterByGroup'])->name('filterByGroup');
//inserer 
Route::post('/absence-student',[AbsenceController::class,"absence_student"]);

//imprimer
Route::get('/Imprimer', [ImprimerController::class, 'imprimer']);

//detail 
Route::get('/detail-student/{cef}', [AbsenceController::class, 'detail_student']);

//csv
Route::post('/upload', function(){
    $csv = \League\Csv\Reader::createFromPath(request()->file(key:'csv_file')->getRealPath());
    $csv->setHeaderOffset(offset:0);
    $csv->setDelimiter(';'); // Setting the delimiter to semicolon for correct parsing
    $count = 0;

    foreach($csv as $record){
        student::create([
            'CEF' => $record['CEF'],
            'Nom' => $record['Nom'],
            'Prenom' => $record['Prenom'],
            'Filliere' => $record['Filliere'],
            'Groupe' => $record['Groupe'],
        ]);

        
       
    }
    return back()->with('success', 'CSV data has been imported successfully.');
});
//graph
Route::get('/graph', [graph::class, 'graph'])->name("graph");




Route::get('/search',[StudentController::class,"search"]);
