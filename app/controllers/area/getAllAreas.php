<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "AreasModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $areas = new AreasModel();
    echo($areas->getAllAreas());
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}