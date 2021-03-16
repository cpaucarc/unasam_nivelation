<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "RanksModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $proc = intval($_POST['process']);

    if (isset($proc)) {
        $ranksModel = new RanksModel();
        echo $ranksModel->getAllRanksByProcessID($proc);
    } else {
        echo json_encode('{"error":"No existen datos"}');
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}