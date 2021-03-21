<?php

//namespace App\Database;

class MySqlConnection
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $port;

    public function __construct()
    {
        $this->host = "localhost";
        $this->db = "nivelation";
        $this->user = "root";
        $this->password = "";
        $this->port = "3306";
    }

    /**
     * @deprecated  Falta realizar la conexion desde un archivo .env
     */
    private function getInformationFromEnvFile()
    {
        $env = new Environment(__DIR__ . '/.env');
        $env->load();
        $this->host = $env . getenv('DB_HOST');
        $this->port = $env . getenv('DB_PORT');
        $this->db = $env . getenv('DB_DATABASE');
        $this->user = $env . getenv('DB_USERNAME');
        $this->password = $env . getenv('DB_PASSWORD');
    }

    public function getConnection()
    {
        //$this->getInformationFromEnvFile();

        try {

            $conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "success";
            return $conn;

        } catch (PDOException $e) {
            return null;
        }
    }

}
