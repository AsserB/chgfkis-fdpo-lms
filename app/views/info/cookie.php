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
    <title>Политика обработки файлов cookie</title>
    <link rel="stylesheet" href="/assets/css/main.css" />

    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon/favicon-16x16.png">

</head>

<body>
    <div class="container">
        <header class="header">
            <div class="header-row">
                <a href="/" class="logo">
                    <img src="/assets/img/logo.png" alt="Факультет дополнительного образования">
                    <p>ФГБОУ ВО ЧГИФКиС</p>
                </a>
                <nav class="nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a class="nav-link" href="#courses">Все курсы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sports">Спорт норма жизни</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contacts">Контакты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#docs">Документы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#docs">Информация</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-row">
                <div class="header-auth">
                    <?php if ($user_role == false) : ?>
                        <a href="/auth/login">Вход</a>
                        <a href="/auth/register">Регистрация</a>
                    <?php endif ?>
                    <?php if ($user_role == true) : ?>
                        <a href="/lms"><?= $user_email ?></a>
                    <?php endif ?>
                </div>
            </div>
        </header>

        <div class="content__main">
            <div class="container-content">
                <header class="content-header">
                    <h1 class="title">Политика обработки файлов cookie </h1>
                    <p class="text">
                    <p>Посещая сайт ФГБОУ ВО Чурапчинский государственный институт физической культуры и спорта "chgifkis-fdpo.ru" в сети «Интернет», вы соглашаетесь с настоящей политикой, в том числе с тем, что "ФГБОУ ВО Чурапчинский государственный институт физической культуры и спорта" может использовать файлы cookie и иные данные для их последующей обработки системами Яндекс.Метрика.</p>
                    </p>
                    <p class="text">
                        <span class="marker2">Что такое файлы cookie</span>
                    <p>Файлы cookie – текстовые файлы небольшого размера, которые сохраняются на вашем устройстве (персональном компьютере, ноутбуке, планшете, мобильном телефоне и т.п.), когда вы посещаете сайты в сети «Интернет». Кроме того, при посещении сайта "ФГБОУ ВО Чурапчинский государственный институт физической культуры и спорта" в сети «Интернет» происходит автоматический сбор иных данных, в том числе: технических характеристик устройства, IP-адреса, информации об используемом браузере и языке, даты и времени доступа к сайту, адресов запрашиваемых страниц сайта и иной подобной информации.</p>
                    <p class="text">
                        <span class="marker2">Какие виды файлов cookie используются</span>
                    <p>В зависимости от используемых вами браузера и устройства используются разные наборы файлов cookie, включающие в себя строго необходимые, эксплуатационные, функциональные и аналитические файлы cookie.</p>
                    </p>
                    <p class="text">
                        <span class="marker2">Для чего могут использоваться файлы cookie</span>
                    <p>При посещении вами сайта "ФГБОУ ВО Чурапчинский государственный институт физической культуры и спорта" "chgifkis-fdpo.ru" в сети «Интернет» файлы cookie могут использоваться для:</p>
                    <p>1. обеспечения функционирования и безопасности сайта;</p>
                    <p>2. улучшения качества сайта;</p>
                    <p>3. регистрации в веб - приложении "chgifkis-fdpo.ru";</p>
                    <p>4. предоставлении вам информации об ФГБОУ ВО Чурапчинский государственный институт физической культуры и спорта "chgifkis-fdpo.ru", его продукте и услугах;</p>
                    <p>5. усовершенствования продукта и (или) услуг и для разработки новых продуктов и (или) услуг.</p>
                    <p class="text">
                        <span class="marker2">Как управлять файлами cookie</span>
                    <p>Используемые вами браузер и (или) устройство могут позволять вам блокировать, удалять или иным образом ограничивать использование файлов cookie. Но файлы cookie являются важной частью сайта ФГБОУ ВО Чурапчинский государственный институт физической культуры и спорта "chgifkis-fdpo.ru" в сети «Интернет», поэтому блокировка, удаление или ограничение их использования может привести к тому, что вы будете иметь доступ не ко всем функциям сайта. Чтобы узнать, как управлять файлами cookie с помощью используемых вами браузера или устройства, вы можете воспользоваться инструкцией, предоставляемой разработчиком браузера или производителем устройства.</p>
                    </p>
                </header>
            </div>
        </div>

        <div id="cookie_notification">
            <p>Для улучшения работы сайта и его взаимодействия с пользователями мы используем файлы cookie. Продолжая работу с сайтом, Вы разрешаете использование cookie-файлов. Вы всегда можете отключить файлы cookie в настройках Вашего браузера.</p>
            <a class="button cookie_info" href="/info/cookie">Подробнее</a>
            <button class="button cookie_accept">Принять</button>
        </div>
    </div>

    <script src="/assets/scripts/main.js"></script>
</body>

</html>