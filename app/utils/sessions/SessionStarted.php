<?php

class SessionStarted
{
    public function __construct()
    {
    }

    public function verifySessionStarted()
    {
        //Note: $_SESSION us defined in login/makeLogin
        if (!isset($_SESSION['user_logged'])) {
            $this->redirectToLoginView();
        }
    }

    public function redirectToLoginView()
    {
        $loginViewPath = "login";
        header("Location: " . $loginViewPath, TRUE, 301);
        exit();
    }

}