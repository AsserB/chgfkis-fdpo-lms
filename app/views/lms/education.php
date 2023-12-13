<?php
ob_start();

$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;
?>

<section class="lms">
    <h1 class="lms-title"><?php echo $course['title']; ?></h1>

</section>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>