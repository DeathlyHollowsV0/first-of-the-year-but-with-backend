<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <title>Document</title>
    <style>
       
        .navbar {
            padding: 0.5rem 1rem;
        }

      
        .navbar-nav {
            flex-direction: row;
            width: 100%;
            justify-content: center;
        }

        .navbar-nav .dropdown {
            margin-left: auto; 
            margin-right: 5%;
        }

        .nav-item:not(.dropdown) {
            margin-right: auto; 
            margin-left: auto;
        }

      
        .nav-link {
            color: #000; 
            transition: color 0.3s; 
        }

        .nav-link:hover, .nav-link:focus {
            color: #007bff; 
        }

    
        .navbar-logo {
            height: 60px; 
            width: 120px; 
            margin-left: -18%;
        }


  
        nav::after {
            content: '';
            display: block;
            width: 80%;
            height: 0.5px;
            background: #CCCCCC;
            position: absolute;
            bottom: 0;
            left: 10%;
        }
    </style>
</head>
<body>
  
    <nav id="cc" class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
           
            <p class="navbar-brand">
                
                <img src="/images/ofppt_logo-removebg-preview.png" alt="logo" class="navbar-logo">             
            </p>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedAbsence" aria-controls="navbarSupportedAbsence" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarSupportedAbsence">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home <i class="bi bi-house-door-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ajouter-absence') }}">Ajouter Absence <i class="bi bi-plus-circle-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('check-absence') }}">Check <i class="bi bi-eye-fill"></i></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/Imprimer">Imprimer <i class="bi bi-printer-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/graph">Graph <i class="bi bi-graph-up"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/upload">Upload <i class="bi bi-upload"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More 
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="cont" >
        @yield('contenu')
    </div>

</body>
</html>
