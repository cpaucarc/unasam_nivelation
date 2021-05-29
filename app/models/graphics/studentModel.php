<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/nivelation/dirs.php";
include_once DB_PATH . "MySqlConnection.php";

class studentModel
{
    function __construct()
    {
    }

    function getSchoolStudents($id, $byTipe)
    {
        $conn = (new MySqlConnection())->getConnection();
        if ($byTipe === 'Dimensiones') {
            $sql = "call spCountStatusDimension($id);";
        } else if ($byTipe === 'Cursos') {
            $sql = "call spCountStatusCourse($id);";
        }

        $arreglo = array();
        $consulta = $conn->query($sql);

        foreach ($consulta as $row) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
}
