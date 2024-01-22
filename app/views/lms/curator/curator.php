<?php
ob_start();
?>

<header class="content-header">
    <h1 class="curator-title">Кураторство</h1>
</header>

<div class="courses" id="courses">
    <a href="/lms/create" class="button lms-button">Создать курс</a>
    <div class="card">
        <div class="card-list">
            <?php foreach ($courses as $course) : ?>
                <div class="card-item">
                    <h3 class="card-title"><?php echo $course['title']; ?></h3>
                    <p><strong>Контингент: </strong> <?php echo $course['target']; ?></p>
                    <p><strong>Объем часов: </strong><?php echo $course['duration']; ?></p>
                    <p><strong>Сроки: </strong><?php echo $course['timeline']; ?></p>
                    <p><strong>Описание курса: </strong><?php echo $course['courses_description']; ?></p>
                    <a href="/lms/education/<?php echo $course['id']; ?>" class="card-button edit">Добавить материал</a>
                    <a href="/lms/students/<?php echo $course['id']; ?>" class="card-button edit">Список слушателей</a>
                    <a href="/lms/edit/<?php echo $course['id']; ?>" class="card-button edit">Редактировать</a>
                    <a onclick="return confirm('Вы уверены в этом')" href="/lms/delete/<?php echo $course['id']; ?>" class="card-button delete">Удалить</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean();

include 'app/views/layout.php'
?>