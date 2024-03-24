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
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <label for="csv_file"> transaction file</label>
        <input type="file" name="csv_file" id="csv_file"><br><br>
        <button type="submit">Upload</button>
    </form>
    @endsection
    
</body>
</html>