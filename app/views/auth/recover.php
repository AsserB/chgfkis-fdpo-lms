<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ЧГИФКиС.ФДПО</title>
    <link rel="stylesheet" href="/assets/css/main.css" />

</head>

<div class="form-auth">
    <a href="/" class="logo form-logo">
        <img src="/assets/img/logo.png" alt="Чурапчинский государственный институт физической культуры и спорта">
        <p>ЧГФКиС.ФДПО</p>
    </a>
    <form class="form" method="POST" action="/auth/recoverpassword">
        <h1 class="form-title">Забыли пароль?</h1>
        <div class="form-info">
            <p>Ничего страшного, введите свой email, и мы вышлем Вам инструкции по восстановлению пароля.</p>
        </div>
        <div class="form-fields">
            <input type="email" placeholder="Электронная почта" id="email" name="email" required>
            <div class="form-button">
                <button type="submit" class="button">Восстановить пароль</button>
            </div>
            <div class="form-info">
                <p>Письмо с инструкцией может попасть в <strong>СПАМ</strong> обязательно проверьте</p>
            </div>
    </form>
</div>