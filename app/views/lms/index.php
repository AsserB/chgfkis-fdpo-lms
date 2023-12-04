<?php
ob_start();

$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;
?>

<h1>Система управления образованием</h1>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>