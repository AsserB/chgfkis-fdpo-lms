<?php

namespace controllers\users;

use models\users\userModel;
use models\auth\authModel;
use models\Check;
use models\roles\roleModel;
use models\lms\lmsModel;

//--Контроллер для CRUD "Пользователи"--//
class usersController
{
    private $check;
    private $userId;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $this->check = new Check($userRole);
    }

    //Метод для вывода всех пользователей на странице index
    public function index()
    {
        //$this->check->requirePermission();

        $userModel = new userModel();
        $users = $userModel->allUsers();

        include 'app/views/users/index.php';
    }

    //Метод для редактирования пользователя
    public function edit($params)
    {
        $this->check->requirePermission();

        $userModel = new userModel();
        $user = $userModel->readUser($params['id']);

        $roleModel = new roleModel();
        $roles = $roleModel->getAllRoles();

        include 'app/views/users/edit.php';
    }

    public function update()
    {
        $this->check->requirePermission();

        if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email'])) {


            $data['id'] = trim($_POST['id']);
            $data['username'] = trim($_POST['username']);
            $data['email'] = trim($_POST['email']);
            $data['role'] = $_POST['role'];
            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;


            $userModel = new userModel();

            $userModel->updateUser($data);
        }

        header("Location:  /users");
    }

    //Метод для удаления пользователя
    public function delete($params)
    {
        $this->check->requirePermission();

        $userModel = new userModel();
        $userModel->delete($params['id']);

        header("Location:  /users"); // Перенаправление на страницу со всеми пользователями
    }

    //____________USERDATA______________

    public function userdata()
    {
        $this->check->requirePermission();

        $user_id = $this->userId;

        $userModel = new userModel();
        $user = $userModel->readUser($user_id);
        $frdo = $userModel->readUserFrdo($user_id);

        $roleModel = new roleModel();
        $role = $roleModel->getRoleByID($user['role']);

        include 'app/views/users/userdata.php';
    }

    public function editprofile()
    {
        $this->check->requirePermission();

        $user_id = $this->userId;

        $userModel = new userModel();
        $user = $userModel->readUser($user_id);

        include 'app/views/users/editprofile.php';
    }

    public function updateprofile()
    {
        $this->check->requirePermission();

        if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email'])) {
            $data['id'] = trim($_POST['id']);
            $data['username'] = trim($_POST['username']);
            $data['email'] = trim($_POST['email']);
            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;


            $userModel = new userModel();
            $userModel->updateProfile($data);
        }

        header("Location: /users/userdata");
    }

    //____________FISFRDO______________

    public function fisfrdo()
    {
        $this->check->requirePermission();

        $user_id = $this->userId;

        $userModel = new userModel();
        $user = $userModel->readUser($user_id);

        include 'app/views/users/fisfrdo.php';
    }

    public function store()
    {
        if (isset($_POST['surname']) && !empty($_POST['surname']) && isset($_POST['firstname']) && !empty($_POST['firstname']) && isset($_POST['snils']) && !empty($_POST['snils'])) {

            $userModel = new userModel();
            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
            $data['surname'] = trim(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING));
            $data['firstname'] = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
            $data['thirdname'] = trim(filter_input(INPUT_POST, 'thirdname', FILTER_SANITIZE_STRING));
            $data['gender'] = trim(filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING));
            $data['birthday'] = trim(filter_input(INPUT_POST, 'birthday', FILTER_SANITIZE_STRING));
            $data['education'] = trim(filter_input(INPUT_POST, 'education', FILTER_SANITIZE_STRING));
            $data['education_number'] = trim(filter_input(INPUT_POST, 'education_number', FILTER_SANITIZE_STRING));
            $data['spec'] = trim(filter_input(INPUT_POST, 'spec', FILTER_SANITIZE_STRING));
            $data['job_place'] = trim($_POST['job_place']);;
            $data['job_title'] = trim(filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING));
            $data['exp_all'] = trim(filter_input(INPUT_POST, 'exp_all', FILTER_SANITIZE_STRING));
            $data['exp_in_org'] = trim(filter_input(INPUT_POST, 'exp_in_org', FILTER_SANITIZE_STRING));
            $data['title'] = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
            $data['disability'] = trim(filter_input(INPUT_POST, 'disability', FILTER_SANITIZE_STRING));
            $data['snils'] = trim(filter_input(INPUT_POST, 'snils', FILTER_SANITIZE_STRING));
            $data['snils_path'] = trim(filter_input(INPUT_POST, 'snils_path', FILTER_SANITIZE_STRING));

            if (!$userModel->frdoInput($data)) {
                // Обработка ошибки
                echo "Произошла ошибка при добавлении данных в базу данных.";
            }
        } else {
            // Обработка ошибки
            echo "Не все поля заполнены.";
        }

        header("Location: /users/userdata");
    }

    public function fisfrdoedit()
    {
        $this->check->requirePermission();

        $user_id = $this->userId;

        $userModel = new userModel();
        $frdo = $userModel->readUserFrdo($user_id);
        $user = $userModel->readUser($user_id);

        include 'app/views/users/fisfrdoedit.php';
    }

    public function fisfrdoupdate()
    {
        $this->check->requirePermission();

        if (isset($_POST['surname']) && !empty($_POST['surname']) && isset($_POST['firstname']) && !empty($_POST['firstname']) && isset($_POST['snils']) && !empty($_POST['snils'])) {

            $userModel = new userModel();
            $data['id'] = trim($_POST['id']);
            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
            $data['surname'] = trim(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING));
            $data['firstname'] = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
            $data['thirdname'] = trim(filter_input(INPUT_POST, 'thirdname', FILTER_SANITIZE_STRING));
            $data['gender'] = trim(filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING));
            $data['birthday'] = trim(filter_input(INPUT_POST, 'birthday', FILTER_SANITIZE_STRING));
            $data['education'] = trim(filter_input(INPUT_POST, 'education', FILTER_SANITIZE_STRING));
            $data['education_number'] = trim(filter_input(INPUT_POST, 'education_number', FILTER_SANITIZE_STRING));
            $data['spec'] = trim(filter_input(INPUT_POST, 'spec', FILTER_SANITIZE_STRING));
            $data['job_place'] = trim($_POST['job_place']);;
            $data['job_title'] = trim(filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING));
            $data['exp_all'] = trim(filter_input(INPUT_POST, 'exp_all', FILTER_SANITIZE_STRING));
            $data['exp_in_org'] = trim(filter_input(INPUT_POST, 'exp_in_org', FILTER_SANITIZE_STRING));
            $data['title'] = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
            $data['disability'] = trim(filter_input(INPUT_POST, 'disability', FILTER_SANITIZE_STRING));
            $data['snils'] = trim(filter_input(INPUT_POST, 'snils', FILTER_SANITIZE_STRING));
            $data['snils_path'] = trim(filter_input(INPUT_POST, 'snils_path', FILTER_SANITIZE_STRING));

            if (!$userModel->frdoUpdate($data)) {
                // Обработка ошибки
                echo "Произошла ошибка при добавлении данных в базу данных.";
            }
        } else {
            // Обработка ошибки
            echo "Не все поля заполнены.";
        }

        header("Location: /users/userdata");
    }
}
