<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/nivelation/dirs.php";
include_once DB_PATH . "MySqlConnection.php";
class courseModel
{
    function __construct()
    {
    }


    function getSchoolStudents($process)
    {
        $conn = (new MySqlConnection())->getConnection();

        $sql = "CALL spCourses('$process');";
        $arreglo = array();
        $consulta = $conn->query($sql);

        foreach ($consulta as $row) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
}
