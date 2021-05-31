<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Director.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $director = new Director();
    echo($director->getAllDirectors());
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}
