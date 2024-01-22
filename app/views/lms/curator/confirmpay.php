<?php
// http://leanmanager/index.php?page=roles&action=create
ob_start();
?>

<form class="form" method="POST" action="/lms/confirmcourses">
    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
    <input type="hidden" name="courses_id" value="<?= $course['id'] ?>">
    <h1 class="form-title">Запись на курс</h1>
    <div class="form-fields">

    </div>
    <div class="form-button">
        <button type="submit" class="button">Подтверждаю</button>
    </div>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'
?>