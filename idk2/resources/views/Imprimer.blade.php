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


        @extends('layouts.Navbar')
        @section('contenu')
            <br>
            <center>
                <form method="GET" action="/Imprimer">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date">

                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date">




                    <label for="group">Group:</label>
                    <select id="group" name="group">
                        <option value="" selected disabled hidden></option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->Groupe }}">{{ $group->Groupe }}</option>
                        @endforeach
                    </select>

                    <input type="submit" value="Filter"> <input type="button" value="Print" onclick="printContent()">
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

                            @foreach ($groupAbsences as $studentName => $studentAbsences)
                                @foreach ($studentAbsences as $absence)
                                    <tr>
                                        <td>{{ $absence->student->Groupe }}</td>
                                        <td>{{ $absence->student->Nom }}</td>
                                        <td>{{ $absence->student->Prenom }}</td>
                                        <td>{{ $absence->select_date }}</td>
                                        <td>{{ $absence->absent_retard }}</td>
                                        <td>{{ $absence->from_hour }}</td>
                                        <td>{{ $absence->to_hour }}</td>
                                        <td>{{ $absence->justifier }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                    </div>
                @endforeach
            </center>
        @endsection


    </body>

    </html>
