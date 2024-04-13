    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script>
            function printContent() {
                var printContents = document.getElementById('print').innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>
    </head>

    <body>

        <?php if (Session::has('id')): ?>
        
        @extends('layouts.Navbar')
        @section('contenu')
            <br>
            <center>
                <form method="GET" action="/Imprimer">
                    <label for="start_date">DE:</label>
                    <input type="date" id="start_date" name="start_date">

                    <label for="end_date">À:</label>
                    <input type="date" id="end_date" name="end_date">




                    <label for="group">Group:</label>
                    <select id="group" name="group">
                        <option value="" selected disabled hidden></option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->Groupe }}">{{ $group->Groupe }}</option>
                        @endforeach
                    </select>

                    <input style="background-color: rgb(143, 215, 158)" type="submit" value="Filter">
                    <button style="background-color: rgb(143, 215, 158)" type="button" onclick="printContent()">
                        <i class="bi bi-printer-fill"></i> Imprimer
                    </button>

                </form>
                <br>

                
                @foreach ($absences as $group => $groupAbsences)
                    @php
                        $groupAbsences = $groupAbsences->groupBy('student.Nom');
                    @endphp
                    <div id="print">
                        
                        <table class="table">
                            <style>
                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }

                                th,
                                td {
                                    white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    border: 1px solid black;
                                    padding: 5px;
                                    text-align: center;
                                    vertical-align: middle;
                                }
                            </style>

                            <tr>
                                <th>Groupe</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Date</th>
                                <th>Absent/Retard</th>
                                <th>From Hour</th>
                                <th>To Hour</th>
                                <th>Justifier</th>
                            </tr>

                            @foreach ($absences as $group => $groupAbsences)
                                @php
                                    $groupAbsences = $groupAbsences->groupBy('student.Nom');
                                @endphp

                                @foreach ($groupAbsences as $studentName => $studentAbsences)
                                    @php
                                        $rowspan = count($studentAbsences);
                                    @endphp

                                    @foreach ($studentAbsences as $index => $absence)
                                        <tr>
                                            @if ($index === 0)
                                                <td rowspan="{{ $rowspan }}">{{ $absence->student->Groupe }}</td>
                                                <td rowspan="{{ $rowspan }}">{{ $absence->student->Nom }}</td>
                                                <td rowspan="{{ $rowspan }}">{{ $absence->student->Prenom }}</td>
                                            @endif
                                            <td>{{ $absence->select_date }}</td>
                                            <td>{{ $absence->absent_retard }}</td>
                                            <td>{{ $absence->from_hour }}</td>
                                            <td>{{ $absence->to_hour }}</td>
                                            <td>{{ $absence->justifier }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </table>

                    </div>
                @endforeach

            </center>
        @endsection
        <?php else: ?>
            <center><h1 style="color: rgb(236, 103, 103);font-size: 28px; margin-top: 300px">PAGE EXPIRED</h1></center>
        <?php endif; ?>
    </body>

    </html>
