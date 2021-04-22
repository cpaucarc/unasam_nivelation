<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/nivelation/dirs.php";
include_once DB_PATH . "MySqlConnection.php";
class schoolModel
{
    function __construct()
    {
    }


    function getSchoolStudents($process)
    {
        $conn = (new MySqlConnection())->getConnection();

        $sql = "SELECT program,COUNT(code) AS students FROM vstudents WHERE process='$process' GROUP BY program ; ";
        $arreglo = array();
        $consulta = $conn->query($sql);

        foreach ($consulta as $row) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
}
