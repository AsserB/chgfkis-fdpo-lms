<?php

namespace controllers\home;

use models\users\userModel;
use models\lms\lmsModel;
use models\news\newsModel;

class homeController
{

    public function __construct()
    {
        $user = new userModel();
        $user->createTable();
    }

    public function index()
    {

        $lmsModel = new lmsModel();
        $courses = $lmsModel->getAllCourses();

        include 'app/views/index.php';
    }

    public function policy()
    {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        include 'app/views/info/policy.php';
    }

    public function cookie()
    {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        include 'app/views/info/cookie.php';
    }

    public function useragreement()
    {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        include 'app/views/info/useragreement.php';
    }
}
