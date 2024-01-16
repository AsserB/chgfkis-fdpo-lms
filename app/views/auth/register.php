<?php
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

    <div class="form-auth">
        <a href="/" class="logo form-logo">
            <img src="/assets/img/logo.png" alt="Чурапчинский государственный институт физической культуры и спорта">
            <p>ЧГФКиС.ФДПО</p>
        </a>
        <form class="form" method="POST" action="/auth/store">
            <h1 class="form-title">Регистрация</h1>
            <div class="form-fields">
                <input type="text" placeholder="ФИО" id="username" name="username" required>
                <?php if (isset($error)) : tte($error) ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
                <input type="email" placeholder="Электронная почта" id="email" name="email" required>
                <input type="password" placeholder="Пароль" id="password" name="password" required>
                <input type="password" placeholder="Повторите пароль" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-button">
                <button type="submit" class="button">Зарегистрироваться</button>
            </div>

            <div class="form-info policy-info">
                <p>Создавая аккаунт, я соглашаюсь
                    c <a class="text-primary" href="/info/policy">"политикой обработки и хранения персональных данных"</a> и <a class="text-primary" href="/info/useragreement">"пользовательским соглашением"</a></p>
            </div>

            <div class="form-info">
                <p>Если у вас уже есть аккаунт
                    <a href="/auth/login"><?= htmlspecialchars("Авторизация") ?></a>
                </p>
            </div>
        </form>
    </div>

</body>