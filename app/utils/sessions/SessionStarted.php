<?php

class SessionStarted
{
    public function __construct()
    {
    }

    public function verifySessionStarted()
    {
        //Note: $_SESSION is defined in login/makeLogin
        if (!isset($_SESSION['user_logged'])) {
            $this->redirectToLoginView();
        }
    }

    public function getUpperPartByUserType(): string
    {
        if (intval($_SESSION['user_logged']['utid']) === 1) {       //1: Administrador
            return COMPONENT_PATH . "upperpart.php";
        } elseif (intval($_SESSION['user_logged']['utid']) === 2) { //2: Visor de Recursos
            return COMPONENT_PATH . "upperpart_viewer.php";
        } else {                                                    //3: Estudiante
            return COMPONENT_PATH . "upperpart_student.php";
        }
    }

    public function redirectByUserType()
    {

    }

    public function redirectToLoginView()
    {
        header("Location: " . PROJECT . "login", TRUE, 301);
        exit();
    }

}