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
    <form class="form" method="POST" action="/auth/changepasswordbyuser">
        <h1 class="form-title">Восстановление пароля</h1>
        <div class="form-fields">
            <label for="password">Код подтверждения</label>
            <input type="text" id="temp_passwords" name="temp_password" required>
            <label for="password">Новый пароль</label>
            <input type="password" id="password" name="password" required>
            <div class="form-button">
                <button type="submit" class="button">Изменить пароль</button>
            </div>
    </form>
</div>