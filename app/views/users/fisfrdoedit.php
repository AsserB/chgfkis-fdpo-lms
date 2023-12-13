<?php
ob_start();
?>

<form class="form" method="POST" action="/users/updateprofile/<?php echo $user['id']; ?>">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <h1 class="form-title">Редактирование данные ФИС ФРДО</h1>
    <div class="form-fields">

        <label>ФИО пользователя</label>
        <input type="text" placeholder="ФИО" id="username" name="username" value="<?php echo $user['username'] ?>" required>

        <label>Электронная почта</label>
        <input type="email" placeholder="Электронная почта" id="email" name="email" value="<?php echo $user['email'] ?>" required>

    </div>
    <div class="form-button">
        <button type="submit" class="button">Обновить</button>
    </div>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'

?>