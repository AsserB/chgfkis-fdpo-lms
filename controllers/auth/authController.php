<?php

namespace controllers\auth;

use models\auth\authModel;
use models\users\userModel;

//--Контроллер для CRUD "Авторизация"--//
class authController
{

    public function register()
    {
        include 'app/views/auth/register.php';
    }

    public function store()
    {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $email = $_POST['email'];

            if ($password !== $confirm_password) {
                echo "Пароли не совподают";
                return;
            }

            $authModel = new authModel();
            $data['username'] = trim($_POST['username']);
            $data['email'] = trim($_POST['email']);
            $data['password'] = trim($_POST['password']);
            $data['confirm_password'] = trim($_POST['confirm_password']);
            $data['role'] = 1; //по умолчанию

            if ($authModel->findByEmail($email)) {
                echo "Данный email уже зарегистрирован. Пожалуйста, введите другой email.";
                return;
            }

            $authModel->register($data);
        }

        header("Location:  /auth/login");
    }

    public function login()
    {
        include 'app/views/auth/login.php';
    }

    public function authenticate()
    {
        $authModel = new authModel();

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $user = $authModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_email'] = $user['email'];

                header("Location: /lms");
            } else {
                echo "Некорректный логин или пароль";
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location:  /"); // Перенаправление на главную страницу
    }
}
