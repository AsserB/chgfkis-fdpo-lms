<?php

namespace controllers\info;

class InfoController
{
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
