<?php

namespace controllers\home;

use models\users\userModel;

class homeController
{

    public function __construct()
    {
        $user = new userModel();
        $user->createTable();
    }

    public function index()
    {
        include 'app/views/index.php';
    }
}
