<?php

use App\Http\Controllers\AbsenceController;
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
            'CEF' => $record['CEF'], // Matches model's $fillable
            'Nom' => $record['Nom'], // Matches model's $fillable
            'Prenom' => $record['Prenom'], // Matches model's $fillable
            'Filliere' => $record['Filliere'], // Matches model's $fillable
            'Groupe' => $record['Groupe'], // Matches model's $fillable
        ]);

        
        // Removed the dd('Record imported!'); to allow all records to be processed
    }
    return back()->with('success', 'CSV data has been imported successfully.');
});



Route::get('/search',[StudentController::class,"search"]);
