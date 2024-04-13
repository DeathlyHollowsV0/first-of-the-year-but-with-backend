<?php if (Session::has('id')): ?>
@extends('layouts.Navbar')
@section('contenu')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h2><b>Nombre des Séances absences :</b> <span style="{{ $absencesCount > 3 ? 'color: red;' : 'color: #42d000;' }}">{{ $absencesCount }}</span></h2><br>

    <h4><b>Nom de Stagaire :</b> &ensp; {{$name}}  {{$pren}}</h4>
    @if($absences->isNotEmpty())
    <form action="{{ route('absence.update') }}" method="post" id="attendanceForm" style="margin-top:50px">
        @csrf
    <table class=" text-center table table-striped table-light">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Date</th>
                <th scope="col">heure d'absence </th>
                <th scope="col">absence / retard</th>
                <th scope="col">Justification</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absences as $absence)
                <tr>
                    <td>
                        <input type="checkbox" name="attendance[{{ $absence->id }}][absent]" value="1" class="absent-checkbox">
                    </td>
                    <td>{{ \Carbon\Carbon::parse($absence->select_date)->format('Y-m-d') }}</td>
                    <td>
                    <div class="d-flex align-items-center">
                        <select name="attendance[{{ $absence->id }}][hour]" class="form-control hours-select me-2" disabled>
                            @for ($i = 8; $i <= 22; $i++)
                                @foreach (['00', '30'] as $minutes)
                                    @php
                                        $timeValue = str_pad($i, 2, '0', STR_PAD_LEFT) . ':' . $minutes;
                                    @endphp
                                    <option value="{{ $timeValue }}" {{ \Carbon\Carbon::parse($absence->from_hour)->format('H:i') == $timeValue ? 'selected' : '' }}>{{ $timeValue }}</option>
                                @endforeach
                            @endfor
                        </select>
                        to
                        <select name="attendance[{{ $absence->id }}][to_hour]" class="form-control to-hours-select ms-2" disabled>
                            @for ($i = 9; $i <= 22; $i++)
                                @foreach (['00', '30'] as $minutes)
                                    @php
                                        $timeValue = str_pad($i, 2, '0', STR_PAD_LEFT) . ':' . $minutes;
                                    @endphp
                                    <option value="{{ $timeValue }}" {{ \Carbon\Carbon::parse($absence->to_hour)->format('H:i') == $timeValue ? 'selected' : '' }}>{{ $timeValue }}</option>
                                @endforeach
                            @endfor
                        </select>
                        
                    </div>
                    </td>
                    <td>
                        <select name="attendance[{{ $absence->id }}][absent_retard]" class="absent_retard" disabled>
                            <option value="absent" {{ $absence->absent_retard == 'absent' ? 'selected' : '' }}>absent</option>
                            <option value="retard" {{ $absence->absent_retard == 'retard' ? 'selected' : '' }}>retard</option>
                        </select>
                    </td>
                    <td>
                        <input required name="attendance[{{ $absence->id }}][justifier]" value="{{$absence->justifier}}" class="justifier" disabled></input>
                    </td>
                    <td>
                        
                        <td>
                            <a href="{{ url('/delete/' . $absence->id) }}" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette absence ?');">Supprimer</a>
                        </td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <center>
    <button type="submit" style="background-color: #c62d2d; color: white; padding: 0px 15px; border: none; border-radius: 5px; font-size: 16px;font-weight:bold;height:45px;margin-left:140px;margin-top:20px">Modifier</button>
</center>
</form>
@else
    <div class="text-center">
        <p class="p-4">
            
            <div class="no-data">
                <div><i class="bi bi-emoji-smile no-data-icon"></i> <img src="/public/images/empty.jpg" alt="" srcset=""></div>
                <div class="no-data-text">auccun absence trouvé</div>
            </div>
        </p>
    </div>
@endif
    
@endsection
    <?php else: ?>
        <center><h1 style="color: rgb(236, 103, 103);font-size: 28px; margin-top: 300px">PAGE EXPIRED</h1></center>
    <?php endif; ?>

    <script>
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
        });
    </script>