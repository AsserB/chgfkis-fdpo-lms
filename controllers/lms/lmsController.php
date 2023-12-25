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

        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        $lmsModel = new lmsModel();
        $courses = $lmsModel->getAllCoursesByIdUser($user_id);

        include 'app/views/lms/index.php';
    }

    public function kpk()
    {
        $this->check->requirePermission();

        $lmsModel = new lmsModel();
        $courses = $lmsModel->getAllCourses();

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
            $data['courses_description'] = trim(filter_input(INPUT_POST, 'courses_description', FILTER_SANITIZE_STRING));



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

    //Функция для редактирования ролей
    public function edit($params)
    {
        $this->check->requirePermission();

        $lmsModel = new lmsModel();
        $course = $lmsModel->getCourseById($params['id']);

        include 'app/views/lms/kpkedit.php';
    }

    public function update()
    {
        $this->check->requirePermission();

        if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['courses_description']) && !empty($_POST['courses_description']) && isset($_POST['duration']) && !empty($_POST['duration'])) {

            $lmsModel = new lmsModel();
            $data['id'] = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
            $data['title'] = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
            $data['target'] = trim(filter_input(INPUT_POST, 'target', FILTER_SANITIZE_STRING));
            $data['duration'] = trim(filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_STRING));
            $data['timeline'] = trim(filter_input(INPUT_POST, 'timeline', FILTER_SANITIZE_STRING));
            $data['courses_description'] = trim(filter_input(INPUT_POST, 'courses_description', FILTER_SANITIZE_STRING));

            if (!$lmsModel->updateCourses($data)) {
                // Обработка ошибки
                echo "Произошла ошибка при обновлении данных в базе данных.";
            }
        } else {
            // Обработка ошибки
            echo "Не все поля заполнены.";
        }

        header("Location: /lms/kpk");
    }

    //Функция для удаления курса
    public function delete($params)
    {
        $this->check->requirePermission();

        $lmsModel = new lmsModel();
        $lmsModel->deleteCourses($params['id']);

        header("Location:  /lms/kpk"); // Перенаправление на страницу со всеми страницами
    }

    public function confirm($params)
    {
        $this->check->requirePermission();

        $user_id = $this->userId;

        $userModel = new userModel();
        $user = $userModel->readUser($user_id);

        $lmsModel = new lmsModel();
        $course = $lmsModel->getCourseById($params['id']);


        include 'app/views/lms/confirm.php';
    }

    public function confirmcourses()
    {
        $this->check->requirePermission();

        if (isset($_POST['user_id']) && isset($_POST['courses_id'])) {
            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
            $data['courses_id'] = trim($_POST['courses_id']);

            $lmsModel = new lmsModel();
            $lmsModel->confirmCourses($data);
        }

        header("Location: /lms");
    }

    public function education($params)
    {
        $this->check->requirePermission();

        $lmsModel = new lmsModel();
        $course = $lmsModel->getCourseById($params['id']);

        include 'app/views/lms/education.php';
    }

    public function students($params)
    {
        $this->check->requirePermission();

        $lmsModel = new lmsModel();
        $course = $lmsModel->getCourseById($params['id']);

        $lmsModel = new lmsModel();
        $users = $lmsModel->getAllUsersStudiesInCourses($params['id']);

        include 'app/views/lms/students.php';
    }

    //____________CURATOR______________
    public function curator()
    {
        $this->check->requirePermission();

        $lmsModel = new lmsModel();
        $courses = $lmsModel->getAllCourses();

        include 'app/views/lms/curator.php';
    }

    public function addlesson()
    {
        $this->check->requirePermission();
        include 'app/views/lms/addlesson.php';
    }
}
