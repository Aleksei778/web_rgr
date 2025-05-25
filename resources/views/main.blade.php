@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <!-- Hero Section -->
    <section id="hero-section" class="hero-section" role="article">
        <div class="section-container">
            <div class="hero-content">
                <h1 class="section-title">СтройИнвест</h1>
                <p>
                    СтройИнвест - это компания, которая занимается продажей недвижимости более 20 лет. С нами мечта об уютном жилье может стать реальностью!
                </p>
                <img src="{{ asset('png/image.png') }}" alt="chill-guy" class="chill-guy">
                <img src="{{ asset('png/image (1) (1).png') }}" alt="chill-girl" class="chill-girl">
            </div>
        </div>
    </section>

    <!-- Why StroiInvest Section -->
    <section id="whyquicksend" class="whyquicksend-section" role="article">
        <div class="section-container">
            <h2>Почему СтройИнвест?</h2>
            <div class="section-description">
                "Мы помогаем найти идеальную недвижимость: от уютных квартир до элитных коттеджей."
            </div>
            <div class="paper-plane">
                <img src="{{ asset('png/Group 1.png') }}" alt="paper plane" loading="lazy"/>
            </div>
            <div class="advantage-container">
                <div class="advantage">
                    <i class="fas fa-tachometer-alt"></i>
                    <h3>Количество объектов</h3>
                    <p>Широкий выбор объектов на любой вкус</p>
                </div>
                <div class="advantage">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Безопасность</h3>
                    <p>Безопасные, прозрачные сделки со всеми необходимыми документами</p>
                </div>
                <div class="advantage">
                    <i class="fas fa-chart-line"></i>
                    <h3>Индивидуальный подход</h3>
                    <p>С каждым клиентом проводится обширная индивидуальная работа</p>
                </div>
                <div class="advantage">
                    <i class="fas fa-tools"></i>
                    <h3>Профессиональная поддержка</h3>
                    <p>Наша поддержка всегда с вами на связи</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-us-section" role="article">
        <div class="section-container">
            <h2>Свяжитесь с нами!</h2>
            <div class="contact-content">
                <i class="fas fa-envelope-open-text fa-3x"></i>
                <p class="highlight">stroyinvest@mail.ru</p>
                <p>
                    Отправляйте нам предложения по улучшению сайта, предложения о работе и сообщения об ошибках!
                </p>
            </div>
            <div class="video-container">
                <video src="{{ asset('video/5.webm') }}" class="animation" autoplay muted loop loading="lazy" preload="none"></video>
            </div>
        </div>
    </section>
@endsection

