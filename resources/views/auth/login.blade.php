@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <section class="contactform-section">
        <h2>
            Вход
        </h2>
        <div class="info-container">
            <div class="contact-form">
                <form method="POST" action="{{ route('login') }}" class="auth-form">
                        @csrf
                        <div>
                            <label>Email:</label>
                            <input type="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <span>{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label>Пароль:</label>
                            <input type="password" name="password" required>
                            @error('password') <span>{{ $message }}</span> @enderror
                        </div>
                        <button type="submit">Войти</button>
                    </form>
            </div>
        </div>
    </section>
@endsection