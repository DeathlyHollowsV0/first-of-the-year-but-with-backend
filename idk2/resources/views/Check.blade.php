
<style>
    .search{
        width: 100%;
        text-align: center;
        padding-top: 15px;
        padding-bottom: 15px;
    }
</style>
@extends('layouts.Navbar')
@section('contenu')

<div class="container">
    <h2>Liste des Absences</h2>
    <form style="margin-left: 70%;width:70%" action="{{ route('absences.show') }}" method="GET" class="d-flex">
        <div class="form-group">
            <input style="width: 180%" type="text" name="search" class="form-control" placeholder="Rechercher par nom ou groupe" value="{{ request('search') }}">
        </div>
        <button id="search-button" type="submit" class="btn btn-danger ml-2" style="margin-left: 15%">
            <i class="bi bi-search"></i>
        </button>
    </form>
    @if (request('search'))
        

    <table class="table">
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
                <td>{{ $student->CEF }}</td>
                <td>{{ $student->Nom }}</td>
                <td>{{ $student->Prenom }}</td>
                <td>{{ $student->Groupe }}</td>
                <td>
                    @php
                    $isZeroDuration = in_array($student->total_time_absent, [null, '0', '0h', '0min', '0h00min', '00min']);
                    @endphp
                    {{ !$isZeroDuration ? $student->total_time_absent : '0' }}
                </td>
                <td>
                    <a href="/detail-student/{{ $student->CEF }}  " class="btn btn-primary" >détaille</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
                <div class="text-center">
                    <p class="p-4">
                        
                        <div class="no-data">
                            <div><i class="bi bi-emoji-frown no-data-icon"></i></div>
                            <div class="no-data-text">Aucun élément trouvé!</div>
                        </div>
                    </p>
                </div>
            @endif
</div>
@endsection
