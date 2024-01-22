<?php
ob_start();
?>

<form class="form" method="POST" action="/lms/update/<?php echo $course['id']; ?>">
    <input type="hidden" name="id" value="<?= $course['id'] ?>">
    <h1 class="form-title">Редактировать курс</h1>
    <div class="form-fields">
        <label for="title">Название курса</label>
        <input type="text" id="title" name="title" value="<?php echo $course['title'] ?>" required>
        <label for="target">Целевая аудитория</label>
        <input type="text" id="target" name="target" value="<?php echo $course['target'] ?>" required>
        <label for="duration">Объем часов</label>
        <input type="text" id="duration" name="duration" value="<?php echo $course['duration'] ?>" required>
        <label for="timeline">Сроки</label>
        <input type="text" id="timeline" name="timeline" value="<?php echo $course['timeline'] ?>" required>
        <label for="course_description">Описание курса</label>
        <textarea type="text" name="courses_description" id="courses_description" cols="30" rows="5"><?php echo $course['courses_description'] ?></textarea>
    </div>
    <div class="form-button">
        <button type="submit" class="button">Сохранить</button>
    </div>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'
?>