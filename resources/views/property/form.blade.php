@extends('layouts.app')

@section('title', 'Заявка на квартиру')

@section('content')
    <section class="contactform-section">
        <h2>
            Заявка на квартиру {{ $property->address }}
        </h2>
        <div class="info-container">
            <div class="contact-form">
                <form method="POST" action="{{ route('submit.property.form') }}" class="auth-form">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">

                    <div>
                        <label>Сообщение:</label>
                        <textarea class="message-textarea" name="message" placeholder="Расскажите о себе и ваших требованиях к квартире..." value="{{ old('message') }}"></textarea>
                        @error('message') <span>{{ $message }}</span> @enderror
                    </div>
                    <button type="submit">Оставить заявку</button>
                </form>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-us-section" role="article">
        <div class="section-container">
            <h2>Отмена заявок!</h2>
            <div class="contact-content">
                <i class="fas fa-envelope-open-text fa-3x"></i>
                <p class="highlight">{{ $adminEmail }}</p>
                <p>
                    Пишите на почту администратору при желании отменить свои заявки
                </p>
            </div>
            <div class="video-container">
                <video src="{{ asset('video/5.webm') }}" class="animation" autoplay muted loop loading="lazy" preload="none"></video>
            </div>
        </div>
    </section>
@endsection