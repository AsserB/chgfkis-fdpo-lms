<?php
ob_start();

$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;
?>

<section class="lms">
    <h1 class="lms-title">Доступные курсы:</h1>

    <?php if (empty($frdoIsNull)) : ?>
        <p class="lms-warning frdo-warning">Вы не заполнили свои данные для ФИС ФРДО! для заполнения перейдите по ссылке: <a class="frdo-warning-link" href="/users/userdata">Мои данные</a>. Без заполнения данных вы не сможете записаться на курсы</p>
    <?php endif; ?>

    <?php if (empty($courses)) : ?>
        <p class="lms-warning">Вы еще не записаны на курсы</p>
    <?php endif; ?>

    <div class="card-list">
        <?php foreach ($courses as $course) : ?>

            <a href="/lms/education/<?php echo $course['id']; ?>" class="card-item">
                <h3 class="card-title"><?php echo $course['title']; ?></h3>
                <p><strong>Контингент: </strong> <?php echo $course['target']; ?></p>
                <p><strong>Объем часов: </strong><?php echo $course['duration']; ?></p>
                <p><strong>Сроки: </strong><?php echo $course['timeline']; ?></p>
                <p><strong>Описание курса: </strong><?php echo $course['courses_description']; ?></p>
            </a>

        <?php endforeach; ?>
    </div>
    <a href="/lms/kpk" class="lms-link">
        <p>Записаться на курсы</p>
    </a>
</section>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>