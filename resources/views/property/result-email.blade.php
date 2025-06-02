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
        <p>Ваша заявка на квартиру по адресу: <strong>{{ $property->address }}</strong> рассмотрена.</p>
        <p>Статус: 
            <strong>
                @if ($propRequest->status === 'accepted')
                    ✅ Одобрено.
                @else
                    ❌ Отклонено.
                @endif
            </strong>
        </p><br>
        <p>Сообщение от администратора: <strong>{{ $propRequest->admin_message }}</strong></p>

        <p>
            <a href="{{ $url }}" class="button">Просмотреть свои заявки</a>
        </p>
        <div class="footer">
            <p>С уважением,<br>Команда СтройИнвест</p>
            <p><a href="mailto:stroyinvest@mail.ru">stroyinvest@mail.ru</a></p>
        </div>
    </div>
</body>
</html>
