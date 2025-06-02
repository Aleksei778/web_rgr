<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="СтройИнвест - это компания по продаже недвижимости, которой можно доверять" />
    <title>@yield('title', 'СтройИнвест')</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          crossorigin="anonymous">

    <link rel="preload" href="{{ asset('png/logo-no-background.png') }}" as="image" />
    <link rel="shortcut icon" href="{{ asset('png/energy.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/styles.css', 'resources/css/news.css', 'resources/css/auth.css', 'resources/css/property.css', 'resources/css/requests.css','resources/css/stylesprofile.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/news.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="stylesheet" href="{{ asset('css/property.css') }}">
        <link rel="stylesheet" href="{{ asset('css/stylesprofile.css') }}">
        <link rel="stylesheet" href="{{ asset('css/requests.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
</head>
<body>
    <div class="animation-wrapper">
        <div class="animation-area">
            <ul class="box-area"></ul>
        </div>
    </div>

    <div class="content-wrapper">
        <!-- Header -->
        <header class="header">
            <a href="/" aria-label="stroiinvest.com">
                <img src="{{ asset('svg/logo-stroi.svg') }}" alt="StroiInvest Логотип" class="logo" loading="eager" />
            </a>
            <p class="logo-phrase">СтройИнвест</p>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/news">Новости</a></li>
                    <li><a href="/about">О компании</a></li>
                    <li><a href="/property">Недвижимость</a></li>
                    <li><a href="/location-map">Схема проезда</a></li>
                    <li><a href="/site-map">Карта сайта</a></li>
                </ul>
            </nav>
            <div class="header-right">
                <div class="button-group">
                    @if (Route::currentRouteName() === 'register.form')
                        <a href="{{ route('login.form') }}" class="button signin-button">Войти</a>
                    @elseif (Route::currentRouteName() === 'login.form')
                        <a href="{{ route('register.form') }}" class="button signin-button">Регистрация</a>
                    @elseif (Route::currentRouteName() === 'profile')
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="button signin-button">Выйти</button>
                        </form>
                    @else
                        @if (Auth::check())
                            <a href="{{ route('profile') }}" class="button profile-button"><i class="fas fa-user-circle"></i></a>
                        @else
                            <a href="{{ route('login.form') }}" class="button signin-button">Войти / Регистрация</a>
                        @endif
                    @endif                
                </div>
            </div>
        </header>

        <!-- Контент страницы -->
        <main class="main">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-left">
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-telegram"></i>
                            <span>Telegram</span>
                        </a>
                    </div>
                </div>
                <div class="footer-center">
                    <p>©<span id="current-year"></span> StroiInvest, inc. Все права защищены.</p>
                </div>
                <div class="footer-right">
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Подключаем JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

    @yield('scripts')
</body>
</html>
