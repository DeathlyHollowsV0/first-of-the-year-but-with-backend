
 @extends('layouts.Navbar')

 @section('contenu')
 <style>
    .search-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px;
    }
    .input-group {
        position: relative;
        width: 40%; 
    }
    .form-control {
        width: 100%;
        padding-right: 50px; 
    }
    .search-button {
        position: absolute;
        right: 0;
        top: 0;
        margin-right: 39.5%;
        height: 100%;
        border: none;
        background: transparent;
        border-radius: 5px;
        padding: 8px 12px;
        color: #dc3545;
        cursor: pointer;
    }
    .search-button i {
        font-size: 20px;
    }
    .form-control:focus + .search-button {
        color: #dc3545;
    }
</style>

<div class="container">
    <h2>Liste des Absences</h2>
    <div class="search-bar">
       
        <div class="input-group">
            <form id="searchForm" action="{{ route('absences.show') }}" method="GET">
                <input type="text" name="search" style="width: 300px" class="form-control" placeholder="Rechercher par nom ou groupe" value="{{ request('search') }}">
                <button type="submit" class="search-button">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
 
       
         <form style="margin-right: 30%" action="{{ route('absences.show') }}" method="GET" class="d-flex align-items-center ml-4" id="groupForm">
             <select name="groupe" class="form-control mr-2">
                 <option value="">Sélectionnez un groupe</option>
                 @foreach($groups as $group)
                     <option value="{{ $group }}" {{ request('groupe') == $group ? 'selected' : '' }}>{{ $group }}</option>
                 @endforeach
             </select>
             <button type="submit" class="btn btn-primary">Filtrer</button>
         </form>
     </div>
     
     <form id="searchForm" action="{{ route('absences.show') }}" method="GET"></form>
 
     @if($studentsWithAbsences->isNotEmpty())
         <table class="table mt-4">
             <thead>
                 <tr>
                     <th>CEF</th>
                     <th>Nom</th>
                     <th>Prénom</th>
                     <th>Groupe</th>
                     <th>Heures Absences</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($studentsWithAbsences as $student)
                     <tr>
                         <td ><a style="text-decoration: none" href="/detail-student/{{ $student->CEF }}" >{{ $student->CEF }}</a></td>
                         <td>{{ $student->Nom }}</td>
                         <td>{{ $student->Prenom }}</td>
                         <td>{{ $student->Groupe }}</td>
                         <td>{{ $student->total_time_absent }}</td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
         @else
                <center>
                    <p class="p-4">
             
                        <div class="no-data">
                            <div><i class="bi bi-emoji-frown no-data-icon"></i></div>
                            <div class="no-data-text">Aucun élément trouvé!</div>
                        </div>
                    </p>
                </center>
         
     @endif
 </div>
 @endsection
 