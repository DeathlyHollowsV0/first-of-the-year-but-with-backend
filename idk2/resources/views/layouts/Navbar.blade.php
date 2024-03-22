<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ session('theme', 'dark') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Your Logo</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="/" class="sidebar-link">
                            <i class="fa-solid fa-house pe-2"></i>Home
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('ajouter-absence') ? 'active' : '' }}">
                        <a href="{{ route('ajouter-absence') }}" class="sidebar-link">
                            <i class="fa-solid fa-plus pe-2"></i> Ajouter Absence
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('check-absence') ? 'active' : '' }}">
                        <a href="{{ route('check-absence') }}" class="sidebar-link">
                            <i class="fa-solid fa-eye pe-2"></i> Check Absence
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <div class="navbar-controls d-flex justify-content-end w-100">
                    <!-- Theme Toggle Button -->
                    <div class="theme-toggle-wrapper me-2">
                        <button id="theme-toggle" class="theme-toggle btn btn-sm">
                            <i class="fa-regular fa-moon"></i>
                            <i class="fa-regular fa-sun"></i>
                        </button>
                    </div>
                    <!-- Profile Image Dropdown -->
                    <div class="nav-item dropdown">
                        
                            <img src="{{ asset('images/profile.jpg') }}" class="rounded-circle" alt="Profile Image" style="width: 40px; height: 40px;">
                        
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::check())
                                {{ Auth::user()->name }}
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </ul>
                        
    
                        
                    </div>
                </div>
            </nav>
            
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    @yield('contenu')
                </div>
            </main>
            <footer class="footer" style="text-align: center">
                copiright@
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bootstrap Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Your Logo</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="/" class="sidebar-link">
                            <i class="fa-solid fa-house pe-2"></i>Home
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('ajouter-absence') ? 'active' : '' }}">
                        <a href="{{ route('ajouter-absence') }}" class="sidebar-link">
                            <i class="fa-solid fa-plus pe-2"></i> Ajouter Absence
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('check-absence') ? 'active' : '' }}">
                        <a href="{{ route('check-absence') }}" class="sidebar-link">
                            <i class="fa-solid fa-eye pe-2"></i> Check Absence
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <div class="navbar-controls d-flex justify-content-end w-100">
                    <!-- Theme Toggle Button -->
                    <div class="theme-toggle-wrapper me-2">
                        <button id="theme-toggle" class="theme-toggle btn btn-sm">
                            <i class="fa-regular fa-moon"></i>
                            <i class="fa-regular fa-sun"></i>
                        </button>
                    </div>
                    <!-- Profile Image Dropdown -->
                    <div class="nav-item dropdown">
                        
                            <img src="{{ asset('images/profile.jpg') }}" class="rounded-circle" alt="Profile Image" style="width: 40px; height: 40px;">
                        
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::check())
                                {{ Auth::user()->name }}
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </ul>
                        
    
                        
                    </div>
                </div>
            </nav>

        <div class="main">
            <main class="content px-3 py-2">
                @yield('content')
            </main>
            <footer class="footer" style="text-align: center">
                copyright@
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
--}}
</body>
</html> 

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const themeToggleButton = document.getElementById('theme-toggle');
            themeToggleButton.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                const themeIcon = themeToggleButton.querySelector('i');
                if (document.body.classList.contains('dark-mode')) {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                } else {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                }
            });
        });
    </script>
</body>
</html>
