<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    
    <?php if (Session::has('id')): ?>
    <nav id="cc" class="navbar navbar-expand-lg navbar-light bg-white sticky-top ">
        <div class="container ">
            
            <p class="navbar-brand">
                
                <img src="/images/ofppt_logo-removebg-preview.png" alt="logo" class="navbar-logo">            
            </p>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedAbsence" aria-controls="navbarSupportedAbsence" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedAbsence">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/welcome">Page d'accueil <i class="bi bi-house-door-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ajouter-absence') }}">Ajouter Absence <i class="bi bi-plus-circle-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('absences.show') }}">Consulter les Absences <i class="bi bi-eye-fill"></i></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/Imprimer">Impression <i class="bi bi-printer-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/graph">Graphiques <i class="bi bi-graph-up"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/upload">Importer CSV <i class="bi bi-upload"></i></a>
                    </li>
                    <div>
                        <ul class="navbar-nav mx-auto rounded d-flex">
                            <li class="nav-item">
                                @if(Session::has('id'))
                                <a class="nav-link mx-2 text-danger  text-uppercase active" style="font-size: 13px;text-decoration: none; font-weight:bold;margin-top: 2px" onclick="confirmLogout()" href="#">Se déconnecter</a>    
                            @endif
                            <script>
                                function confirmLogout() {
                                    var confirmLogout = confirm("Are you sure you want to log out?");
                                    if (confirmLogout) {
                                        
                                        window.location.href = "/logout";
                                    } else {
                                    
                                    }
                                }
                            </script>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="bg-light">
        <br>
        <div class="container">
            @yield('contenu')
        </div>
    </div>

    <?php endif; ?>

</body>
</html>
