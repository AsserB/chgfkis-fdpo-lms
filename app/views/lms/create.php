<?php
ob_start();
?>

<form class="form" method="POST" action="/lms/createkpk">
    <h1 class="form-title">Добавить курс</h1>
    <div class="form-fields">
        <label for="title">Название курса</label>
        <input type="text" id="title" name="title" required>
        <label for="target">Целевая аудитория</label>
        <input type="text" id="target" name="target" required>
        <label for="duration">Объем часов</label>
        <input type="text" id="duration" name="duration" required>
        <label for="timeline">Сроки</label>
        <input type="text" id="timeline" name="timeline" required>
        <label for="course_description">Описание курса</label>
        <textarea type="text" name="course_description" id="course_description" cols="30" rows="5"></textarea>
    </div>
    <div class="form-button">
        <button type="submit" class="button">Сохранить</button>
    </div>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'
?>