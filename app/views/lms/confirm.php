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
        <?php if (!empty($frdoIsNull)) : ?>
            <button type="submit" class="button">Подтверждаю</button>
        <?php endif; ?>
        <?php if (empty($frdoIsNull)) : ?>
            <p class="lms-warning frdo-warning">Вы не заполнили свои данные для ФИС ФРДО! для заполнения перейдите по ссылке: <a class="frdo-warning-link" href="/users/userdata">Мои данные</a>. Без заполнения данных вы не сможете записаться на курсы</p>
        <?php endif; ?>
    </div>

    <div class="form-info">
        <p>Подтверждая запись, на курс
            вы соглашаетесь с <a class="text-primary" href="/info/policy">"политикой обработки и хранения персональных данных"</a></p>
    </div>
    <div class="form-info">
        <p>и</p>
    </div>
    <div class="form-info">
        <p>Подтверждая запись, на курс
            вы соглашаетесь с <a class="text-primary" href="/info/useragreement">"пользовательским соглашением"</a></p>
    </div>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'
?>