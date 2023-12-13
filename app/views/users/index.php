<?php
ob_start();
?>

<header class="content-header">
    <h1 class="title curator-title">Список пользователей</h1>
</header>

<table class="table">
    <thead>
        <tr>
            <th class="table-row" scope="col">id</th>
            <th class="table-row" scope="col">ФИО</th>
            <th class="table-row" scope="col">Электронная почта</th>
            <th class="table-row" scope="col">Роль</th>
            <th class="table-row" scope="col">Действие</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <div class="td-wrapper">
                        <a class="green" href="/users/edit/<?php echo $user['id']; ?>">Редактировать</a>
                        <a class="red" onclick="return confirm('Вы уверены в этом')" href="/users/delete/<?php echo $user['id']; ?>">Удалить</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean();

include 'app/views/layout.php'
?>