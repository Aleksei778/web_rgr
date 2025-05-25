@extends('layouts.admin')

@section('title', 'Главная страница - Админка')

@section('content')
    <!-- Hero Section -->
    <section id="hero-section" class="hero-section" role="article">
        <div class="section-container">
            <div class="hero-content">
                <h1 class="section-title">СтройИнвест - Панель администратора</h1>
                <p>
                    Вы находитесь на администраторской части сайта СтройИнвест!
                </p>
                <img src="{{ asset('png/image.png') }}" alt="chill-guy" class="chill-guy">
                <img src="{{ asset('png/image (1) (1).png') }}" alt="chill-girl" class="chill-girl">
            </div>
        </div>
    </section>
@endsection

