@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <!-- Hero Section -->
    <section id="hero-section" class="hero-section" role="article">
        <div class="section-container">
            <div class="hero-content">
                <h1 class="section-title">{{ __('main.name') }}</h1>
                <p>
                    {{ __('main.devis') }}
                </p>
                <img src="{{ asset('png/image.png') }}" alt="chill-guy" class="chill-guy">
                <img src="{{ asset('png/image (1) (1).png') }}" alt="chill-girl" class="chill-girl">
            </div>
        </div>
    </section>

    <!-- Why StroiInvest Section -->
    <section id="whyquicksend" class="whyquicksend-section" role="article">
        <div class="section-container">
            <h2>{{ __('main.why.question') }}</h2>
            <div class="section-description">
                {{ __('main.why.answer') }}
            </div>
            <div class="paper-plane">
                <img src="{{ asset('png/Group 1.png') }}" alt="paper plane" loading="lazy"/>
            </div>
            <div class="advantage-container">
                @foreach(__('main.slogans') as $slogan)
                <div class="advantage">
                    <i class="{{ $slogan['icon'] }}"></i>
                    <h3>{{ $slogan['title'] }}</h3>
                    <p>{{ $slogan['content'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-us-section" role="article">
        <div class="section-container">
            <h2>{{ __('main.email_us') }}</h2>
            <div class="contact-content">
                <i class="fas fa-envelope-open-text fa-3x"></i>
                <p class="highlight">stroyinvest@mail.ru</p>
                <p>
                    {{ __('main.suggest') }}
                </p>
            </div>
            <div class="video-container">
                <video src="{{ asset('video/5.webm') }}" class="animation" autoplay muted loop loading="lazy" preload="none"></video>
            </div>
        </div>
    </section>
@endsection

