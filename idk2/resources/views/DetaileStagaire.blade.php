<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layouts.Navbar')
@section('contenu')
    <h2>nombres d'absences : {{$absencesCount}}</h2>
    <h3>Absences</h3> 
    <table style="margin-top: 5%" class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Heure de début</th>
                <th scope="col">Heure de fin</th>
                <th scope="col">absence / retard</th>
                <th scope="col">Justification</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absences as $absence)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($absence->select_date)->format('Y-m-d') }}</td>
                    <td>{{ $absence->from_hour }}</td>
                    <td>{{ $absence->to_hour }}</td>
                    <td>{{ $absence->absent_retard}}</td>
                    <td >{{ $absence->justifier }}</td>
                    <td>
                        <button onclick="deleteAbsence({{ $absence->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
</body>
</html>