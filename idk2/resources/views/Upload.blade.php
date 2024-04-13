<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .alert {
            padding: 20px;
            background-color: #f44336; 
            color: white;
            margin-bottom: 15px;
        }

        .alert-success {
            background-color: #4CAF50; 
        }

        .alert-danger {
            background-color: #f44336;
        }

        button {
            background-color: rgb(82, 145, 184); 
            color: white;
            padding: 10px 20px;
            margin: 10px 0;
            border: 5px blue;
            cursor: pointer;
            
        }

        button:hover {
            opacity: 0.8;
        }

        .supp, .upload {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 5px 4px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }

        label {
            ;
            margin-bottom: 10px;
            display: inline-block;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        #resetMessage {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            margin-top: 20px;
            display: none; 
            text-align: center;
        }
    </style>
</head>
<body>
    <?php if (Session::has('id')): ?>

    @extends('layouts.Navbar')
    @section('contenu')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('danger'))
        <div class="alert alert-danger">{{ session('danger') }}</div>
    @endif
    <div id="resetMessage" style="text-align: center; margin-top: 20px; color: green"></div>
    <div class="supp" style="text-align: center">
        <form action="{{ route('data.reset') }}" method="POST" onsubmit="return showResetWarning()">
            @csrf
            <label for=""> <h4><b>Supprimer tout !</b></h4></label> <br>
            <button type="submit" class="btn btn-danger ml-2">Supprimer</button>

        </form>
    </div><br><br>
    <div class="upload" style="text-align: center" >
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <label for="csv_file"> <h4><b>Importe fichier</b></h4></label><br>
            <input type="file" name="csv_file" id="csv_file"><br><br>
            <button  type="submit" class="btn btn-danger ml-2">Importer</button>
        </form>
    </div>

    @endsection
    <script>
        function showResetWarning() {
            const confirmed = confirm('ATTENTION : Cela réinitialisera votre base de données. Toutes les données seront perdues. Êtes-vous sûr ?');
            if (confirmed) {
                const messageDiv = document.getElementById('resetMessage');
                messageDiv.innerText = 'Réinitialisation des données, veuillez patienter...';
                messageDiv.style.display = 'block';

                setTimeout(function() {
                    messageDiv.style.display = 'none';
                }, 3000);
            }
            return confirmed;
        }
    </script>

<?php else: ?>
<center><h1 style="color: rgb(236, 103, 103);font-size: 28px; margin-top: 300px">PAGE EXPIRED</h1></center>
<?php endif; ?>
</body>
</html>
