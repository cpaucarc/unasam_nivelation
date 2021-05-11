<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "ProcessModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $process = new ProcessModel();
    echo (new SendMessage($process->getLastProcess(), true))->getEncodedMessage();
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}