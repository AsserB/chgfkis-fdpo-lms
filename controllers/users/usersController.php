<?php

namespace controllers\users;

use models\users\userModel;
use models\auth\authModel;
use models\Check;
use models\roles\roleModel;

//--Контроллер для CRUD "Пользователи"--//
class usersController
{
    private $check;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
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
}
