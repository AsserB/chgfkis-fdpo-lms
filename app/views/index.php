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
                            <a class="nav-link" href="#news">Новости</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#courses">Все курсы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contacts">Контакты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#docs">Документы</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-row">
                <div class="header-auth">
                    <a href="/auth/login">Вход</a>
                    <a href="/auth/register">Регистрация</a>
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
        <section class="news" id="news">
            <h2 class="subtitle">Последние новости</h2>
            <div class="news-list">
                <a href="#" class="news-item">
                    <img src="/assets/img/news/news-1.jpg" alt="Новости ЧГИФКиС.ФДПО">
                    <span>06.11.2023</span>
                    <p>VIII Международные спортивные игры «Дети Азии»</p>
                </a>
                <a href="#" class="news-item">
                    <img src="/assets/img/news/news-2.jpeg" alt="Новости ЧГИФКиС.ФДПО">
                    <span>01.11.2023</span>
                    <p>Cтуденческое научное общество ЧГИФКиС приняли участие в Фестивале науки «NAUKA0+»</p>
                </a>
                <a href="#" class="news-item">
                    <img src="/assets/img/news/news-3.jpg" alt="Новости ЧГИФКиС.ФДПО">
                    <span>27.09.2023</span>
                    <p>Российское олимпийское движение: вызовы и перспективы</p>
                </a>
            </div>
        </section>
        <section class="courses" id="courses">
            <h2 class="subtitle">Направления подготовки</h2>
            <div class="card">
                <div class="card-list">
                    <a href="#" class="card-item">
                        <h3 class="card-title">Обучение навыкам оказания первой помощи</h3>
                        <p><strong>Контингент:</strong> Лица, имеющие диплом среднем профессиональном или высшем
                            образовании.</p>
                        <p><strong>Объем часов:</strong> 36</p>
                        <p><strong>Сроки:</strong> В течение года по мере комплектования групп</p>
                        <span class="card-button">Записаться</span>
                    </a>
                    <a href="#" class="card-item">
                        <h3 class="card-title">Охрана труда</h3>
                        <p><strong>Контингент:</strong> Лица, имеющие диплом среднем профессиональном или высшем
                            образовании.</p>
                        <p><strong>Объем часов:</strong> 20</p>
                        <p><strong>Сроки:</strong> В течение года по мере комплектования групп</p>
                        <span class="card-button">Записаться</span>
                    </a>
                    <a href="#" class="card-item">
                        <h3 class="card-title">
                            «Внедрение Всероссийского физкультурно-спортивного комплекса «Готов к труду и обороне» в
                            условиях Республики Саха (Якутия)»</h3>
                        <p><strong>Контингент:</strong> Лица, имеющие диплом среднем профессиональном или высшем
                            образовании.</p>
                        <p><strong>Объем часов:</strong> 36</p>
                        <p><strong>Сроки:</strong> В течение года по мере комплектования групп</p>
                        <span class="card-button">Записаться</span>
                    </a>
                    <a href="#" class="card-item">
                        <h3 class="card-title">Комплексная организация антидопинговой деятельности</h3>
                        <p><strong>Контингент:</strong> Лица, имеющие диплом среднем профессиональном или высшем
                            образовании.</p>
                        <p><strong>Объем часов:</strong> 20</p>
                        <p><strong>Сроки:</strong> В течение года по мере комплектования групп</p>
                        <span class="card-button">Записаться</span>
                    </a>
                    <a href="#" class="card-item">
                        <h3 class="card-title">Инновационные здоровье сберегающие технологии в образовательных
                            организациях</h3>
                        <p><strong>Контингент:</strong> Лица, имеющие диплом среднем профессиональном или высшем
                            образовании.</p>
                        <p><strong>Объем часов:</strong> 72</p>
                        <p><strong>Сроки:</strong> В течение года по мере комплектования групп</p>
                        <span class="card-button">Записаться</span>
                    </a>
                    <a href="#" class="card-item">
                        <h3 class="card-title">Совместная деятельность детей и взрослых в условиях реализации ФГОС ДО
                        </h3>
                        <p><strong>Контингент:</strong> Лица, имеющие диплом среднем профессиональном или высшем
                            образовании.</p>
                        <p><strong>Объем часов:</strong> 20</p>
                        <p><strong>Сроки:</strong> В течение года по мере комплектования групп</p>
                        <span class="card-button">Записаться</span>
                    </a>
                </div>
            </div>
        </section>
        <section class="contacts" id="contacts">
            <h2 class="subtitle contacts-title">Контактная информация</h2>
            <p>Если у вас есть вопросы о формате или вы не знаете, что выбрать, оставьте свой номер — мы позвоним и
                ответим на все вопросы</p>
            <form class="contacts-form" action="" method="post">
                <input class="contacts-input" type="text" placeholder="ФИО">
                <input class="contacts-input" type="tel" placeholder="Телефон">
                <input class="contacts-input" type="email" placeholder="Электронная почта">
                <button class="form-button" type="submit">Получить консультацию</button>
            </form>
        </section>
        <section class="docs" id="docs">
            <h2 class="subtitle">Лицензия и аккредитация</h2>
            <div class="docs-list">
                <a href="#" class="docs-row">
                    <img src="/assets/img/diplom.png" alt="лицензия на образовательную деятельность">
                    <div class="docs-row-content">
                        <h3 class="docs-title">Лицензия</h3>
                        <p>на осуществление образовательной деятельности</p>
                    </div>
                </a>
                <a href="#" class="docs-row">
                    <img src="/assets/img/diplom.png" alt="лицензия на образовательную деятельность">
                    <div class="docs-row-content">
                        <h3 class="docs-title">Свидетельство</h3>
                        <p>о гусударственной аккредитацииц</p>
                    </div>
                </a>
                <a href="#" class="docs-row">
                    <img src="/assets/img/diplom.png" alt="лицензия на образовательную деятельность">
                    <div class="docs-row-content">
                        <h3 class="docs-title">Удостоверение</h3>
                        <p>слушателя курса повышения квалификации</p>
                    </div>
                </a>
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
                        <a href="#">Сведения об образовательной организации</a>
                    </li>
                    <li>
                        <a href="#">Устав</a>
                    </li>
                    <li>
                        <a href="#">Спорт норма жизни</a>
                    </li>
                    <li>
                        <a href="#">Партнеры</a>
                    </li>
                </ul>
            </div>
            <div class="footer-column">
                <ul class="footer-ul">
                    <li>
                        <a href="#">Преподаватели и сотрудники</a>
                    </li>
                    <li>
                        <a href="#">Устав</a>
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
    </div>
</body>

</html>