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
    <div class="container">
        <header class="header">
            <div class="header-row">
                <div class="logo">
                    <img src="/assets/img/logo.png" alt="Факультет дополнительного образования">
                    <p>ЧГИФКиС.ФДПО</p>
                </div>
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
        <div class="header-content">
            <div class="header-content-row">
                <h1 class="title">Факультет дополнительного образования</h1>
                <a class="header-button" href="/lms">Начать учиться</a>
            </div>
            <div class="header-content-row">
                <img src="/assets/img/main-img.png" alt="Факультет дополнительного образования">
            </div>
        </div>

        <div class="courses" id="courses">
            <h2 class="subtitle">Направления подготовки</h2>
            <div class="card">
                <div class="card-list">
                    <?php foreach ($courses as $course) : ?>
                        <div class="card-item">
                            <h3 class="card-title"><?php echo $course['title']; ?></h3>
                            <p><strong>Контингент: </strong> <?php echo $course['target']; ?></p>
                            <p><strong>Объем часов: </strong><?php echo $course['duration']; ?></p>
                            <p><strong>Сроки: </strong><?php echo $course['timeline']; ?></p>
                            <p><strong>Описание курса: </strong><?php echo $course['courses_description']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <section class="news" id="news">
            <h2 class="subtitle">Последние новости</h2>
            <div class="news-list">
                <?php
                require_once('assets/packagist/simplehtmldom_1_9_1/simple_html_dom.php');

                $html = file_get_html('https://www.chgifkis.ru/about_the_university/notifies/');

                $newsItems = '';
                $newsCount = 0;
                $maxNewsCount = 3;
                foreach ($html->find('div.news-item') as $newsItem) {
                    if ($newsCount >= $maxNewsCount) {
                        break;
                    }
                    $title = $newsItem->find('h3', 0)->plaintext;
                    $link = $newsItem->find('a', 0)->href;
                    $imageElement = $newsItem->find('img', 0);

                    preg_match('/src="([^"]*)"/', $imageElement, $matches);
                    $imageElement  = $matches[1];

                    $newsItems .= "<div class='news-item'>";
                    $newsItems .= "<img src='https://www.chgifkis.ru/$imageElement' alt='News image'>";
                    $newsItems .= "<p><a href='https://www.chgifkis.ru/about_the_university/notifies/'>$title</a></p>";
                    $newsItems .= "</div>";

                    $newsCount++;
                }

                echo $newsItems;
                ?>
            </div>
        </section>

        <section class="sports" id="sports">
            <h2 class="subtitle">Спорт норма жизни</h2>
            <a href="https://normasport.ru/">
                <img src="/assets/img/logo-snj.png" alt="">
            </a>
        </section>

        <section class="docs" id="docs">
            <h2 class="subtitle">Лицензия и аккредитация</h2>
            <div class="docs-list">
                <a href="https://www.chgifkis.ru/about_the_university/litsenzii/pril_lis.pdf" class="docs-row">
                    <img src="/assets/img/diplom.png" alt="лицензия на образовательную деятельность">
                    <div class="docs-row-content">
                        <h3 class="docs-title">Лицензия</h3>
                        <p>на осуществление образовательной деятельности</p>
                    </div>
                </a>
                <a href="https://www.chgifkis.ru/about_the_university/litsenzii/akkr.jpg" class="docs-row">
                    <img src="/assets/img/diplom.png" alt="лицензия на образовательную деятельность">
                    <div class="docs-row-content">
                        <h3 class="docs-title">Свидетельство</h3>
                        <p>о гусударственной аккредитации</p>
                    </div>
                </a>
                <!-- <a href="#" class="docs-row">
                    <img src="/assets/img/diplom.png" alt="лицензия на образовательную деятельность">
                    <div class="docs-row-content">
                        <h3 class="docs-title">Удостоверение</h3>
                        <p>слушателя курса повышения квалификации</p>
                    </div>
                </a> -->
            </div>
        </section>
        <footer class="footer">
            <div class="footer-column">
                <div class="logo">
                    <img src="/assets/img/logo.png" alt="Факультет дополнительного образования">
                    <p>ЧГИФКиС.ФДПО</p>
                </div>
                <ul class="footer-ul">
                    <li>
                        <p>© Чурапчинский государственный институт физической культуры и спорта, 2023</p>
                    </li>
                    <li>
                        <a href="#">Политика конфиденциальности</a>
                    </li>
                    <li>
                        <a href="#">Контакты</a>
                    </li>
                </ul>
                <ul class="socials-icon">
                    <li>
                        <a href="https://vk.com/fgbou_bo_chgifkis">
                            <img src="/assets/img/icon/vk-reproductor.png" alt="Вконтакте">
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/channel/UCyE_HCHHObVOxsEt_gfetfQ">
                            <img src="/assets/img/icon/social.png" alt="Ютуб">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-column">
                <ul class="footer-ul">
                    <li>
                        <p>О вузе</p>
                    </li>
                    <li>
                        <a href="https://www.chgifkis.ru/sveden/common.html">Сведения об образовательной организации</a>
                    </li>
                    <li>
                        <a href="https://www.chgifkis.ru/about_the_university/charter/">Устав</a>
                    </li>
                    <li>
                        <a href="#">Партнеры</a>
                    </li>
                </ul>
            </div>
            <div class="footer-column">
                <ul class="footer-ul">
                    <li>
                        <p>Абитуриенту</p>
                    </li>
                    <li>
                        <a href="https://www.chgifkis.ru/about_the_university/faculty_and_staff/">Преподаватели и сотрудники</a>
                    </li>
                    <li>
                        <a href="#">Спорт норма жизни</a>
                    </li>
                    <li>
                        <a href="#">Противодействие коррупции</a>
                    </li>
                </ul>
            </div>
            <div class="footer-column">
                <ul class="footer-ul">
                    <li>
                        <p>О вузе</p>
                    </li>
                    <li>
                        <a href="https://www.chgifkis.ru/about_the_university/faculty_and_staff/">Преподаватели и сотрудники</a>
                    </li>
                    <li>
                        <a href="#">Спорт норма жизни</a>
                    </li>
                    <li>
                        <a href="#">Противодействие коррупции</a>
                    </li>
                </ul>
            </div>
        </footer>

        <div id="cookie_notification">
            <p>Для улучшения работы сайта и его взаимодействия с пользователями мы используем файлы cookie. Продолжая работу с сайтом, Вы разрешаете использование cookie-файлов. Вы всегда можете отключить файлы cookie в настройках Вашего браузера.</p>
            <a class="button cookie_info" href="/info/cookie">Подробнее</a>
            <button class="button cookie_accept">Принять</button>
        </div>
    </div>

    <script src="/assets/scripts/main.js"></script>
</body>

</html>