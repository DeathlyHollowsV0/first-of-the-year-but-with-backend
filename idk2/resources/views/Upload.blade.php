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
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
        }

        .alert-success {
            background-color: #4CAF50; /* Green */
        }

        .alert-danger {
            background-color: #f44336; /* Red */
        }

        button {
            background-color: rgb(82, 145, 184); /* Green */
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
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 20px;
            margin-top: 20px;
            display: none; /* Hidden by default */
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
            <label for=""> <h4><b>supprimer tout !</b></h4></label> <br><br>
            <button type="submit">Reset Data</button>

        </form>
    </div><br><br>
    <div class="upload" style="text-align: center" >
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <label for="csv_file"> <h4><b>importe fichier</b></h4></label>
            <input type="file" name="csv_file" id="csv_file"><br><br>
            <button  type="submit">Upload</button>
        </form>
    </div>

    @endsection
    <script>
        function showResetWarning() {
            const confirmed = confirm('WARNING: This will reset your database. All data will be lost. Are you sure?');
            if (confirmed) {
                const messageDiv = document.getElementById('resetMessage');
                messageDiv.innerText = 'Resetting data, please wait...';
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
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
        }

        .alert-success {
            background-color: #4CAF50; /* Green */
        }

        .alert-danger {
            background-color: #f44336; /* Red */
        }

        button {
            background-color: rgb(82, 145, 184); /* Green */
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
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 20px;
            margin-top: 20px;
            display: none; /* Hidden by default */
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
            <label for=""> <h4><b>supprimer tout !</b></h4></label> <br><br>
            <button type="submit">Reset Data</button>

        </form>
    </div><br><br>
    <div class="upload" style="text-align: center" >
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <label for="csv_file"> <h4><b>importe fichier</b></h4></label>
            <input type="file" name="csv_file" id="csv_file"><br><br>
            <button  type="submit">Upload</button>
        </form>
    </div>

    @endsection
    <script>
        function showResetWarning() {
            const confirmed = confirm('WARNING: This will reset your database. All data will be lost. Are you sure?');
            if (confirmed) {
                const messageDiv = document.getElementById('resetMessage');
                messageDiv.innerText = 'Resetting data, please wait...';
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
