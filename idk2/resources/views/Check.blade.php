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
        
            @if($students->isNotEmpty())
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
                            <td>{{ $stud->cef }}</td>
                            <td><a href="/detail-student/{{$stud->cef}}">{{ $stud->name }}</a></td>
                            <td>{{ $stud->prenom }}</td>
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
</html>