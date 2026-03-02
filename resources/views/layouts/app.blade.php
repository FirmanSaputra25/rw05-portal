<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Portal RW 05')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bs-primary: #4F46E5;
            --bs-primary-hover: #4338CA;
            --bs-secondary: #64748B;
            --bs-light-gray: #F8FAFC;
            --bs-dark-gray: #0F172A;
            --bs-accent-yellow: #F59E0B;
            --primary-blue: #3B82F6;
            --success-green: #10B981;
            --light-bg: #F8FAFC;
            --dark-text: #0F172A;
            --border-color: #E2E8F0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden !important; /* Prevent horizontal scroll */
            width: 100%;
            position: relative;
        }

        /* Glassmorphism Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            z-index: 1030;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--bs-primary), #EC4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.02);
        }

        .nav-link {
            font-weight: 600;
            color: var(--bs-secondary) !important;
            position: relative;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
        }

        .nav-link:hover {
            color: var(--bs-primary) !important;
            background: rgba(79, 70, 229, 0.05);
        }

        .nav-link.active {
            color: var(--bs-primary) !important;
            font-weight: 700;
            background: rgba(79, 70, 229, 0.08);
        }

        /* Hero / Section Title */
        .section-title {
            font-weight: 800;
            font-size: 2.25rem;
            color: var(--dark-text);
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            letter-spacing: -0.5px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 6px;
            background: linear-gradient(90deg, #4F46E5, #0ea5e9);
            border-radius: 6px;
        }

        /* Modern Typography & Spacing */
        h1, h2, h3, h4, h5, h6 {
            letter-spacing: -0.02em;
        }

        .container {
            max-width: 1240px;
        }

        /* Modern Card with Hover Defaults */
        .card, .card-custom, .card-news {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s ease;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card:hover, .card-custom:hover, .card-news:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.12);
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            transition: transform 0.6s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--dark-text);
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .card-text {
            color: var(--bs-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            flex-grow: 1;
        }

        .card-footer {
            background-color: transparent;
            border-top: 1px solid var(--border-color);
            padding: 1rem 1.5rem;
            font-weight: 500;
            color: var(--bs-secondary);
            font-size: 0.85rem;
            margin-top: auto;
        }

        /* Primary Button Style */
        .btn-primary {
            background: linear-gradient(135deg, var(--bs-primary), var(--primary-blue));
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: white;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
            background: linear-gradient(135deg, var(--bs-primary-hover), var(--primary-blue));
            color: white;
        }

        /* Carousel Enhancements */
        .carousel-item img {
            height: 480px;
            width: 100%;
            object-fit: cover;
            filter: brightness(0.65);
            transition: filter 0.5s ease, transform 5s ease;
            border-radius: 20px;
        }

        .carousel-item:hover img {
            filter: brightness(0.85);
            transform: scale(1.02);
        }

        .carousel-caption {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            left: 0;
            right: 0;
            bottom: 0;
            padding: 3rem 2rem 2rem 2rem;
            text-align: left;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .carousel-caption h5 {
            font-size: 2.25rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }
        
        .carousel-caption p {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.9);
            text-shadow: 0 2px 8px rgba(0,0,0,0.5);
        }

        .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: white;
            opacity: 0.5;
            transition: all 0.3s ease;
            margin: 0 6px;
        }

        .carousel-indicators .active {
            opacity: 1;
            transform: scale(1.2);
            background-color: var(--bs-primary);
        }

        /* Announcement Card / Sidebar element */
        .announcement-card {
            background: white;
            border-left: 6px solid var(--bs-primary);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: block;
            color: var(--dark-text);
        }

        .announcement-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.05), transparent);
            z-index: 0;
            pointer-events: none;
        }

        .announcement-card:hover {
            transform: translateX(5px);
            color: var(--dark-text);
        }

        .announcement-card > * {
            position: relative;
            z-index: 1;
        }

        /* Content Article (News Detail) */
        article.content {
            background: white;
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            flex: 3;
        }

        .main-grid {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
        }

        /* News Image Detail */
        .news-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 16px;
            margin: 2rem 0;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        /* News Typography */
        .content p {
            font-size: 1.15rem;
            line-height: 1.8;
            color: #334155;
            margin-bottom: 1.5rem;
        }

        h1.news-title {
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--bs-dark-gray);
            letter-spacing: -0.5px;
            position: relative;
        }

        /* Back Button */
        .btn-back {
            background: white;
            border: 1px solid var(--border-color);
            color: var(--dark-text);
            font-weight: 600;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-back:hover {
            transform: translateX(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            color: var(--bs-primary);
        }

        /* Sidebar Related container */
        aside.sidebar-related {
            flex: 1;
            background: white;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 100px;
        }

        .related-title {
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--bs-dark-gray);
            position: relative;
        }

        .related-list {
            padding: 0;
            margin: 0;
        }

        .related-list li {
            padding: 1rem;
            border-radius: 12px;
            transition: background-color 0.3s ease;
            margin-bottom: 0.5rem;
        }

        .related-list li:hover {
            background-color: var(--light-bg);
        }

        /* Comments Form & Card */
        .comment-card {
            background: var(--light-bg);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .comment-card:hover {
            background: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            background-color: var(--light-bg);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: white;
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        /* Schedule specific enhancements */
        .card-header {
            background: linear-gradient(135deg, var(--success-green), #059669);
            color: white;
            font-weight: 700;
            font-size: 1.35rem;
            border-radius: 20px 20px 0 0 !important;
            padding: 1.5rem;
            border-bottom: none;
        }

        .list-group-item {
            padding: 1.25rem 1.5rem;
            border-color: var(--border-color);
            transition: all 0.3s ease;
            position: relative;
        }

        .list-group-item:last-child {
            border-radius: 0 0 20px 20px;
        }

        .list-group-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: transparent;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: var(--light-bg);
        }
        
        .list-group-item:hover::before {
            background-color: var(--success-green);
        }

        .badge-location {
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary-blue);
            padding: 0.5em 1.2em;
            border-radius: 20px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Fix Main Layout Margins */
        main.container {
            margin-top: 2rem;
            margin-bottom: 4rem;
        }

        @media (max-width: 992px) {
            .main-grid {
                flex-direction: column;
            }
            article.content {
                padding: 1.5rem;
                flex: none;
                width: 100%;
            }
            aside.sidebar-related {
                width: 100%;
                position: static;
            }
        }

        /* Mobile Bottom Nav - Rock Solid Fixed Position */
        @media (max-width: 991px) {
            .mobile-bottom-nav {
                position: fixed !important;
                bottom: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 70px !important;
                background: #ffffff !important;
                display: flex !important;
                flex-direction: row !important;
                align-items: stretch !important;
                justify-content: space-around !important;
                margin: 0 !important;
                padding: 0 5px env(safe-area-inset-bottom) 5px !important;
                box-shadow: 0 -8px 30px rgba(0, 0, 0, 0.12) !important;
                z-index: 99999 !important;
                border-top: 1px solid #e2e8f0 !important;
                box-sizing: border-box !important;
                overflow: hidden !important;
            }

            .mobile-bottom-nav a {
                color: #64748b !important;
                text-decoration: none !important;
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                font-size: 10px !important;
                font-weight: 700 !important;
                flex: 1 !important;
                min-width: 0 !important;
                height: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
                border: none !important;
            }

            .mobile-bottom-nav a i {
                font-size: 22px !important;
                margin-bottom: 2px !important;
                line-height: 1 !important;
            }

            .mobile-bottom-nav a.active {
                color: var(--bs-primary) !important;
            }

            .mobile-bottom-nav a span {
                display: block !important;
                width: 100% !important;
                text-align: center !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
                white-space: nowrap !important;
            }

            body {
                padding-bottom: 75px !important; 
            }
        }

        /* Desktop specific: Hide the mobile nav container always */
        @media (min-width: 992px) {
            .mobile-bottom-nav {
                display: none !important;
            }
        }
        
        /* Smooth scrolling for better feel */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 5px;
            border: 2px solid #f1f5f9;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Page Transitions */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Mobile Bottom Navigation (Visible on Mobile & Tablet) -->
    <div class="mobile-bottom-nav d-lg-none">
        <a href="{{ route('news.index') }}" class="@if(request()->routeIs('news.index') || request()->routeIs('home')) active @endif">
            <i class="bi bi-house-door{{ (request()->routeIs('news.index') || request()->routeIs('home')) ? '-fill' : '' }}"></i>
            <span>Berita</span>
        </a>
        <a href="{{ route('schedule.index') }}" class="@if(request()->routeIs('schedule.index')) active @endif">
            <i class="bi bi-calendar2-heart{{ request()->routeIs('schedule.index') ? '-fill' : '' }}"></i>
            <span>Jadwal</span>
        </a>
        <a href="{{ route('agenda.index') }}" class="@if(request()->routeIs('agenda.index')) active @endif">
            <i class="bi bi-calendar-event{{ request()->routeIs('agenda.index') ? '-fill' : '' }}"></i>
            <span>Agenda</span>
        </a>
        <a href="{{ route('report.create') }}" class="@if(request()->routeIs('report.create')) active @endif">
            <i class="bi bi-megaphone{{ request()->routeIs('report.create') ? '-fill' : '' }}"></i>
            <span>Aduan</span>
        </a>
        <a href="{{ route('galeri.index') }}" class="@if(request()->routeIs('galeri.index')) active @endif">
            <i class="bi bi-images"></i>
            <span>Galeri</span>
        </a>
    </div>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('news.index') }}">Portal RW 05</a>

            {{-- Desktop menu: hidden on mobile --}}
            <div class="d-none d-lg-flex" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-2">
                        <a href="{{ route('news.index') }}" class="nav-link @if(request()->routeIs('news.index') || request()->routeIs('home')) active @endif">Berita</a>
                    </li>
                    <li class="nav-item me-2">
                        <a href="{{ route('schedule.index') }}" class="nav-link @if(request()->routeIs('schedule.index')) active @endif">Jadwal</a>
                    </li>
                    <li class="nav-item me-2">
                        <a href="{{ route('agenda.index') }}" class="nav-link @if(request()->routeIs('agenda.index')) active @endif">Agenda</a>
                    </li>
                    <li class="nav-item me-2">
                        <a href="{{ route('report.create') }}" class="nav-link @if(request()->routeIs('report.create')) active @endif">Aduan</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('galeri.index') }}" class="nav-link @if(request()->routeIs('galeri.index')) active @endif">Galeri</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mb-5">
        @yield('content')
    </main>

    <footer class="bg-white py-5 mt-5 border-top shadow-sm">
        <div class="container">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-md-4 text-center text-md-start">
                    <a class="navbar-brand mb-2 d-block" href="{{ route('news.index') }}">Portal RW 05</a>
                    <p class="text-secondary small">Menuju lingkungan yang harmonis, transparan, dan terdigitalisasi untuk seluruh warga RW 05.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="text-secondary hover-primary"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="text-secondary hover-primary"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#" class="text-secondary hover-primary"><i class="bi bi-whatsapp fs-4"></i></a>
                    </div>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <h6 class="fw-bold mb-3">Pintasan</h6>
                    <ul class="list-unstyled small mb-0">
                        <li><a href="{{ route('news.index') }}" class="text-secondary text-decoration-none">Berita Terkini</a></li>
                        <li><a href="{{ route('schedule.index') }}" class="text-secondary text-decoration-none">Jadwal Posyandu</a></li>
                        <li><a href="{{ route('report.create') }}" class="text-secondary text-decoration-none">Saran & Aduan</a></li>
                    </ul>
                </div>
            </div>
            <hr class="opacity-10">
            <div class="text-center text-muted small pt-2">
                <p class="mb-0 fw-medium">&copy; {{ date('Y') }} Portal RW 05. Dikelola oleh Pengurus RW 05.</p>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>