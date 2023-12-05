<?php
ob_start();
?>

<form class="form" method="POST" action="/users/store/<?php echo $user['id']; ?>">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <h1 class="form-title">Данные для ФИС ФРДО</h1>
    <div class="form-fields">

        <div class="form-info frdo-info">
            <p>Зачем нам нужны ваши данные? Для того, чтобы выдать вам удостоверение, нам необходимо предварительно ввести их в ФИС ФРДО (Федеральный реестр сведений документов об образовании).
                В случае их отсутствия, вам просто не выдадут удостоверение о прохождении курса.
                Если вы не предоставите необходимые данные в этой форме, мы вам откажем в записи на курс. Благодарим за понимание
            </p>
        </div>

        <label>Фамилия (как в паспорте)</label>
        <input type="text" placeholder="фамилия" id="surname" name="surname" required>

        <label>Имя (как в паспорте)</label>
        <input type="text" placeholder="имя" id="firstname" name="firstname" required>

        <label>Отчество (как в паспорте)</label>
        <input type="text" placeholder="отчество" id="thirdname" name="thirdname" required>

        <label for="gender">Пол</label>
        <div class="form-select-wrapper">
            <select class="form-select mb-3" name="gender" id="gender">
                <option>Жен</option>
                <option>Муж</option>
            </select>
        </div>

        <label for="birthday">Дата рождения</label>
        <input type="date" id="birthday" name="birthday" required>

        <label for="education">Уровень образования</label>
        <div class="form-select-wrapper">
            <select class="form-select mb-3" name="education" id="education">
                <option>Среднее профессиональное</option>
                <option>Высшее (бакалавриат)</option>
                <option>Высшее (специалитет)</option>
                <option>Высшее (магистратура)</option>
                <option>Высшее (аспирантура)</option>
            </select>
        </div>

        <label>Серия и номер документа об образовании</label>
        <input type="text" placeholder="cерия и номер документа об образовании" id="education_number" name="education_number" required>

        <label>Квалификация/специальность по диплому</label>
        <input type="text" placeholder="квалификация/специальность по диплому" id="spec" name="spec" required>

        <label>Место работы (полное наименование организации. Например, МБУДО "Амгинский дом детского творчества им. О.П. Ивановой-Сидоркевич")</label>
        <input type="text" placeholder="место работы" id="job_place" name="job_place" required>

        <label>Полная должность (Например, преподаватель истории и права)</label>
        <input type="text" placeholder="должность" id="job_title" name="job_title" required>

        <label>Общий трудовой стаж</label>
        <input type="text" placeholder="стаж" id="exp_all" name="exp_all" required>

        <label>Стаж работы в данной организации</label>
        <input type="text" placeholder="стаж работы в организации" id="exp_in_org" name="exp_in_org" required>

        <label>УПД (наличие аттестации на соответствие категории, дата аттестации)</label>
        <input type="text" placeholder="упд" id="title" name="title" required>

        <label for="disability">Наличие инвалидности</label>
        <div class="form-select-wrapper">
            <select class="form-select mb-3" name="disability" id="disability">
                <option>Да</option>
                <option>Нет</option>
            </select>
        </div>

        <label>Номер СНИЛС (в формате 111-222-333 00)</label>
        <input type="text" placeholder="номер СНИЛС" id="snils" name="snils" required maxlength="14">

        <label>Ссылка на скан/фото/скриншот СНИЛС (Необходимо для того, чтобы избежать любых возможных ошибок)</label>
        <input type="text" placeholder="номер СНИЛС" id="snils_path" name="snils_path" required>

    </div>
    <div class="form-button">
        <button type="submit" class="button">Добавить данные на ФИС ФРДО</button>
    </div>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'

?>