<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');

class FileModel
{
    private $name;
    private $size;
    private $type;
    private $temporalDir;
    private $finalDir;

    public function __construct()
    {
        $this->finalDir = STORAGE_PATH;
    }

    public function moveFileToFinalDir()
    {
        if (isset($this->finalDir) and isset($this->temporalDir) and isset($this->name)) {
            return move_uploaded_file($this->temporalDir, $this->finalDir . $this->name);
        } else {
            return false;
        }
    }

    public function getPath()
    {
        return $this->finalDir . $this->name;
    }

    public function generateName($name)
    {
        //Generate a new name using current timestamp and a random num between 100 and 999
        //Ex. name = file.json -> name = file20200319180212120.json
        $name = str_replace(' ', '', $name);
        $name = explode(".", $name);
        $curtime = date("YmdHis");
        $random = random_int(100, 999);
        return $name[0] . $curtime . $random . '.' . $name[1];
    }


    //Getters and Setters
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $this->generateName($name);
        return $this;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getTemporalDir()
    {
        return $this->temporalDir;
    }

    public function setTemporalDir($temporalDir)
    {
        $this->temporalDir = $temporalDir;
        return $this;
    }

    public function getFinalDir(): string
    {
        return $this->finalDir;
    }


}