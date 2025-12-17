<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pawfect Care</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Raleway:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS (scroll animations) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --dark-grey: #2C2C2C;
            --off-white: #F8F8F8;
            --cream: #FFF5E1;
            --accent: #DA2C38;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--cream);
            color: var(--dark-grey);
        }

        h1, h2, h3 {
            font-family: 'Raleway', sans-serif;
            font-weight: 700;
        }

        .navbar {
            background-color: var(--dark-grey);
            padding: 1rem;
        }

        .navbar-brand {
            color: var(--off-white) !important;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .navbar-brand img {
            height: 80px;
            width: auto;
            margin-right: 10px;
        }

        .nav-link {
            color: var(--off-white) !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--accent) !important;
        }

        .btn-accent {
            background-color: var(--accent);
            color: #ffffff;
            border-radius: 0;
        }

        .btn-outline-accent {
            border: 1px solid var(--accent);
            color: var(--accent);
            border-radius: 0;
        }

        .btn-outline-accent:hover {
            background-color: var(--accent);
            color: #fff;
        }

        .section {
            padding: 5rem 2rem;
        }
        
        .section h2 {
            color: var(--accent); /* or any color you prefer */
        }


        .card.bg-transparent {
            background-color: transparent !important;
            border: 2px solid var(--dark-grey); /* thick accent border */
            border-radius: 8px;
            box-shadow: none;
        }

        .card h5 {
            font-weight: 700;
            font-family: 'Raleway', sans-serif;
            margin-bottom: 1rem;
        }

        .filler-strip {
            background-image: url('{{ asset('images/filler.png') }}');
            background-repeat: repeat-x;
            background-size: 100px;   /* adjust size of icons */
            height: 80px;             /* adjust strip height */
            background-position: center;
        }

        .service-desc {
            font-size: 0.85rem;
            line-height: 1.0;
            color: var(--dark-grey);
            margin-bottom: 1rem;
        }

        .section-light {
            background-color: var(--cream);
        }

        footer {
            background-color: var(--dark-grey);
            color: var(--cream);
            text-align: center;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/logo 1.png') }}" alt="Pawfect Care Logo">
                Pawfect Care Pet Grooming Spa
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarNav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-accent">Log Out</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/services">Services</a></li>
                    <li class="nav-item">
                    @guest
                        <a href="{{ route('login') }}" class="nav-link">Appointments</a>
                    @endguest

                    @auth
                        <a href="{{ route('client.dashboard') }}" class="nav-link">Appointments</a>
                    @endauth
                </li>
                    <li class="nav-item"><a class="nav-link" href="/login">Sign in</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Sign up</a></li>
                @endauth
            </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container-fluid p-0">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>📞 (02) 123‑4567 | 📧 hello@pawfectcare.com | 📍 123 Cozy Lane, Metro Manila</p>
        <p>Mon–Sat: 9 AM – 6 PM | Sun: Closed</p>
        <p>Instagram | Facebook | TikTok</p>
        <small>&copy; {{ date('Y') }} Pawfect Care. All rights reserved.</small>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init({ duration: 1000, once: true });
    </script>
</body>
</html>