<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "Student.php");
require_once(UTIL_PATH . "Question.php");

$ruta = STORAGE_PATH;

if (is_dir($ruta)) {
    // Abre un gestor de directorios para la ruta indicada
    $gestor = opendir($ruta);
    echo "<ul>";

    // Recorre todos los elementos del directorio
    while (($archivo = readdir($gestor)) !== false) {

        $ruta_completa = $ruta . "/" . $archivo;

        // Se muestran todos los archivos y carpetas excepto "." y ".."
        if ($archivo != "." && $archivo != "..") {

            $name = $archivo;
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
} else {
    echo "No es una ruta de directorio valida<br/>";
}