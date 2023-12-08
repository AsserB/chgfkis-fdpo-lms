<?php
ob_start();

$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;
?>

<section class="lms">
    <h1 class="lms-title">Список курсов</h1>
    <h2 class="lms-subtitle">Доступные курсы:</h2>
    <p class="lms-warning">Вы еше не записаны на курсы</p>

    <a href="/lms/kpk" class="lms-link">
        <p>Записаться на курсы</p>
        <img src="/assets/img/icon/right-arrow.png" alt="Курсы повышения квалификации">
    </a>
</section>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>