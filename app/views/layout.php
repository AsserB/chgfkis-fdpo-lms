<?php
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "Вы не вошли в систему";
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <!-- encoding -->
    <meta charset="UTF-8" />
    <!-- Mobile support -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Title and SEO -->
    <title>ЧГФКиС.ФДПО</title>
    <meta name="description" content="Описание страницы" />
    <meta name="keywords" content="ключевые слова, фразы" />

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/main.css" />

</head>

<body>

    <div class="wrapper">
        <aside class="sidebar">
            <a href="/" class="logo-sidebar">
                <img src="/assets/img/logo.png" alt="Чурапчинский государственный институт физической культуры и спорта">
                <p>ЧГФКиС.ФДПО</p>
            </a>
            <div class="sidebar-group">
                <p class="sidbar-group-title"><?= $user_email ?></p>
                <ul class="sidebar-list">
                    <!-- <li class="sidebar-item">
                        <img src="/assets/img/icon/dashboards.png" alt="Дашборд">
                        <a href="#">Дашборд</a>
                    </li> -->
                    <li class="sidebar-item">
                        <img src="/assets/img/icon/scholarship.png" alt="Мои курсы">
                        <a href="/lms">Моё обучение</a>
                    </li>
                    <li class="sidebar-item">
                        <img src="/assets/img/icon/user.png" alt="Настройки профиля">
                        <a href="/users/userdata">Мои данные</a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-group">
                <p class="sidbar-group-title">ФДПО</p>
                <ul class="sidebar-list">
                    <li class="sidebar-item">
                        <img src="/assets/img/icon/list.png" alt="Курсы повышения квалификации">
                        <a href="/lms/kpk">Курсы повышения квалификации</a>
                    </li>
                    <li class="sidebar-item">
                        <img src="/assets/img/icon/studying.png" alt="Профессиональная переподготовка">
                        <a href="#">Профессиональная переподготовка</a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-group">
                <p class="sidbar-group-title">Кураторство</p>
                <ul class="sidebar-list">
                    <li class="sidebar-item users">
                        <img src="/assets/img/icon/users.png" alt="Пользователи">
                        <a href="#">Пользователи</a>
                    </li>
                    <li class="sidebar-item groups">
                        <img src="/assets/img/icon/groups.png" alt="Группы">
                        <a href="#">Группы</a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-group">
                <p class="sidbar-group-title">Aдминистративная панель</p>
                <ul class="sidebar-list">
                    <li class="sidebar-item">
                        <a href="/users">Пользователи</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/pages">Страницы</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/roles">Роли</a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-group">
                <p class="sidbar-group-title">Панель авторизации</p>
                <ul class="sidebar-list">
                    <?php if ($user_role == false) : ?>
                        <li class="sidebar-item">
                            <a href="/auth/login">Вход</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/auth/register">Регистрация</a>
                        </li>
                    <?php endif ?>
                    <?php if ($user_role == true) : ?>
                        <li class="sidebar-item">
                            <a href="/auth/logout">Выйти</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </aside>
        <div class="page">
            <?php echo $content; ?>
        </div>
    </div>

    <script src="/assets/scripts/main.js"></script>

</body>

</html>