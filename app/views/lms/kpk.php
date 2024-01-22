<?php
ob_start();

$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;
?>

<section class="lms">
    <h1 class="lms-title">Курсы повышения квалификации</h1>

    <div class="courses" id="courses">
        <div class="card">
            <div class="card-list">
                <?php foreach ($courses as $course) : ?>
                    <div class="card-item">
                        <h3 class="card-title"><?php echo $course['title']; ?></h3>
                        <p><strong>Контингент: </strong> <?php echo $course['target']; ?></p>
                        <p><strong>Объем часов: </strong><?php echo $course['duration']; ?></p>
                        <p><strong>Сроки: </strong><?php echo $course['timeline']; ?></p>
                        <p><strong>Описание курса: </strong><?php echo $course['courses_description']; ?></p>
                        <a href="/lms/confirm/<?php echo $course['id']; ?>" class="card-button">Записаться</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</section>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>