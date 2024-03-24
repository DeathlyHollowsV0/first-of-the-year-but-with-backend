{{-- <!DOCTYPE html>
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
    <div class="search-container">
        <form action="/searchh" method="GET">
            <div class="input-group">
                <div class="form-outline" data-mdb-input-init>
                    <input id="search-input" type="search" name="search" class="form-control" placeholder="search filiere" />
                </div>
                <button id="search-button" type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
    <br>
    <form id="group-select-form" action="{{ route('filterByGroupp') }}" method="GET">
        <select name="group" id="group-select">
            <option value="" hidden>**select un groupe**</option>
            @foreach($groups as $group)
                <option value="{{ $group }}">{{ $group }}</option>
            @endforeach
        </select>
    
    </form>
    <br><br>
    <center>
        <form action="/absence-update" method="post" id="attendanceForm" style="margin-top:50px">
            @csrf
        
            @if($absenceents->isNotEmpty())
            <table border="1">
                <thead>
                    <tr>
                        <th>select</th>
                        <th>cef</th>
                        <th>Name</th>
                        <th>prenom</th>
                        <th>Absent Hours</th>
                        <th>absent or retard</th>
                        <th>justification</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach($students as $stud)
                        <tr>
                            <td>
                                <input type="checkbox" name="attendance[{{ $stud->id }}][absent]" value="1" class="absent-checkbox">
                            </td>
                            <td>{{ $stud->CEF }}</td>
                            <td><a href="/detail-student/{{$stud->CEF}}">{{ $stud->Nom }}</a></td>
                            <td>{{ $stud->Prenom }}</td>
                            <td>
                                <select name="attendance[{{ $stud->id }}][hour]" class="hours-select" disabled>
                                    @for ($i = 8; $i <= 24; $i++)
                                        <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                                :00 to
                                <select name="attendance[{{ $stud->id }}][to_hour]" class="to-hours-select" disabled>
                                    @for ($i = 9; $i <= 24; $i++)
                                        <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                                :00
                            </td>
                            <td>
                                <select name="attendance[{{ $stud->id }}][absent_retard]" class="absent_retard" disabled>
                                    <option value="absent" {{ $stud->absent_retard == 'absent' ? 'selected' : '' }}>absent</option>
                                    <option value="retard" {{ $stud->absent_retard == 'retard' ? 'selected' : '' }}>retard</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="attendance[{{ $stud->id }}][justifier]" class="justifier" value="{{ $stud->justifier ?? '' }}" disabled>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center">
                <p class="p-4">
                    <img src="{{ asset('images/empty.svg') }}" alt="" class="w-20 h-20 mx-auto">
                    <div>Aucun élément trouvé!</div>
                </p>
            </div>
        @endif
        
        
            <button type="submit" style="background-color: #0a12b3; color: white; padding: 0px 15px; border: none; border-radius: 5px; font-size: 16px;font-weight:bold;height:45px;margin-left:140px;margin-top:20px">Submit</button>
        </form>
    </center>

        <br><br>
        
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all checkboxes and corresponding select elements
            const checkboxes = document.querySelectorAll('.absent-checkbox');
            const hoursSelects = document.querySelectorAll('.hours-select');
            const toHoursSelects = document.querySelectorAll('.to-hours-select');
            const justifier = document.querySelectorAll('.justifier');
            const retard = document.querySelectorAll('.absent_retard');
    
            // Add event listener to each checkbox
            checkboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', function () {
                    // Toggle the disabled attribute based on checkbox state
                    const isChecked = this.checked;
                    hoursSelects[index].disabled = !isChecked;
                    toHoursSelects[index].disabled = !isChecked;
                    justifier[index].disabled = !isChecked;
                    retard[index].disabled = !isChecked;
                });
            });
        });
    </script>
</body>
</html> --}}
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
    <center>
        <form  action="/absence-student" method="post" id="attendanceForm">
            <input type="date" name="select_date-from" id="select_date" > <br><br><br>
            <input type="date" name="select_date-to" id="select_date" > <br><br><br>
            @csrf
            @if($absences->isNotEmpty())

