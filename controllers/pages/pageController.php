<?php

namespace controllers\pages;

use models\pages\pageModel;
use models\roles\roleModel;
use models\Check;

class pageController
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

        $pageModel = new pageModel();
        $pages = $pageModel->getAllPages();

        include 'app/views/pages/index.php';
    }

    //Вызов функции для создания ролей с файла
    public function create()
    {
        $this->check->requirePermission();

        $roleModel = new roleModel;
        $roles = $roleModel->getAllRoles();
        include 'app/views/pages/create.php';
    }

    //Фукция для работы с формой
    public function store()
    {
        $this->check->requirePermission();

        if (isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['roles'])) {
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);
            $roles = implode(",", $_POST['roles']);

            if (empty($title) || empty($slug) || empty($roles)) {
                echo "Отсуствует название страницы или незаполнены роли";
                return;
            }

            $pageModel = new pageModel();
            $pageModel->createPage($title, $slug, $roles);
        }

        header("Location:  /pages"); // Перенаправление на страницу со всеми страницами
    }

    //Функция для редактирования ролей
    public function edit($params)
    {
        $this->check->requirePermission();

        $roleModel = new roleModel;
        $roles = $roleModel->getAllRoles();

        $pageModel = new pageModel();
        $page = $pageModel->getPageByID($params['id']);

        if (!$page) {
            echo "Страница не найдена";
            return;
        }

        include 'app/views/pages/edit.php';
    }

    //Функция для обнвовления ролей
    public function update()
    {
        $this->check->requirePermission();

        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['roles'])) {

            $id = trim($_POST['id']);
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);
            $roles = implode(",", $_POST['roles']);

            if (empty($title) || empty($slug) || empty($roles)) {
                echo "Отсуствует название страницы и неопределены роли";
                return;
            }

            $pageModel = new pageModel();
            $pageModel->updatePage($id, $title, $slug, $roles);
        }

        header("Location:  /pages"); // Перенаправление на страницу со всеми страницами
    }

    //Функция для удаления ролей
    public function delete($params)
    {
        $this->check->requirePermission();

        $pageModel = new pageModel();
        $pageModel->deletePage($params['id']);

        header("Location:  /pages"); // Перенаправление на страницу со всеми страницами
    }
}
