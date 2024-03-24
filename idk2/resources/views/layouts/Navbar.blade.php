<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <script src="bootstrap.bundle.js"></script>
    <title>Document</title>
    <style>
        /* Custom styles to ensure the navbar contents are centered */
        .navbar-nav {
            flex-direction: row;
            width: 100%;
            justify-content: center;
        }
        .navbar-nav .dropdown {
            margin-left: auto; /* Pushes the dropdown to the right */
            margin-right: 5%;
        }
        .nav-item:not(.dropdown) {
            margin-right: auto; /* Spacing between nav items */
            margin-left: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a href="/" class="nav-link">
                        <i class="fa-solid fa-house pe-2"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ajouter-absence') }}">Ajouter Absence
                        <i class="fa-solid fa-plus pe-2"></i>
                    </a>
                        
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('check-absence') }}">chack
                        <i class="fa-solid fa-eye pe-2"></i> 
                    </a>
                    

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/upload">upload
                        <i class="fa-solid fa-print pe-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/imprimer">imprimer</a>
                </li>
            
                <!-- Dropdown moved here to make it the last item, thus aligning it to the right -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                    
                </li>
            </ul>
        </div>
    </nav>

    @yield('contenu')


</body>
</html>
