<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Подтверждение email</title>
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
        <h1>Здравствуйте, {{ $user->first_name }}!</h1>
        <p>Спасибо за регистрацию на сайте <strong>СтройИнвест</strong>!</p>
        <p>Чтобы подтвердить ваш email, нажмите на кнопку ниже:</p>
        <p>
            <a href="{{ $url }}" class="button">Подтвердить email</a>
        </p>
        <p>Если вы не регистрировались, просто проигнорируйте это письмо.</p>
        <div class="footer">
            <p>С уважением,<br>Команда СтройИнвест</p>
            <p><a href="mailto:stroyinvest@mail.ru">stroyinvest@mail.ru</a></p>
        </div>
    </div>
</body>
</html>
