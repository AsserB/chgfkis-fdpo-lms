<?php
ob_start();
?>

<!-- Основной контент -->
<div class="profile-wrapper">
    <div class="profile">
        <h1 class="pofile-title"><strong>Мои данные</strong></h1>
        <p><strong>ФИО:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?> (<a class="profile-link" href="/auth/logout">выйти</a>)</p>
        <p><strong>Роль:</strong> <?php echo $role['role_name']; ?></p>
        <a class="profile-button" href="/users/editprofile/<?php echo $user['id']; ?>">Редактировать</a>
    </div>
    <div class="profile">
        <h1 class="pofile-title"><strong>Данные для ФИС ФРДО</strong></h1>
        <h1 class="pofile-subtitle"><strong>Формирование и ведение Федерального реестра сведений о документах об образовании и (или) о квалификации, документах об обучении</strong></h1>
        <a class="profile-button" href="/users/fisfrdo/<?php echo $user['id']; ?>">Добавить</a>
        <p><strong>Фамилия:</strong> <?php echo isset($frdo['surname']) ? $frdo['surname'] : 'Нет данных'; ?></p>
        <p><strong>Имя:</strong> <?php echo isset($frdo['firstname']) ? $frdo['firstname'] : 'Нет данных'; ?></p>
        <p><strong>Отчество:</strong> <?php echo isset($frdo['thirdname']) ? $frdo['thirdname'] : 'Нет данных'; ?></p>
        <p><strong>Пол:</strong> <?php echo isset($frdo['gender']) ? $frdo['gender'] : 'Нет данных'; ?></p>
        <p><strong>Дата рождения:</strong> <?php echo isset($frdo['birthday']) ? $frdo['birthday'] : 'Нет данных'; ?></p>
        <p><strong>Уровень образования:</strong> <?php echo isset($frdo['education']) ? $frdo['education'] : 'Нет данных'; ?></p>
        <p><strong>Серия и номер документа об образовании:</strong> <?php echo isset($frdo['education_number']) ? $frdo['education_number'] : 'Нет данных'; ?></p>
        <p><strong>Квалификация/специальность по диплому:</strong> <?php echo isset($frdo['spec']) ? $frdo['spec'] : 'Нет данных'; ?></p>
        <p><strong>Место работы:</strong> <?php echo isset($frdo['job_place']) ? $frdo['job_place'] : 'Нет данных'; ?></p>
        <p><strong>Должность:</strong> <?php echo isset($frdo['job_title']) ? $frdo['job_title'] : 'Нет данных'; ?></p>
        <p><strong>Общий трудовой стаж:</strong> <?php echo isset($frdo['exp_all']) ? $frdo['exp_all'] : 'Нет данных'; ?></p>
        <p><strong>Стаж работы в данной организации:</strong> <?php echo isset($frdo['exp_in_org']) ? $frdo['exp_in_org'] : 'Нет данных'; ?></p>
        <p><strong>УПД (наличие аттестации на соответствие категории, дата аттестации):</strong> <?php echo isset($frdo['title']) ? $frdo['title'] : 'Нет данных'; ?></p>
        <p><strong>Наличие инвалидности:</strong> <?php echo isset($frdo['disability']) ? $frdo['disability'] : 'Нет данных'; ?></p>
        <p><strong>Номер СНИЛС (в формате 111-222-333 00):</strong> <?php echo isset($frdo['snils']) ? $frdo['snils'] : 'Нет данных'; ?></p>
        <p><strong>Ссылка на скан/фото/скриншот СНИЛС:</strong> <?php echo isset($frdo['snils_path']) ? $frdo['snils_path'] : 'Нет данных'; ?></p>
        <a class="profile-button" href="/users/fisfrdoedit/<?php echo $frdo['id']; ?>">Редактировать</a>
    </div>
</div>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>