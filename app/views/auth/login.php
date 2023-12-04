<?php
ob_start();

$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ЧГИФКиС.ФДПО</title>
    <link rel="stylesheet" href="/assets/css/main.css" />

</head>

<body>

    <form class="form" method="POST" action="/auth/authenticate">
        <h1 class="form-title">Авторизация</h1>
        <div class="form-fields">
            <input type="email" placeholder="Электронная почта" id="email" name="email" required>
            <input type="password" placeholder="Пароль" id="password" name="password" required>
            <div class="form-button">
                <button type="submit" class="button">Войти</button>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" id="remember" name="remember">
                <span>запомнить меня</span>
            </div>
            <div class="form-info">
                <p>Если у вас нет аккаунта то пройти
                    <a href="/auth/register"><?= htmlspecialchars("Регистрацию") ?></a>
                </p>
            </div>

    </form>

</body>