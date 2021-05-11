<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');


class File
{
    private string $main = STORAGE_PATH;
    private string $name;
    private string $extension;
    private string $path;
    private int $size;
    private int $filemtime;


    public function __construct($name)
    {
        $this->name = $name;
        $this->path = $this->main. $this->name;
        if (file_exists($this->path)) {
            $this->filemtime = filemtime($this->path);
            $this->size = filesize($this->path);
        }
    }

    public function listFiles()
    {
        if (is_dir($this->main)) {

            $files = opendir($this->main);
            $response['files'] = array();
            while (($file = readdir($files)) !== false) {

                if ($file != "." && $file != "..") {
                    $info_file = array();
                    $info_file['name'] =
                    $totalSize = filesize($ruta);
                    $size = filesize($ruta . $archivo);
                    $type = filetype($ruta . $archivo);
                    $time = filemtime($ruta . $archivo);
                    $stat = stat($ruta . $archivo);
                    $tiempo = (time() - $time);
                    //date ("F d Y H:i:s.", filemtime($nombre_archivo))
                    echo '<br>';
                    var_dump($stat);
                    echo "<li>" . $name . ' -> ' . $size . ' -> ' . $type . ' -> ' . $totalSize . ' -> ' . $time . ' --' . date("F d Y H:i:s.", $time) . ' act ' . date("F d Y H:i:s.", time()) . "</li>";

                }
            }

            // Cierra el gestor de directorios
            closedir($gestor);
            echo "</ul>";
        }
    }

    /*                 */
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): File
    {
        $this->name = $name;
        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): File
    {
        $this->path = $path;
        return $this;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): File
    {
        $this->size = $size;
        return $this;
    }


}