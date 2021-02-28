<?php


class Clase
{
    private $a = "Uno";

    function name()
    {
        echo $this->a;
    }

}

$cl = new Clase();
$cl->name();