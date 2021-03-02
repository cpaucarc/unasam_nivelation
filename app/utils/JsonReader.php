<?php

class JsonReader
{
    private $jsonFile;
    private $path;

    function __construct($path)
    {
        $this->path = $path;
        try {
            $this->verifyFileExistence();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function verifyFileExistence()
    {
        if (file_exists($this->path)) {
            //$this->jsonFile = file_get_contents($this->path);
            $data = file_get_contents($this->path);
            $this->jsonFile = json_decode($data, true);
        } else {
            throw new Exception("File not found in $this->path");
        }
    }

    function getJsonFile()
    {
        return $this->jsonFile;
    }

    function show()
    {
        //var_dump($this->jsonFile);
        //echo json_decode($this->jsonFile, true, 0, 0);
        //var_dump($this->jsonFile);
        echo '<ul>';
        foreach ($this->jsonFile as $row) {
            echo '<li>';
            print_r($row['respuestas']);
            echo '</li>';
        }
        echo '</ul>';
    }


}