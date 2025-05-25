<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Получение заявки на квартиру</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Здравствуйте, {{ $user->last_name . " " . $user->first_name . " " . $user->middle_name }}!</h1>
        <p>Получена заявка на квартиру: <strong>ID {{ $property->id }}</strong>! Необходимо её рассмотреть.</p>
        <p>Адрес квартиры: <strong>{{ $property->address }}</strong></p><br>
        <p>Информация о пользователе:<br> <strong>- Имя {{ $requestUser->last_name . " " . $requestUser->first_name . " " . $requestUser->middle_name }}<br>- Email: {{ $requestUser->email }}</strong></p><br>
        <p>Сообщение от пользователя: <strong>{{ $propRequest->message }}</strong></p>

        <p>
            <a href="{{ $url }}" class="button">Просмотреть заявку</a>
        </p>
        <div class="footer">
            <p>С уважением,<br>Команда СтройИнвест</p>
            <p><a href="mailto:stroyinvest@mail.ru">stroyinvest@mail.ru</a></p>
        </div>
    </div>
</body>
</html>
