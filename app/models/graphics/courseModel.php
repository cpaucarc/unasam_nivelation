<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/ogcu/dirs.php";
include_once DB_PATH . "MySqlConnection.php";
class courseModel
{
    function __construct()
    {
    }


    function getSchoolStudents($status,$process)
    {
        $conn = (new MySqlConnection())->getConnection();

        $sql = "CALL spShowStatusByCourse($status,'$process');";
        $arreglo = array();
        $consulta = $conn->query($sql);

        foreach ($consulta as $row) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
}