<table class="table table-striped ">
    <thead>
        <tr>
            <th scope="col">Select</th>
            <th scope="col">CEF</th>
            <th scope="col">Name</th>
            <th scope="col">Prenom</th>
            <th scope="col">Filiere</th>
            <th scope="col">Groupe</th>
            <th scope="col">Absent Hours</th>
            <th scope="col">Absent or Retard</th>
            <th scope="col">Justification</th>
        </tr>
    </thead>
    <tbody>
        @foreach($absences as $absence)
            <tr>
                <td>
                    <input type="checkbox" name="attendance[{{ $absence->id }}][absent]" value="1" class="absent-checkbox">
                </td>
                <td><a href="/detail-student/{{ $absence->student->CEF }}" style="text-decoration: none">{{ $absence->student->CEF }}</a></td>
                <td>{{ $absence->student->Nom }}</td>
                <td>{{ $absence->student->Prenom }}</td>
                <td>{{ $absence->student->Filliere }}</td>
                <td>{{ $absence->student->Groupe }}</td>
                                <div class="d-flex align-items-center">
                                    <select name="attendance[{{ $absence->id }}][hour]" class="form-control hours-select me-2" disabled>
                                        @for ($i = 8; $i <= 22; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00" {{ (old('attendance.'.$absence->id.'.hour') == str_pad($i, 2, '0', STR_PAD_LEFT).':00') ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                                            @if ($i < 22)
                                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30" {{ (old('attendance.'.$absence->id.'.hour') == str_pad($i, 2, '0', STR_PAD_LEFT).':30') ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                                            @endif
                                        @endfor
                                    </select>
                                    to
                                    <select name="attendance[{{ $absence->id }}][to_hour]" class="form-control to-hours-select ms-2" disabled>
                                        @for ($i = 9; $i <= 22; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00" {{ (old('attendance.'.$absence->id.'.to_hour') == str_pad($i, 2, '0', STR_PAD_LEFT).':00') ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                                            @if ($i < 22)
                                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30" {{ (old('attendance.'.$absence->id.'.to_hour') == str_pad($i, 2, '0', STR_PAD_LEFT).':30') ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </td>
                            <td>
                                <select name="attendance[{{ $absence->id }}][absent_retard]"  class="form-control absent_retard" disabled>
                                    <option value="absent" {{ (old('attendance.'.$absence->id.'.absent_retard') == 'absent') ? 'selected' : '' }}>absent</option>
                                    <option value="retard" {{ (old('attendance.'.$absence->id.'.absent_retard') == 'retard') ? 'selected' : '' }}>retard</option>
                                </select>
                            </td>
                            <td>
                                <textarea name="attendance[{{ $absence->id }}][justifier]" class="form-control justifier" rows="2" disabled>{{ old('attendance.'.$absence->id.'.justifier') }}</textarea>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    <button type="submit" style="background-color: #0a12b3; color: white; padding: 0px 15px; border: none; border-radius: 5px; font-size: 16px;font-weight:bold;height:45px;margin-left:140px;margin-top:20px">Submit</button>
            @else
                <div class="text-center">
                    <p class="p-4">
                        {{-- <img src="{{ asset('images/empty.jpg') }}" alt="" class="w-20 h-20 mx-auto">
                        <div>Aucun élément trouvé!</div> --}}
                        <div class="no-data">
                            <div><i class="far fa-frown no-data-icon"></i></div>
                            <div class="no-data-text">Aucun élément trouvé!</div>
                        </div>
                    </p>
                </div>
            @endif
        </form>
    </center>
    
        <br><br>
        
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all checkboxes and corresponding select elements
            const checkboxes = document.querySelectorAll('.absent-checkbox');
            const hoursSelects = document.querySelectorAll('.hours-select');
            const toHoursSelects = document.querySelectorAll('.to-hours-select');
            const justifier = document.querySelectorAll('.justifier');
            const retard = document.querySelectorAll('.absent_retard');
    
            // Add event listener to each checkbox
            checkboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', function () {
                    // Toggle the disabled attribute based on checkbox state
                    const isChecked = this.checked;
                    hoursSelects[index].disabled = !isChecked;
                    toHoursSelects[index].disabled = !isChecked;
                    justifier[index].disabled = !isChecked;
                    retard[index].disabled = !isChecked;
                });
            });
        });
    </script>
</body>
</html>