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

    public function getUpperPartByUserType()
    {
        if (intval($_SESSION['user_logged']['utid']) === 1) {       //1: Administrador
            return COMPONENT_PATH . "upperpart.php";
        } elseif (intval($_SESSION['user_logged']['utid']) === 2) { //2: Visor de Recursos
            return COMPONENT_PATH . "upperpart_viewer.php";
        } elseif (intval($_SESSION['user_logged']['utid']) === 3) { //3: Estudiante
            return COMPONENT_PATH . "upperpart_student.php";
        } elseif (intval($_SESSION['user_logged']['utid']) === 4) { //4: Docente
            return COMPONENT_PATH . "upperpart_teacher.php";
        } else {                                                    //5: Director
            return COMPONENT_PATH . "upperpart_director.php";
        }
    }

    public function redirectByUserType($utID)
    {
        $utID = intval($utID);

        if ($utID === 1) { //Administrador
            header("Location: " . PROJECT . "inicio", TRUE, 301);
            exit;
        } elseif ($utID === 2) { //Visor de Recursos
            header("Location: " . PROJECT . "programas", TRUE, 301);
            exit;
        } elseif ($utID === 3) { //Estudiante
            header("Location: " . PROJECT . "estudiante/" . $_SESSION['user_logged']['id'], TRUE, 301);
            exit;
        } elseif ($utID === 4) { //Docente
            header("Location: " . PROJECT . "mis-cursos", TRUE, 301);
            exit;
        } elseif ($utID === 5) { //Director
            header("Location: " . PROJECT . "seguimiento", TRUE, 301);
            exit;
        }
    }

    public function redirectToLoginView()
    {
        header("Location: " . PROJECT . "login", TRUE, 301);
        exit();
    }

}