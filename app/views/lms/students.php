<?php
ob_start();

$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;
?>

<section class="lms">
    <h1 class="lms-title"> Список слушателей "<?php echo $course['title']; ?>"</h1>

    <table class="table">
        <thead>
            <tr>
                <th class="table-row" scope="col">ФИО</th>
                <th class="table-row" scope="col">Электронная почта</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button class="button" id="button-excel">Выгрузить ФИС ФРДО в excel</button>
    <table class="report-table" cols="15" id="simpleTable1">
        <thead>
            <tr>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <th scope="col">Отчество</th>
                <th scope="col">Пол</th>
                <th scope="col">Дата рождения</th>
                <th scope="col">Уровень образования</th>
                <th scope="col">Серия и номер документа об образовании:</th>
                <th scope="col">Квалификация/специальность по диплому:</th>
                <th scope="col">Место работы:</th>
                <th scope="col">Должность</th>
                <th scope="col">Общий трудовой стаж</th>
                <th scope="col">Стаж работы в данной организации</th>
                <th scope="col">УПД (наличие аттестации на соответствие категории, дата аттестации):</th>
                <th scope="col">Наличие инвалидности</th>
                <th scope="col">Номер СНИЛС</th>
                <th scope="col">Ссылка на скан/фото/скриншот СНИЛС</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $frdo) : ?>
                <tr>
                    <td>
                        <p><?php echo $frdo['surname']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['firstname']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['thirdname']; ?></p>
                    </td>
                    <td>
                        <p class="report-table-max"><?php echo $frdo['gender']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['birthday']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['education']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['education_number']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['spec']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['job_place']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['job_title']; ?></p>
                    </td>
                    <td>
                        <p class="report-table-min"><?php echo $frdo['exp_all']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['exp_in_org']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['title']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['disability']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['snils']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $frdo['snils_path']; ?></p>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

    <script>
        let button = document.querySelector("#button-excel");

        button.addEventListener("click", e => {
            let table = document.querySelector("#simpleTable1");
            TableToExcel.convert(table);
        });
    </script>

</section>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>