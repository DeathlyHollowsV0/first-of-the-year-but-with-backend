@extends('layouts.Navbar')

@section('contenu')
    <center><form method="GET" action="{{ route('graph') }}">
        <input type="date" name="start_date">
        <input type="date" name="end_date">
        <select name="groupe">
            <option value="">Select Group</option>
            @foreach ($allGroups as $group)
                <option value="{{ $group->Groupe }}">{{ $group->Groupe }}</option>
            @endforeach
        </select>
        <button type="submit">Submit</button>
    </form>

    <br>
</center>

    <div class="graph-container">
        <div class="graph">
            <canvas id="chart-total"></canvas>
        </div>
    </div>

    <style>
        .graph-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh; 
        overflow: auto;
    }

    .graph {
        width: 50%; 
        height: 100%;
    }
    </style>

    <script>
        var ctx = document.getElementById('chart-total').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($absences->pluck('select_date')),
                datasets: [{
                    label: 'Absences',
                    data: @json($absences->pluck('total')),
                    backgroundColor: 'orange',
                    borderColor: 'red',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: '{{ $selectedGroup ? $selectedGroup : "ISTA NADOR" }}'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
