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
        <p><strong>Фамилия:</strong> <?php echo $frdo['surname']; ?></p>
        <p><strong>Имя:</strong> <?php echo $frdo['firstname']; ?></p>
        <p><strong>Отчество:</strong> <?php echo $frdo['thirdname']; ?></p>
        <p><strong>Пол:</strong> <?php echo $frdo['gender']; ?></p>
        <p><strong>Дата рождения:</strong> <?php echo $frdo['birthday']; ?></p>
        <p><strong>Уровень образования:</strong> <?php echo $frdo['education']; ?></p>
        <p><strong>Серия и номер документа об образовании:</strong> <?php echo $frdo['education_number']; ?></p>
        <p><strong>Квалификация/специальность по диплому:</strong> <?php echo $frdo['spec']; ?></p>
        <p><strong>Место работы:</strong> <?php echo $frdo['job_place']; ?></p>
        <p><strong>Должность:</strong> <?php echo $frdo['job_title']; ?></p>
        <p><strong>Общий трудовой стаж:</strong> <?php echo $frdo['exp_all']; ?></p>
        <p><strong>Стаж работы в данной организации:</strong> <?php echo $frdo['exp_in_org']; ?></p>
        <p><strong>УПД (наличие аттестации на соответствие категории, дата аттестации):</strong> <?php echo $frdo['title']; ?></p>
        <p><strong>Наличие инвалидности::</strong> <?php echo $frdo['disability']; ?></p>
        <p><strong>Номер СНИЛС (в формате 111-222-333 00):</strong> <?php echo $frdo['snils']; ?></p>
        <p><strong>Ссылка на скан/фото/скриншот СНИЛС:</strong> <?php echo $frdo['snils_path']; ?></p>
        <a class="profile-button" href="/users/editprofile/<?php echo $fislist['id']; ?>">Редактировать</a>
    </div>
</div>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>