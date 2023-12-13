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
}
