<?php
ob_start();

$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;
?>

<section class="lms">
    <h1 class="lms-title">Список курсов</h1>

    <?php if (empty($frdoIsNull)) : ?>
        <p class="lms-warning frdo-warning">Вы не заполнили свои данные для ФИС ФРДО! для заполнения перейдите по ссылке: <a class="frdo-warning-link" href="/users/userdata">Мои данные</a>. Без заполнения данных вы не сможете записаться на курсы</p>
    <?php endif; ?>

    <h2 class="lms-subtitle">Доступные курсы:</h2>

    <?php if (empty($courses)) : ?>
        <p class="lms-warning">Вы еще не записаны на курсы</p>
    <?php endif; ?>

    <ol>
        <?php foreach ($courses as $course) : ?>

            <li><a href="/lms/education/<?php echo $course['id']; ?>"><?php echo $course['title']; ?></a></li>

        <?php endforeach; ?>
    </ol>
    <a href="/lms/kpk" class="lms-link">
        <p>Записаться на курсы</p>
        <img src="/assets/img/icon/right-arrow.png" alt="Курсы повышения квалификации">
    </a>
</section>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>