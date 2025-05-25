@extends('layouts.app')

@section('title', 'Карта сайта')

@section('content')
<section class='section-single'>
    <h1 data-ru="Последние новости из мира недвижимости"
        data-en="Latest news from the real estate world">
        Карта сайта
    </h1>
    <p data-ru="Последний раз обновлено: Февраль, 2025"
            data-en="Last Time Updated: February, 2025"
    >Для более простой ориентации по сайту</p>
</section>

<section class='privacy-card'>
    <ul>
        <li><a href="{{ route('main-page') }}">Главная страница</a>
          <ul>
            <li><a href="{{ route('main-page') }}#hero-section">Слоган СтройИнвест</a></li>
            <li><a href="{{ route('main-page') }}#whyquicksend">Почему СтройИнвест?</a></li>
            <li><a href="{{ route('main-page') }}#contact">Контакты</a></li>
          </ul>
        </li>
        <li><a href="{{ route('news') }}#news">Новости компании</a></li>
        <li><a href="{{ route('about-company') }}">О компании</a>
            <ul>
              <li><a href="{{ route('about-company') }}#history">История</a></li>
              <li><a href="{{ route('about-company') }}#services">Услуги</a></li>
              <li><a href="{{ route('about-company') }}#awards">Награды</a></li>
            </ul>
        </li>
        <li><a href="{{ route('property') }}">Недвижимость</a></li>
        <li><a href="{{ route('location-map') }}">Cхема проезда</a></li>
      </ul>
</section>

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