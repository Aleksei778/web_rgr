<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    crossorigin="anonymous">

    <link rel="preload" href="{{ asset('png/logo-no-background.png') }}" as="image" />
    <link rel="shortcut icon" href="{{ asset('png/energy.png') }}" type="image/x-icon" />
    <title>Подтверждение Email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            font-family: 'Arial', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #1a73e8;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            margin: 10px 0;
            background-color: #1a73e8;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #599af0;
        }
        .logout-link {
            display: inline-block;
            margin-top: 15px;
            color: #1a73e8;
            text-decoration: none;
            font-size: 14px;
        }
        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Подтвердите ваш Email</h1>
        <p>Мы отправили вам письмо с ссылкой для подтверждения.<br>Пожалуйста, проверьте почту.</p>

        @if (session('message'))
            <p><strong>{{ session('message') }}</strong></p>
        @endif

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="button">Отправить повторно</button>
        </form>

        <a href="{{ route('logout') }}" class="logout-link">Выйти</a>
    </div>
</body>
</html>
