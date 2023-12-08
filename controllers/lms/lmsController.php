<?php

namespace controllers\lms;

use models\users\userModel;
use models\lms\lmsModel;
use models\Check;

class lmsController
{

    private $check;
    private $userId;

    public function __construct()
    {
        $user = new userModel();
        $user->createTable();

        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $this->check = new Check($userRole);
    }

    public function index()
    {
        // Проверяем, зарегистрирован ли пользователь
        if (!isset($_SESSION['user_role'])) {
            // Если пользователь не зарегистрирован, перенаправляем его на страницу входа
            header('Location: /auth/login');
            exit;
        }

        include 'app/views/lms/index.php';
    }

    public function kpk()
    {
        $this->check->requirePermission();

        include 'app/views/lms/kpk.php';
    }

    public function create()
    {
        $this->check->requirePermission();

        include 'app/views/lms/create.php';
    }

    public function createkpk()
    {
        $this->check->requirePermission();

        if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['courses_description']) && !empty($_POST['courses_description']) && isset($_POST['duration']) && !empty($_POST['duration'])) {

            $lmsModel = new lmsModel();
            $data['title'] = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
            $data['target'] = trim(filter_input(INPUT_POST, 'target', FILTER_SANITIZE_STRING));
            $data['duration'] = trim(filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_STRING));
            $data['timeline'] = trim(filter_input(INPUT_POST, 'timeline', FILTER_SANITIZE_STRING));
            $data['course_description'] = trim(filter_input(INPUT_POST, 'course_description', FILTER_SANITIZE_STRING));

            if (!$lmsModel->createCourses($data)) {
                // Обработка ошибки
                echo "Произошла ошибка при добавлении данных в базу данных.";
            }
        } else {
            // Обработка ошибки
            echo "Не все поля заполнены.";
        }

        header("Location: /lms/kpk");
    }
}
