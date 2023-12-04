<?php

namespace controllers\lms;

use models\users\userModel;

class lmsController
{

    public function __construct()
    {
        $user = new userModel();
        $user->createTable();
    }

    public function index()
    {
        // Проверяем, зарегистрирован ли пользователь
        if (!isset($_SESSION['user_role'])) {
            // Если пользователь не зарегистрирован, перенаправляем его на страницу входа
            header('Location: /');
            exit;
        }

        include 'app/views/lms/index.php';
    }
}
