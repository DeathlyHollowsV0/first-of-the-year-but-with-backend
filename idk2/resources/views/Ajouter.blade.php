<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<style>
    .search{
        width: 100%;
        text-align: center;
        padding-top: 15px;
        padding-bottom: 15px;
    }
</style>
<body >
    <?php if (Session::has('id')): ?>
    @extends('layouts.Navbar')
    @section('contenu')
    
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <div class="search-container d-flex justify-content-center">
        <form action="/search" method="GET" class="d-flex">
            <div class="form-outline" data-mdb-input-init>
                <input id="search-input" type="search" name="search" class="form-control"
                    placeholder="filtrer les groupes" />
            </div>
            <button id="search-button" type="submit" class="btn btn-danger ml-2">
                <i class="bi bi-search"></i>
            </button>
        </form>
        <form id="group-select-form" action="{{ route('filterByGroup') }}" method="GET" class="ml-2" style="margin-left: 4%">
            <select name="group" id="group-select" class="form-control">
                <option value="" hidden>Selectioner un Groupe</option>
                @foreach ($groups as $group)
                    <option value="{{ $group }}">{{ $group }}</option>
                @endforeach
            </select>
        </form>
    </div>
    
    <br><br>
    <center>
        <form  action="/absence-student" method="post" id="attendanceForm">
            <input type="date" name="select_date" id="select_date" > <br><br><br>
            @csrf
            @if($students->isNotEmpty())
            <h4> <b>groupe : </b>{{$groupId}} &ensp; &ensp;&ensp; <b> Nombre Etudiants : </b> {{$students->count()}}</h4>

            <table class="table table-striped text-center ">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">CEF</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Heures d'absence</th>
                        <th scope="col">Absent ou Retard</th>
                        <th scope="col">Justification</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $stud)

                        <tr>
                            <td>
                                <input type="checkbox" name="attendance[{{ $stud->id }}][absent]" value="1" class="absent-checkbox">
                            </td>
                            <td><a href="/detail-student/{{ $stud->CEF }}" style="text-decoration: none">{{ $stud->CEF }}</a></td>
                            <td>{{ $stud->Nom }}</td>
                            <td>{{ $stud->Prenom }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <select name="attendance[{{ $stud->id }}][hour]" class="form-control hours-select me-2" disabled>
                                        @for ($i = 8; $i <= 22; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00" {{ (old('attendance.'.$stud->id.'.hour') == str_pad($i, 2, '0', STR_PAD_LEFT).':00') ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                                            @if ($i < 22)
                                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30" {{ (old('attendance.'.$stud->id.'.hour') == str_pad($i, 2, '0', STR_PAD_LEFT).':30') ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                                            @endif
                                        @endfor
                                    </select>
                                    to
                                    <select name="attendance[{{ $stud->id }}][to_hour]" class="form-control to-hours-select ms-2" disabled>
                                        @for ($i = 9; $i <= 22; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00" {{ (old('attendance.'.$stud->id.'.to_hour') == str_pad($i, 2, '0', STR_PAD_LEFT).':00') ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                                            @if ($i < 22)
                                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30" {{ (old('attendance.'.$stud->id.'.to_hour') == str_pad($i, 2, '0', STR_PAD_LEFT).':30') ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </td>
                            <td>
                                <select name="attendance[{{ $stud->id }}][absent_retard]"  class="form-control absent_retard" disabled>
                                    <option value="absent" {{ (old('attendance.'.$stud->id.'.absent_retard') == 'absent') ? 'selected' : '' }}>absent</option>
                                    <option value="retard" {{ (old('attendance.'.$stud->id.'.absent_retard') == 'retard') ? 'selected' : '' }}>retard</option>
                                </select>
                            </td>
                            <td>
                                <textarea name="attendance[{{ $stud->id }}][justifier]" class="form-control justifier" rows="2" disabled>{{ old('attendance.'.$stud->id.'.justifier') }}</textarea>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    <button type="submit" style="background-color: #0a12b3; color: white; padding: 0px 15px; border: none; border-radius: 5px; font-size: 16px;font-weight:bold;height:45px;margin-left:140px;margin-top:20px">Submit</button>
            @else
                <div class="text-center">
                    <p class="p-4">
                        
                        <div class="no-data">
                            <div><img src="/images/empty.jpg" alt="" srcset=""></div>
                            <div class="no-data-text">Aucun élément trouvé!</div>
                        </div>
                    </p>
                </div>
            @endif
        </form>
    </center>
    <br><br>
    
    @endsection
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <script type="text/javascript">
    $('#group-select').change(function() {
    var selectedGroup = $(this).val();
    $('#selected-group').val(selectedGroup); 
    
});

    
    //
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.absent-checkbox');
            const hoursSelects = document.querySelectorAll('.hours-select');
            const toHoursSelects = document.querySelectorAll('.to-hours-select');
            const justifier = document.querySelectorAll('.justifier');
            const retard = document.querySelectorAll('.absent_retard');
    
           
            checkboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', function () {
                    
                    const isChecked = this.checked;
                    hoursSelects[index].disabled = !isChecked;
                    toHoursSelects[index].disabled = !isChecked;
                    justifier[index].disabled = !isChecked;
                    retard[index].disabled = !isChecked;
                });
            });
            
          
            $(document).ready(function() {
                $('#group-select').change(function() {
                $('#group-select-form').submit();
            });
            });

            document.getElementById('select_date').valueAsDate = new Date()
  
        });
    </script>
        <?php else: ?>
                <center><h1 style="color: rgb(236, 103, 103);font-size: 28px; margin-top: 300px">PAGE EXPIRED</h1></center>
        <?php endif; ?>
</body>
</html>

