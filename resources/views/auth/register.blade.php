@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <section class="contactform-section">
        <h2>
            Регистрация
        </h2>
        <div class="info-container">
            <div class="contact-form">
                <form method="POST" action="{{ route('register') }}" class="auth-form">
                        @csrf
                        <div>
                            <label>Фамилия:</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name') <span>{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label>Имя:</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name') <span>{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label>Отчество:</label>
                            <input type="text" name="middle_name" value="{{ old('middle_name') }}" required>
                            @error('middle_name') <span>{{ $message }}</span> @enderror
                        </div>
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
                        <div>
                            <label>Подтверждение пароля:</label>
                            <input type="password" name="password_confirmation" required>
                        </div>
                        <button type="submit">Зарегистрироваться</button>
                    </form>
            </div>
        </div>
    </section>
@endsection