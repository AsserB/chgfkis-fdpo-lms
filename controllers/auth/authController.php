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
                //session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_email'] = $user['email'];

                header("Location: /lms");
            } else {
                echo "Некорректный логин или пароль";
            }
        }
    }

    public function recover()
    {
        include 'app/views/auth/recover.php';
    }

    public function recoverpassword()
    {
        if (isset($_POST['email'])) {
            $email = trim($_POST['email']);

            $authModel = new authModel();
            $user = $authModel->findByEmail($email);

            if ($user) {
                // Если пользователь существует, генерируем временный пароль
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $tempPassword = substr(str_shuffle($characters), 0, 6);
                $user_id = $user['id'];

                // Сохраняем временный пароль в базе данных, связанный с соответствующим пользователем
                $authModel->postTempPassword($user_id, $tempPassword);

                $to = $email;
                $subject = 'Восстановление доступа';
                $message = 'Ваш код для восстановления пароля: ' . $tempPassword . ' перейдите по ссылке https://lean-manager.ru/auth/changepassword и вставьте полученный код и поменяйте пароль';
                $headers = 'From: lean-manager.ru' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);
            }

            $authModel->deletePassword($user_id);
        }

        header("Location: /auth/changepassword");
        //header("Location: /");
    }

    public function changepassword()
    {
        include 'app/views/auth/changepassword.php';
    }

    public function changepasswordbyuser()
    {
        if (isset($_POST['password']) && isset($_POST['temp_password'])) {
            $data['temp_password'] = trim($_POST['temp_password']);

            $authModel = new authModel();
            $temp_passwords_row = $authModel->getChekTempPassword($data);

            if ($temp_passwords_row === false) {
                echo "вы не правильно ввели Код подтверждения";
            } else {
                $userID = $authModel->getTempPasswordUserID($data);
                $data['password'] = trim($_POST['password']);
                $data['id'] = $userID['user_id'];

                $authModel->changePassword($data);

                // Удалить строку из таблицы temp_password по id
                $authModel->deleteTempPassword($data);

                header("Location: /auth/login");
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
